<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_as_client(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'phone' => '+1234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'client'
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'phone' => '+1234567890',
        ]);

        $user = User::where('phone', '+1234567890')->first();
        $this->assertTrue($user->hasRole('client'));
    }

    public function test_user_can_register_as_merchant(): void
    {
        $response = $this->post('/register', [
            'name' => 'Jane Smith',
            'phone' => '+0987654321',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'merchant'
        ]);

        $response->assertRedirect('/store/setup');

        $this->assertDatabaseHas('users', [
            'name' => 'Jane Smith',
            'phone' => '+0987654321',
        ]);

        $user = User::where('phone', '+0987654321')->first();
        $this->assertTrue($user->hasRole('merchant'));
    }

    public function test_merchant_can_create_store_after_registration(): void
    {
        // Create a merchant user
        $user = User::factory()->create();
        $merchantRole = Role::firstOrCreate(['name' => 'merchant']);
        $user->assignRole($merchantRole);

        $this->actingAs($user);

        $response = $this->post('/store/setup', [
            'name' => 'Test Store',
            'country' => 'USA',
            'logo' => null,
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('stores', [
            'name' => 'Test Store',
            'country' => 'USA',
            'user_id' => $user->id,
        ]);
    }

    public function test_login_uses_phone_instead_of_email(): void
    {
        $user = User::factory()->create([
            'phone' => '+1234567890',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'phone' => '+1234567890',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_phone(): void
    {
        $user = User::factory()->create([
            'phone' => '+1234567890',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'phone' => '+0000000000',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('phone');
        $this->assertGuest();
    }

    public function test_registration_requires_user_type(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'phone' => '+1234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
            // Missing user_type
        ]);

        $response->assertSessionHasErrors('user_type');
    }
}