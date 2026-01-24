<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin',
                'password' => Hash::make('Tangerboy1978'),
            ],
            [
                'email' => 'user@user.com',
                'name' => 'User',
                'password' => Hash::make('oostermeent-west'),
            ],
        ];

        foreach ($users as $userData) {
            $isAdmin = $userData['email'] === 'admin@admin.com';

            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                    'is_admin' => $isAdmin,
                ]
            );

            // Automatically assign admin role to admin@admin.com
            if ($isAdmin) {
                $user->syncRoles(['admin']);
            }
        }
    }
}
