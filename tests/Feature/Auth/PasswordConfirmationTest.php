<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_confirm_password_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('password.confirm'));

        $response->assertOk();
        $response->assertViewIs('auth.confirm-password');
    }

    /** @test */
    public function guests_can_not_view_the_confirm_password_screen()
    {
        $response = $this->get(route('password.confirm'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function passwords_can_be_confirmed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('password.confirm.attempt'), [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function password_is_not_confirmed_with_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('password.confirm.attempt'), [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
