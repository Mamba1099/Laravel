<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can access the dashboard.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertSee($user->name);
    }

    /**
     * Test that a guest cannot access the dashboard.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        
        $response->assertRedirect('/login');
    }

    /**
     * Test that the dashboard shows user information.
     */
    public function test_dashboard_shows_user_information(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertSee('John Doe');
        $response->assertSee('john@example.com');
    }

    /**
     * Test that the dashboard shows the member since date.
     */
    public function test_dashboard_shows_member_since_date(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertSee($user->created_at->format('M d, Y'));
    }
}