<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped('Registration has been disabled.');
    }

    /** @test */
    public function registration_screen_can_be_rendered()
    {
        $response = $this->get(route('register'));

        $response->assertOk();
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function authenticated_users_can_not_view_the_registration_screen()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('register'));

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function new_users_can_register()
    {
        Event::fake();

        $response = $this->post(route('register.attempt'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $users = User::all();

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertCount(1, $users);
        $this->assertAuthenticatedAs($users->first());

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_without_email()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => '',
            'password' => 'super-secret-password',
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, $users);
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_with_an_invalid_email()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => 'this-is-not-an-email-address',
            'password' => 'super-secret-password',
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, $users);
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_with_an_email_address_longer_than_255_characters()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => sprintf('%s@example.com', str_repeat('a', 256 - Str::length('@example.com'))),
            'password' => 'super-secret-password',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_with_an_email_address_that_has_already_been_used()
    {
        Event::fake();

        User::factory()->create([
            'email' => 'user@somewhere.com',
        ]);

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => 'user@somewhere.com',
            'password' => 'super-secret-password',
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertCount(1, $users);
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_without_a_password()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => 'someone@somewhere.com',
            'password' => '',
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, $users);
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_with_a_password_that_is_shorter_than_8_characters()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => 'someone@somewhere.com',
            'password' => '1234567',
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, $users);
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function a_user_cannot_register_with_a_password_that_is_longer_than_255_characters()
    {
        Event::fake();

        $response = $this->from(route('register'))->post(route('register.attempt'), [
            'email' => 'someone@somewhere.com',
            'password' => str_repeat('a', 256),
        ]);

        $users = User::all();

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, $users);
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();

        Event::assertNotDispatched(Registered::class);
    }
}
