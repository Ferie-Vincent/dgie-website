<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('ADMIN_DEFAULT_PASSWORD', 'Dgie@2026!');

        User::updateOrCreate(
            ['email' => 'admin@dgie.gouv.ci'],
            [
                'name' => 'Super Admin DGIE',
                'password' => Hash::make($password),
                'role' => 'super-admin',
            ]
        );

        $this->command->info('Super Admin: admin@dgie.gouv.ci / [voir .env ADMIN_DEFAULT_PASSWORD]');
    }
}
