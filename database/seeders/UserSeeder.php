<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            ['name' => 'Super Admin', 'email' => 'superadmin@gmail.com', 'username' => 'superadmin', 'is_active' => true, 'role' => 'superadmin'],
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'username' => 'admin', 'is_active' => true, 'role' => 'admin'],
            ['name' => 'Tutor', 'email' => 'tutor@gmail.com', 'username' => 'tutor1', 'is_active' => true, 'role' => 'teacher'],
            ['name' => 'Tutor 2', 'email' => 'tutor2@gmail.com', 'username' => 'tutor2', 'is_active' => true, 'role' => 'teacher'],
            ['name' => 'Warga Belajar', 'email' => 'wargabelajar@gmail.com', 'username' => 'wb', 'is_active' => false, 'role' => 'student'],
            ['name' => 'Warga Belajar 2', 'email' => 'wargabelajar2@gmail.com', 'username' => 'wb2', 'is_active' => false, 'role' => 'student'],
            ['name' => 'Warga Belajar3', 'email' => 'wargabelajar3@gmail.com', 'username' => 'wb3', 'is_active' => false, 'role' => 'student'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => $password,
                'is_active' => $userData['is_active'],
                // 'remember_token' => Str::random(10),
            ]);

            // $role = Role::where('name', $userData['role'])->first();
            $role = Role::findByName($userData['role'], 'web');
            $user->assignRole($role);
        }
    }
}
