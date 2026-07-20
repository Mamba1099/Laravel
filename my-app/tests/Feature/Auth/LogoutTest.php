<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can logout.
     */
    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test that a guest cannot logout.
     */
    public function test_guest_cannot_logout(): void
    {
        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test that session is cleared after logout.
     */
    public function test_session_is_cleared_after_logout(): void
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        session(['test_key' => 'test_value']);

        $this->post('/logout');

        $this->assertNull(session('test_key'));
    }

    /**
     * Test that a user cannot access dashboard after logout.
     */
    public function test_user_cannot_access_dashboard_after_logout(): void
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        $this->post('/logout');

        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}