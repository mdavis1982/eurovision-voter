<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    private function validVerificationUrl(User $user): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    }

    private function invalidVerificationUrl(User $user): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => 'an-invalid-hash']
        );
    }

    /** @test */
    public function the_email_verification_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertOk();
        $response->assertViewIs('auth.verify-email');
    }

    /** @test */
    public function an_email_can_be_verified()
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get($this->validVerificationUrl($user));

        $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $this->assertAuthenticatedAs($user);

        Event::assertDispatched(Verified::class);
    }

    /** @test */
    public function a_previously_verified_user_is_redirected_to_the_home_page_when_attempting_to_verify()
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get($this->validVerificationUrl($user));

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);

        Event::assertNotDispatched(Verified::class);
    }

    /** @test */
    public function guests_cannot_verify_an_email_address()
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->get($this->validVerificationUrl($user));

        $response->assertRedirect(route('login'));
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
        $this->assertGuest();

        Event::assertNotDispatched(Verified::class);
    }

    /** @test */
    public function users_cannot_verify_another_users_email_address()
    {
        Event::fake();

        $userA = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $userB = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($userA)->get($this->validVerificationUrl($userB));

        $response->assertForbidden();
        $this->assertFalse($userA->fresh()->hasVerifiedEmail());
        $this->assertFalse($userB->fresh()->hasVerifiedEmail());
        $this->assertAuthenticatedAs($userA);

        Event::assertNotDispatched(Verified::class);
    }

    /** @test */
    public function an_email_is_not_verified_with_invalid_hash()
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get($this->invalidVerificationUrl($user));

        $response->assertForbidden();
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
        $this->assertAuthenticatedAs($user);

        Event::assertNotDispatched(Verified::class);
    }
}
