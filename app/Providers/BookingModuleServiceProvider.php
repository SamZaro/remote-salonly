<?php

namespace App\Providers;

use App\Booking\BookingModuleManager;
use App\Livewire\Booking\BookingButton;
use App\Livewire\Booking\BookingCalendar;
use App\Livewire\Booking\BookingSection;
use App\Livewire\Booking\BookingTimeSlots;
use App\Livewire\Booking\BookingTrigger;
use App\Livewire\Booking\BookingWizard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class BookingModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/booking-module.php',
            'booking-module'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerBladeDirectives();
        $this->registerLivewireComponents();
        $this->registerRoutes();
    }

    /**
     * Register Blade directives.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::if('bookingEnabled', function () {
            return BookingModuleManager::isEnabled();
        });
    }

    /**
     * Register Livewire components.
     */
    protected function registerLivewireComponents(): void
    {
        Livewire::component('booking.wizard', BookingWizard::class);
        Livewire::component('booking.calendar', BookingCalendar::class);
        Livewire::component('booking.time-slots', BookingTimeSlots::class);
        Livewire::component('booking.button', BookingButton::class);
        Livewire::component('booking.section', BookingSection::class);
        Livewire::component('booking.booking-trigger', BookingTrigger::class);
    }

    /**
     * Register booking routes conditionally.
     */
    protected function registerRoutes(): void
    {
        if (! BookingModuleManager::isEnabled()) {
            return;
        }

        $prefix = BookingModuleManager::getRoutePrefix();

        Route::middleware(['web', 'booking.enabled'])
            ->prefix($prefix)
            ->group(function () {
                Route::get('/', BookingWizard::class)->name('booking.wizard');
                Route::get('/confirmation/{booking}', function (\App\Models\Booking $booking) {
                    return view('booking.confirmation', compact('booking'));
                })->name('booking.confirmation');
            });
    }
}
