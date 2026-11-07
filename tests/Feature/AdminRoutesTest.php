<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_all_management_modules(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::firstOrCreate(
                ['email' => 'admin@charity.org'],
                [
                    'name' => 'System Administrator',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                    'is_active' => true,
                ]
            );
        }

        $routes = [
            '/admin/dashboard',
            '/admin/projects',
            '/admin/projects/create',
            '/admin/campaigns',
            '/admin/campaigns/create',
            '/admin/donors',
            '/admin/donations',
            '/admin/volunteers',
            '/admin/beneficiaries',
            '/admin/beneficiaries/create',
            '/admin/news',
            '/admin/news/create',
            '/admin/gallery',
            '/admin/reports',
            '/admin/users',
            '/admin/users/create',
            '/admin/settings',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get($route);
            $this->assertEquals(
                200,
                $response->getStatusCode(),
                "Failed asserting that {$route} returned HTTP 200. Got: " . $response->getStatusCode()
            );
        }
    }
}
