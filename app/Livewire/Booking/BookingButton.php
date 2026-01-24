<?php

namespace App\Livewire\Booking;

use App\Booking\BookingModuleManager;
use Livewire\Component;

class BookingButton extends Component
{
    public string $style = 'button';

    public string $label = 'Reserveren';

    public string $class = '';

    public function mount(string $style = 'button', ?string $label = null, string $class = ''): void
    {
        $this->style = $style;
        $this->label = $label ?? __('Reserveren');
        $this->class = $class;
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
        return view('livewire.booking.button');
    }
}
