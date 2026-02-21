<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ContactFormPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Contact form permissions
        Permission::findOrCreate('contact_form.view');
        Permission::findOrCreate('contact_form.manage');

        // Admin role gets all permissions
        $adminRole = Role::findOrCreate('admin');
        $adminRole->givePermissionTo([
            'contact_form.view',
            'contact_form.manage',
        ]);

        // Customer role gets view permission (feature flag via ContactFormSettings::is_active controls visibility)
        $customerRole = Role::findOrCreate('customer');
        $customerRole->givePermissionTo([
            'contact_form.view',
        ]);
    }
}
