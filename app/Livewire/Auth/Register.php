<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use App\Support\PortalRedirector;

class Register extends Component
{
    public $name;
    public $phone;
    public $email;
    public $password;

    protected function rules()
    {
        return [
            'name'     => 'required|string|min:3|max:100',
            'phone'    => ['required', 'string', 'unique:users,phone', 'regex:/^0[567][0-9]{8}$/'],
            'email'    => 'nullable|email|max:255|unique:users,email',
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ];
    }

    protected $messages = [
        'phone.regex' => 'رقم الهاتف يجب أن يكون جزائرياً صحيحاً (05, 06, 07).',
        'phone.unique' => 'هذا الرقم مسجل مسبقاً.',
    ];

    public function register(PortalRedirector $redirector)
    {
        $validated = $this->validate();
        $rateLimitKey = 'buyer-registration:' . request()->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $this->addError('phone', 'تم استلام عدد كبير من الطلبات. حاول مجدداً بعد قليل.');

            return null;
        }

        RateLimiter::hit($rateLimitKey, 3600);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name'      => $validated['name'],
                'phone'     => $validated['phone'],
                'email'     => $validated['email'] ?? null,
                'password'  => $validated['password'],
                'is_active' => true,
            ]);

            $buyerRole = Role::firstOrCreate([
                'name' => 'buyer',
                'guard_name' => 'web',
            ]);

            $user->syncRoles($buyerRole);

            return $user;
        });

        Auth::guard('web')->login($user);
        request()->session()->regenerate();

        return redirect()->to($redirector->customerDestination(request()));
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}