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

    #[Validate('nullable|regex:/^[+]?[\d\s\-().]{7,20}$/', message: 'Vul een geldig telefoonnummer in')]
    public string $phone = '';

    #[Validate('required|min:10|max:2000', message: 'Vul een bericht in (minimaal 10 tekens)')]
    public string $message = '';

    // Honeypot field for spam protection (obscure name to fool bots)
    public string $company_url = '';

    public array $theme = [];

    public bool $submitted = false;

    public int $loadedAt = 0;

    public function mount(array $theme = []): void
    {
        $this->theme = $theme;
        $this->loadedAt = time();
    }

    public function submit(): void
    {
        // Honeypot check - if filled, it's likely a bot
        if (! empty($this->company_url)) {
            // Silently "succeed" to not reveal the honeypot
            $this->submitted = true;

            return;
        }

        // Time-based check - humans need at least 3 seconds to fill a form
        if ($this->loadedAt > 0 && (time() - $this->loadedAt) < 3) {
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
