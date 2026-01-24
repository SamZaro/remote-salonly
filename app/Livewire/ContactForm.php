<?php

namespace App\Livewire;

use App\Mail\ContactFormSubmission;
use App\Services\ConfigService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|min:2|max:100', message: 'Vul uw naam in (minimaal 2 tekens)')]
    public string $name = '';

    #[Validate('required|email', message: 'Vul een geldig e-mailadres in')]
    public string $email = '';

    #[Validate('nullable|max:20', message: 'Telefoonnummer mag maximaal 20 tekens bevatten')]
    public string $phone = '';

    #[Validate('required|min:10|max:2000', message: 'Vul een bericht in (minimaal 10 tekens)')]
    public string $message = '';

    // Honeypot field for spam protection
    public string $website = '';

    public array $theme = [];

    public bool $submitted = false;

    public function mount(array $theme = []): void
    {
        $this->theme = $theme;
    }

    public function submit(): void
    {
        // Honeypot check - if filled, it's likely a bot
        if (! empty($this->website)) {
            // Silently "succeed" to not reveal the honeypot
            $this->submitted = true;

            return;
        }

        // Rate limiting - 3 submissions per minute per IP
        $key = 'contact-form:'.request()->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('message', __('Te veel berichten verstuurd. Probeer het later opnieuw.'));

            return;
        }

        $this->validate();

        RateLimiter::hit($key, 60);

        $configService = app(ConfigService::class);
        $recipientEmail = $configService->get('app.support_email');

        if (empty($recipientEmail)) {
            $this->addError('message', __('Er is een configuratiefout opgetreden. Neem contact op via een andere methode.'));

            return;
        }

        try {
            Mail::to($recipientEmail)->send(new ContactFormSubmission(
                name: $this->name,
                email: $this->email,
                phone: $this->phone,
                messageContent: $this->message,
            ));

            $this->submitted = true;
            $this->reset(['name', 'email', 'phone', 'message']);
        } catch (\Exception $e) {
            report($e);
            $this->addError('message', __('Er is een fout opgetreden bij het verzenden. Probeer het later opnieuw.'));
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
