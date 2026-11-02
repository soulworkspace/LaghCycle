<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class SellerRegister extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'string', 'unique:users,phone', 'regex:/^0[567][0-9]{8}$/'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(10)->letters()->numbers()],
        ]);
        $rateLimitKey = 'seller-registration:' . request()->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $this->addError('phone', 'تم استلام عدد كبير من الطلبات من هذا الاتصال. حاول لاحقاً.');

            return null;
        }

        RateLimiter::hit($rateLimitKey, 3600);

        DB::transaction(function () use ($validated): void {
            $sellerRole = Role::firstOrCreate([
                'name' => 'seller',
                'guard_name' => 'web',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'is_active' => false,
            ]);

            $user->syncRoles($sellerRole);
        });

        return redirect()->route('seller.login')->with(
            'status',
            'تم استلام طلبك. ستتمكن من الدخول إلى بوابة البائع بعد مراجعة الحساب وتفعيله.'
        );
    }

    public function render()
    {
        return view('livewire.auth.seller-register')->layout('layouts.app');
    }
}
