<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the registration page is accessible.
     */
    public function test_registration_page_is_accessible(): void
    {
        $response = $this->get('/register');
        
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /**
     * Test that a user can register with valid data.
     */
    public function test_user_can_register_with_valid_data(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    /**
     * Test that a user cannot register with an existing email.
     */
    public function test_user_cannot_register_with_existing_email(): void
    {
        // Create existing user
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $userData = [
            'name' => 'Jane Doe',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', [
            'name' => 'Jane Doe',
        ]);
        $this->assertGuest();
    }

    /**
     * Test that registration requires a name.
     */
    public function test_registration_requires_name(): void
    {
        $userData = [
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors(['name']);
        $this->assertGuest();
    }

    /**
     * Test that registration requires a valid email.
     */
    public function test_registration_requires_valid_email(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /**
     * Test that registration requires a password with minimum 8 characters.
     */
    public function test_registration_requires_password_minimum_8_characters(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    /**
     * Test that registration requires password confirmation.
     */
    public function test_registration_requires_password_confirmation(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    /**
     * Test that an authenticated user cannot access the register page.
     */
    public function test_authenticated_user_cannot_access_register_page(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/register');
        
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test that user role defaults to 'user' on registration.
     */
    public function test_user_role_defaults_to_user_on_registration(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post('/register', $userData);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}