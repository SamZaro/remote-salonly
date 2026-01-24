<?php

namespace App\Livewire\Booking;

use App\Booking\BookingModuleManager;
use Livewire\Component;

class BookingSection extends Component
{
    public string $title = '';

    public string $description = '';

    public string $buttonText = '';

    public string $alignment = 'center';

    public bool $showIcon = true;

    public ?string $backgroundColor = null;

    public ?string $textColor = null;

    public string $buttonStyle = 'primary';

    public function mount(
        ?string $title = null,
        ?string $description = null,
        ?string $buttonText = null,
        string $alignment = 'center',
        bool $showIcon = true,
        ?string $backgroundColor = null,
        ?string $textColor = null,
        string $buttonStyle = 'primary'
    ): void {
        $this->title = $title ?? __('Maak een afspraak');
        $this->description = $description ?? __('Plan direct uw afspraak in onze online agenda. Kies een datum en tijd die u het beste uitkomt.');
        $this->buttonText = $buttonText ?? __('Reserveer nu');
        $this->alignment = $alignment;
        $this->showIcon = $showIcon;
        $this->backgroundColor = $backgroundColor;
        $this->textColor = $textColor;
        $this->buttonStyle = $buttonStyle;
    }

    public function getBookingUrlProperty(): string
    {
        return BookingModuleManager::getBookingUrl();
    }

    public function getIsEnabledProperty(): bool
    {
        return BookingModuleManager::isEnabled();
    }

    public function getAlignmentClassesProperty(): string
    {
        return match ($this->alignment) {
            'left' => 'text-left items-start',
            'right' => 'text-right items-end',
            default => 'text-center items-center mx-auto',
        };
    }

    public function getButtonClassesProperty(): string
    {
        $base = 'inline-flex items-center rounded-md px-6 py-3 text-base font-medium shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';

        return match ($this->buttonStyle) {
            'secondary' => $base.' bg-secondary-600 text-white hover:bg-secondary-700 focus:ring-secondary-500',
            'outline' => $base.' border-2 border-current bg-transparent hover:bg-black/5 focus:ring-current',
            default => $base.' bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
        };
    }

    public function render()
    {
        return view('livewire.booking.section');
    }
}
