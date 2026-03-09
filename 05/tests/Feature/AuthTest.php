<?php

namespace Tests\Feature;

use App\Models\User;
use FontLib\Table\Type\name;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_status_200_on_welcome_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_auth_user_can_view_statistics(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'dL7i0@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->get('/statistics');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_view_statistics(): void
    {
        $response = $this->get('/statistics');

        $response->assertRedirect('/login');
    }

}
