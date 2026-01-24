<?php

namespace App\Livewire\Booking;

use App\Enums\BookingStatus;
use App\Mail\Booking\BookingConfirmation;
use App\Mail\Booking\NewBookingNotification;
use App\Models\Booking;
use App\Services\BookingAvailabilityService;
use App\Services\ConfigService;
use App\Settings\BookingSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Reserveren')]
class BookingWizard extends Component
{
    #[Locked]
    public int $step = 1;

    public ?string $selectedDate = null;

    public ?string $selectedTime = null;

    #[Validate('required|min:2|max:100', message: 'Vul uw naam in (minimaal 2 tekens)')]
    public string $customerName = '';

    #[Validate('required|email:rfc,filter', message: 'Vul een geldig e-mailadres in')]
    public string $customerEmail = '';

    public string $customerPhone = '';

    #[Validate('nullable|max:500', message: 'Notities mogen maximaal 500 tekens bevatten')]
    public string $notes = '';

    /** @var string Honeypot field - should remain empty */
    public string $website = '';

    public function rules(): array
    {
        $maxDays = app(BookingSettings::class)->max_advance_booking_days;

        return [
            'selectedDate' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:'.now()->addDays($maxDays)->format('Y-m-d'),
            ],
            'selectedTime' => [
                'required',
                'date_format:H:i',
            ],
            'customerPhone' => [
                'required',
                'regex:/^(\+31|0)[1-9][0-9]{8}$/',
            ],
            'website' => [
                'max:0', // Honeypot must be empty
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'selectedDate.required' => __('Selecteer een datum'),
            'selectedDate.date_format' => __('Ongeldige datum'),
            'selectedDate.after_or_equal' => __('De datum moet vandaag of later zijn'),
            'selectedDate.before_or_equal' => __('U kunt niet zo ver vooruit boeken'),
            'selectedTime.required' => __('Selecteer een tijdstip'),
            'selectedTime.date_format' => __('Ongeldig tijdstip'),
            'customerPhone.required' => __('Vul een geldig Nederlands telefoonnummer in'),
            'customerPhone.regex' => __('Vul een geldig Nederlands telefoonnummer in'),
            'website.max' => __('Ongeldige invoer'),
        ];
    }

    /**
     * Sanitize input on update.
     */
    public function updated(string $property): void
    {
        if (in_array($property, ['customerName', 'customerEmail', 'customerPhone', 'notes'])) {
            $this->{$property} = trim($this->{$property});
        }

        if ($property === 'customerName') {
            $this->customerName = strip_tags($this->customerName);
        }

        if ($property === 'notes') {
            $this->notes = strip_tags($this->notes);
        }
    }

    public function mount(): void
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    #[On('date-selected')]
    public function handleDateSelected(string $date): void
    {
        $this->selectedDate = $date;
        $this->selectedTime = null;
    }

    #[On('time-selected')]
    public function handleTimeSelected(string $time): void
    {
        $this->selectedTime = $time;
        $this->nextStep();
    }

    public function nextStep(): void
    {
        if ($this->step === 1 && $this->selectedDate && $this->selectedTime) {
            $this->step = 2;
        }
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submit(): void
    {
        // Rate limiting: max 5 bookings per hour per IP
        $rateLimitKey = 'booking-submit:'.request()->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            throw ValidationException::withMessages([
                'customerEmail' => __('Te veel reserveringspogingen. Probeer het over :seconds seconden opnieuw.', [
                    'seconds' => $seconds,
                ]),
            ]);
        }

        RateLimiter::hit($rateLimitKey, 3600); // 1 hour decay

        $this->validate();

        // Verify slot is still available
        $service = app(BookingAvailabilityService::class);
        $date = Carbon::parse($this->selectedDate);

        if (! $service->isSlotAvailable($date, $this->selectedTime)) {
            $this->addError('selectedTime', __('Dit tijdslot is helaas niet meer beschikbaar. Kies een ander tijdstip.'));
            $this->step = 1;

            return;
        }

        $booking = Booking::create([
            'booking_date' => $this->selectedDate,
            'booking_time' => $this->selectedTime,
            'customer_name' => trim($this->customerName),
            'customer_email' => strtolower(trim($this->customerEmail)),
            'customer_phone' => preg_replace('/\s+/', '', $this->customerPhone),
            'notes' => $this->notes ? trim($this->notes) : null,
            'status' => BookingStatus::Pending,
        ]);

        // Send confirmation email to customer
        Mail::to($booking->customer_email)->send(new BookingConfirmation($booking));

        // Send notification to site owner
        $configService = app(ConfigService::class);
        $ownerEmail = $configService->get('app.support_email');
        if ($ownerEmail) {
            Mail::to($ownerEmail)->send(new NewBookingNotification($booking));
        }

        $this->redirect(route('booking.confirmation', $booking));
    }

    public function render()
    {
        return view('livewire.booking.wizard');
    }
}
