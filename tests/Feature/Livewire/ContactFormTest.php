<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ContactForm;
use App\Mail\ContactFormSubmission;
use App\Services\ConfigService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\Feature\FeatureTest;

class ContactFormTest extends FeatureTest
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        RateLimiter::clear('contact-form:127.0.0.1');
    }

    /**
     * Helper: create a component with loadedAt in the past so the time check doesn't block.
     */
    private function testComponent(): \Livewire\Features\SupportTesting\Testable
    {
        return Livewire::test(ContactForm::class)
            ->set('loadedAt', time() - 10);
    }

    // ── Rendering ──────────────────────────────────────────────

    public function test_component_renders(): void
    {
        Livewire::test(ContactForm::class)
            ->assertStatus(200)
            ->assertSee(__('Verstuur bericht'));
    }

    // ── Validation: Name ───────────────────────────────────────

    public function test_name_is_required(): void
    {
        $this->testComponent()
            ->set('name', '')
            ->set('email', 'test@example.com')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['name']);
    }

    public function test_name_must_be_at_least_2_characters(): void
    {
        $this->testComponent()
            ->set('name', 'A')
            ->set('email', 'test@example.com')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['name']);
    }

    public function test_name_must_not_exceed_100_characters(): void
    {
        $this->testComponent()
            ->set('name', str_repeat('a', 101))
            ->set('email', 'test@example.com')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['name']);
    }

    // ── Validation: Email ──────────────────────────────────────

    public function test_email_is_required(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', '')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['email']);
    }

    public function test_email_must_be_valid(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'geen-email')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['email']);
    }

    // ── Validation: Phone ──────────────────────────────────────

    public function test_phone_is_optional(): void
    {
        $this->mockConfigService('test@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasNoErrors(['phone']);
    }

    public function test_phone_accepts_dutch_mobile_number(): void
    {
        $this->mockConfigService('test@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '06-12345678')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasNoErrors(['phone']);
    }

    public function test_phone_accepts_international_format(): void
    {
        $this->mockConfigService('test@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '+31 6 12345678')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasNoErrors(['phone']);
    }

    public function test_phone_accepts_landline_with_parentheses(): void
    {
        $this->mockConfigService('test@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '(020) 123 4567')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasNoErrors(['phone']);
    }

    public function test_phone_rejects_invalid_characters(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', 'bel-mij-nu')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['phone']);
    }

    public function test_phone_rejects_too_short_number(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '12345')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['phone']);
    }

    public function test_phone_rejects_too_long_number(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '123456789012345678901')
            ->set('message', 'Dit is een testbericht.')
            ->call('submit')
            ->assertHasErrors(['phone']);
    }

    // ── Validation: Message ────────────────────────────────────

    public function test_message_is_required(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', '')
            ->call('submit')
            ->assertHasErrors(['message']);
    }

    public function test_message_must_be_at_least_10_characters(): void
    {
        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', 'Kort')
            ->call('submit')
            ->assertHasErrors(['message']);
    }

    // ── Successful submission ──────────────────────────────────

    public function test_successful_submission_sends_mail(): void
    {
        $this->mockConfigService('ontvanger@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('phone', '+31 6 12345678')
            ->set('message', 'Dit is een testbericht voor het contactformulier.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true);

        Mail::assertQueued(ContactFormSubmission::class, function ($mail) {
            return $mail->hasTo('ontvanger@example.com')
                && $mail->name === 'Jan Jansen'
                && $mail->email === 'jan@example.com';
        });
    }

    public function test_fields_are_reset_after_successful_submission(): void
    {
        $this->mockConfigService('ontvanger@example.com');

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', 'Dit is een testbericht voor het contactformulier.')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('email', '')
            ->assertSet('phone', '')
            ->assertSet('message', '');
    }

    // ── Honeypot ───────────────────────────────────────────────

    public function test_honeypot_blocks_submission_silently(): void
    {
        $this->testComponent()
            ->set('name', 'Bot')
            ->set('email', 'bot@spam.com')
            ->set('company_url', 'http://spam.com')
            ->set('message', 'Dit is spam van een bot.')
            ->call('submit')
            ->assertSet('submitted', true);

        Mail::assertNothingQueued();
    }

    // ── Time-based check ────────────────────────────────────────

    public function test_time_check_blocks_instant_submission(): void
    {
        Livewire::test(ContactForm::class)
            ->set('loadedAt', time()) // Simulate just loaded
            ->set('name', 'Bot')
            ->set('email', 'bot@spam.com')
            ->set('message', 'Dit is spam van een bot die instant submit.')
            ->call('submit')
            ->assertSet('submitted', true);

        Mail::assertNothingQueued();
    }

    public function test_time_check_allows_normal_submission(): void
    {
        $this->mockConfigService('ontvanger@example.com');

        Livewire::test(ContactForm::class)
            ->set('loadedAt', time() - 10) // Simulate loaded 10 seconds ago
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', 'Dit is een normaal bericht na 10 seconden.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true);

        Mail::assertQueued(ContactFormSubmission::class);
    }

    // ── Rate limiting ──────────────────────────────────────────

    public function test_rate_limiting_blocks_after_3_submissions(): void
    {
        $this->mockConfigService('ontvanger@example.com');

        $component = $this->testComponent();

        for ($i = 0; $i < 3; $i++) {
            $component
                ->set('name', 'Jan Jansen')
                ->set('email', 'jan@example.com')
                ->set('message', 'Dit is testbericht nummer '.($i + 1).'.')
                ->call('submit');

            // Reset submitted state for next iteration
            $component->set('submitted', false);
        }

        $component
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', 'Dit is het vierde bericht dat geblokkeerd moet worden.')
            ->call('submit')
            ->assertHasErrors(['message']);
    }

    // ── Missing config ─────────────────────────────────────────

    public function test_shows_error_when_support_email_not_configured(): void
    {
        $this->mockConfigService(null);

        $this->testComponent()
            ->set('name', 'Jan Jansen')
            ->set('email', 'jan@example.com')
            ->set('message', 'Dit is een testbericht voor het contactformulier.')
            ->call('submit')
            ->assertHasErrors(['message']);

        Mail::assertNothingQueued();
    }

    // ── Helpers ────────────────────────────────────────────────

    private function mockConfigService(?string $supportEmail): void
    {
        $mock = $this->mock(ConfigService::class);
        $mock->shouldReceive('get')
            ->with('app.support_email')
            ->andReturn($supportEmail);
    }
}
