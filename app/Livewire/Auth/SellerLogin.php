<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Support\PortalRedirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class SellerLogin extends Component
{
    public string $login = '';
    public string $password = '';
    public bool $remember = false;

    public function authenticate(PortalRedirector $redirector)
    {
        $validated = $this->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $guard = Auth::guard('web');
        $rateLimitKey = 'seller-login:' . sha1(Str::lower($validated['login']) . '|' . request()->ip());

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $this->addError('login', 'محاولات كثيرة. حاول مجدداً بعد ' . RateLimiter::availableIn($rateLimitKey) . ' ثانية.');

            return null;
        }

        if (! $guard->attempt([
            $field => $validated['login'],
            'password' => $validated['password'],
        ], $this->remember)) {
            RateLimiter::hit($rateLimitKey, 60);
            $this->addError('login', 'بيانات الدخول غير صحيحة.');

            return null;
        }

        RateLimiter::clear($rateLimitKey);

        /** @var User $user */
        $user = $guard->user();

        if (! $user->is_active) {
            $guard->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            $this->addError('login', 'طلب إنشاء حساب البائع قيد المراجعة أو أن الحساب غير نشط.');

            return null;
        }

        request()->session()->regenerate();

        if (! $user->isSeller()) {
            $destination = $redirector->loginRouteFor($user);
            $guard->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            if ($destination !== null) {
                return redirect()->route($destination)->with('status', 'استخدم بوابة الدخول الخاصة بحسابك.');
            }

            $this->addError('login', 'هذا الحساب لا يملك صلاحية دخول بوابة البائع.');

            return null;
        }

        return redirect()->route('vendor.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.seller-login')->layout('layouts.app');
    }
}
