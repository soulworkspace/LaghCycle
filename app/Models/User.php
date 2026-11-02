<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * الحقول القابلة للتعبئة - Mass Assignable
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'whatsapp',
        'address',
        'avatar',
        'is_active',
        'last_login_at',
    ];

    /**
     * الحقول المخفية
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل أنواع البيانات (Casting)
     * ملاحظة: دمجنا كل شيء في الدالة لأنها الأسلوب الأحدث في Laravel 11
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | العلاقات (Relations)
    |--------------------------------------------------------------------------
    */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function staffInvitations(): HasMany
    {
        return $this->hasMany(StaffInvitation::class, 'invited_by');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /*
    |--------------------------------------------------------------------------
    | منطق التحقق والأدوار (Roles & Logic)
    |--------------------------------------------------------------------------
    */
    
    // التحقق من الأدمن
    public function isAdmin(): bool
    {
        return $this->portalRole() === 'admin';
    }

    public function isVendor(): bool
    {
        return $this->isSeller();
    }

    public function isSeller(): bool
    {
        return $this->portalRole() === 'seller';
    }

    public function isStaff(): bool
    {
        return $this->hasRole('staff', 'web');
    }

    public function isBuyer(): bool
    {
        return $this->portalRole() === 'buyer';
    }

    public function portalRole(): ?string
    {
        $roles = $this->roles
            ->where('guard_name', 'web')
            ->pluck('name')
            ->unique()
            ->values();

        if ($roles->count() !== 1 || ! in_array($roles->first(), ['admin', 'seller', 'buyer'], true)) {
            return null;
        }

        return $roles->first();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin'
            && $this->is_active
            && $this->hasRole('admin', 'web')
            && $this->portalRole() === 'admin';
    }

    public function portalDashboardRoute(): ?string
    {
        if ($this->isAdmin()) {
            return 'filament.admin.pages.dashboard';
        }

        if ($this->isSeller()) {
            return 'vendor.dashboard';
        }

        if ($this->isBuyer()) {
            return 'customer.dashboard';
        }

        return null;
    }

    public function hasStore(): bool
    {
        return $this->store()->exists();
    }

    public function canCreateStore(): bool
    {
        return !$this->hasStore() && ($this->isSeller() || $this->isAdmin());
    }

    public function getAdsCount(): int
    {
        return $this->ads()->count();
    }

    public function canCreateMoreAds(): bool
    {
        return $this->getAdsCount() < 30 || $this->isAdmin();
    }

    /*
    |--------------------------------------------------------------------------
    | أدوات التصفية والوظائف (Scopes & Helpers)
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->whereHas('roles', fn ($roles) => $roles
            ->where('name', $role)
            ->where('guard_name', 'web'));
    }

    public function markLastLogin(): void
    {
        // تم استخدام update مباشرة لتجاوز مشاكل الـ save في بعض الحالات
        $this->update(['last_login_at' => now()]);
    }
}