<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::where('role', 'admin')->first();
        $adminData = [
            'name' => 'Admin User',
            'email' => 'adminsdc@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ];

        if ($admin) {
            $admin->update($adminData);
        } else {
            User::create($adminData);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
