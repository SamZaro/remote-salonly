<?php

namespace App\Livewire\Booking;

use App\Booking\BookingModuleManager;
use Livewire\Component;

class BookingTrigger extends Component
{
    public string $style = 'button';

    public ?string $textColor = null;

    public ?string $backgroundColor = null;

    public string $label = 'Afspraak maken';

    public function mount(
        string $style = 'button',
        ?string $textColor = null,
        ?string $backgroundColor = null,
        ?string $label = null
    ): void {
        $this->style = $style;
        $this->textColor = $textColor;
        $this->backgroundColor = $backgroundColor;
        $this->label = $label ?? __('Afspraak maken');
    }

    public function getBookingUrlProperty(): string
    {
        return BookingModuleManager::getBookingUrl();
    }

    public function getIsEnabledProperty(): bool
    {
        return BookingModuleManager::isEnabled();
    }

    public function render()
    {
        return view('livewire.booking.booking-trigger');
    }
}
