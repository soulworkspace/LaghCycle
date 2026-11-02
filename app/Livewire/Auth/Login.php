<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Support\PortalRedirector;

class Login extends Component
{
    // المتغيرات العامة المرتبطة بـ wire:model
    public $login;
    public $password;
    public $remember = false;

    // قواعد التحقق
    protected $rules = [
        'login'    => 'required|string',
        'password' => 'required|string',
    ];

    /**
     * عملية تسجيل الدخول وتوجيه المستخدم بناءً على رتبته
     */
    public function authenticate(PortalRedirector $redirector)
    {
        $validated = $this->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $fieldType = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $guard = Auth::guard('web');
        $rateLimitKey = 'buyer-login:' . sha1(Str::lower($validated['login']) . '|' . request()->ip());

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $this->addError('login', 'محاولات كثيرة. حاول مجدداً بعد ' . RateLimiter::availableIn($rateLimitKey) . ' ثانية.');

            return null;
        }

        if (! $guard->attempt([
            $fieldType => $validated['login'],
            'password' => $validated['password'],
        ], $this->remember)) {
            RateLimiter::hit($rateLimitKey, 60);
            $this->addError('login', 'بيانات الدخول غير صحيحة.');

            return null;
        }

        RateLimiter::clear($rateLimitKey);

        /** @var \App\Models\User $user */
        $user = $guard->user();

        if (! $user->is_active) {
            $guard->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            $this->addError('login', 'الحساب غير نشط أو ما زال قيد المراجعة.');

            return null;
        }

        request()->session()->regenerate();

        if (! $user->isBuyer()) {
            $destination = $redirector->loginRouteFor($user);
            $guard->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            if ($destination !== null) {
                return redirect()->route($destination)->with('status', 'استخدم بوابة الدخول الخاصة بحسابك.');
            }

            $this->addError('login', 'هذا الحساب لا يملك صلاحية دخول بوابة العملاء.');

            return null;
        }

        return redirect()->to($redirector->customerDestination(request()));
    }

    public function render()
    {
        // تحديد الـ layout لضمان ظهور الصفحة كاملة
        return view('livewire.auth.login')
                ->layout('layouts.app');
    }
}