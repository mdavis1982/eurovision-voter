<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_login_screen_can_be_rendered()
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function the_login_form_is_not_displayed_and_the_user_is_redirected_when_the_user_is_already_logged_in()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect();
    }

    /** @test */
    public function users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->from(route('login'))->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
    }

    /** @test */
    public function users_can_not_authenticate_with_invalid_email_address()
    {
        $user = User::factory()->create();

        $response = $this->from(route('login'))->post(route('login.attempt'), [
            'email' => 'not-the-correct@email.address',
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
    }

    /** @test */
    public function users_can_be_remembered()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
            'remember' => 'on',
        ]);

        $user = $user->fresh();

        $response->assertRedirect(route('account.dashboard'));
        $response->assertCookie(auth()->guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function users_can_logout_when_they_are_logged_in()
    {
        $this->be(User::factory()->create());

        $response = $this->post(route('logout'));

        $response->assertRedirect();
        $this->assertGuest();
    }

    /** @test */
    public function users_cannot_make_more_than_five_login_attempts_in_one_minute()
    {
        $user = User::factory()->create();

        for ($attempt = 1; $attempt <= 6; $attempt++) {
            $response = $this->from(route('login'))->post(route('login.attempt'), [
                'email' => $user->email,
                'password' => 'invalid-password',
            ]);
        }

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');

        $this->assertMatchesRegularExpression(
            sprintf('/^%s$/', str_replace('\:seconds', '\d+', preg_quote(__('auth.throttle'), '/'))),
            collect(
                $response
                    ->baseResponse
                    ->getSession()
                    ->get('errors')
                    ->getBag('default')
                    ->get('email')
            )->first()
        );
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
