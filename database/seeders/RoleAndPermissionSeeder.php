<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view users', 'create users', 'edit users', 'delete users',
            'view stores', 'create stores', 'edit stores', 'delete stores',
            'view ads', 'create ads', 'edit ads', 'delete ads', 'approve ads',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view settings', 'edit settings', 'manage staff', 'view staff',
            'view statistics',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $sellerRole = Role::firstOrCreate(['name' => 'seller', 'guard_name' => 'web']);
        $buyerRole = Role::firstOrCreate(['name' => 'buyer', 'guard_name' => 'web']);

        $adminRole->syncPermissions(Permission::all());
        $sellerRole->syncPermissions([
            'view stores', 'create stores', 'edit stores',
            'view ads', 'create ads', 'edit ads', 'delete ads',
            'view categories', 'manage staff', 'view staff', 'view statistics',
        ]);
        $buyerRole->syncPermissions(['view ads']);

        $superAdmin = config('marketplace.super_admin');
        $adminEmail = $superAdmin['email'];
        $adminPhone = $superAdmin['phone'];
        $adminPassword = $superAdmin['password'];

        if (! $adminEmail || ! $adminPhone || ! $adminPassword) {
            if (app()->isProduction()) {
                throw new RuntimeException(
                    'Set SUPER_ADMIN_EMAIL, SUPER_ADMIN_PHONE, and SUPER_ADMIN_PASSWORD before seeding production.'
                );
            }

            $this->command->warn('Roles seeded; set SUPER_ADMIN_* variables to provision a super administrator.');

            return;
        }

        if (strlen($adminPassword) < 16) {
            throw new RuntimeException('SUPER_ADMIN_PASSWORD must contain at least 16 characters.');
        }

        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $superAdmin['name'],
                'phone' => $adminPhone,
                'password' => $adminPassword,
                'is_active' => true,
            ]
        );
        $admin->syncRoles($adminRole);

        $this->command->info('Roles, permissions, and the configured super administrator were seeded.');
    }
}
