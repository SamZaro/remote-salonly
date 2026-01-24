<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BookingPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Booking permissions
        Permission::findOrCreate('booking.view');
        Permission::findOrCreate('booking.create');
        Permission::findOrCreate('booking.update');
        Permission::findOrCreate('booking.delete');
        Permission::findOrCreate('booking.manage'); // for settings

        // Availability permissions
        Permission::findOrCreate('availability.view');
        Permission::findOrCreate('availability.manage');

        // Admin role gets all permissions
        $adminRole = Role::findOrCreate('admin');
        $adminRole->givePermissionTo([
            'booking.view',
            'booking.create',
            'booking.update',
            'booking.delete',
            'booking.manage',
            'availability.view',
            'availability.manage',
        ]);

        // Customer role gets booking permissions for dashboard
        $customerRole = Role::findOrCreate('customer');
        $customerRole->givePermissionTo([
            'booking.view',
            'booking.create',
            'booking.update',
            'booking.delete',
            'booking.manage',
            'availability.view',
            'availability.manage',
        ]);
    }
}
