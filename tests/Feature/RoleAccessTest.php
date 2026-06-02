<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');

        // Middleware auth should redirect to login
        $response->assertRedirect('/login');
    }

    public function test_normal_user_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Middleware role should abort with 403
        $response->assertStatus(403);
    }

    public function test_vendor_user_cannot_access_admin_dashboard()
    {
        $vendorUser = User::factory()->create([
            'role' => 'vendor'
        ]);

        $response = $this->actingAs($vendorUser)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        // It should pass the middleware, so it won't be 403
        $this->assertNotEquals(403, $response->status());
    }

    public function test_admin_cannot_access_vendor_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/vendor/dashboard');

        // Should abort with 403
        $response->assertStatus(403);
    }

    public function test_vendor_can_access_vendor_dashboard()
    {
        $vendorUser = User::factory()->create([
            'role' => 'vendor'
        ]);

        $response = $this->actingAs($vendorUser)->get('/vendor/dashboard');

        // It should pass the middleware, so it won't be 403
        $this->assertNotEquals(403, $response->status());
    }
}
