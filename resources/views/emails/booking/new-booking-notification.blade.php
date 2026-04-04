<x-layouts.email>
    <x-slot name="preview">
        {{ __('New booking from :name on :date at :time', ['name' => $booking->customer_name, 'date' => $booking->booking_date->format('d-m-Y'), 'time' => $booking->booking_time]) }}
    </x-slot>

    <tr>
        <td class="sm-px-6" style="border-radius: 4px; padding: 48px; font-size: 16px; color: #334155; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05)" bgcolor="#ffffff">
            <h1 class="sm-leading-8" style="margin: 0 0 24px; font-size: 24px; font-weight: 600; color: #000">
                {{ __('New booking received') }}
            </h1>

            <p style="margin: 0 0 24px; line-height: 24px">
                {{ __('A new booking has been received via :app_name.', ['app_name' => config('app.name')]) }}
            </p>

            {{-- Booking Details Card --}}
            <div style="background-color: #f8fafc; border-radius: 8px; padding: 24px; margin-bottom: 24px; border-left: 4px solid {{config('app.email_color_tint')}};">
                <h2 style="margin: 0 0 16px; font-size: 18px; font-weight: 600; color: #000">
                    {{ __('Booking Details') }}
                </h2>

                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; width: 120px;">{{ __('Date') }}:</td>
                        <td style="padding: 8px 0; font-weight: 600;">{{ $booking->booking_date->format('l d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;">{{ __('Time') }}:</td>
                        <td style="padding: 8px 0; font-weight: 600;">{{ $booking->booking_time }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;">{{ __('Status') }}:</td>
                        <td style="padding: 8px 0;">
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; background-color: #fef3c7; color: #92400e;">
                                {{ $booking->status->label() }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- Customer Details Card --}}
            <div style="background-color: #f0fdf4; border-radius: 8px; padding: 24px; margin-bottom: 24px;">
                <h2 style="margin: 0 0 16px; font-size: 18px; font-weight: 600; color: #000">
                    {{ __('Customer Details') }}
                </h2>

                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; width: 120px;">{{ __('Name') }}:</td>
                        <td style="padding: 8px 0; font-weight: 600;">{{ $booking->customer_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;">{{ __('Email') }}:</td>
                        <td style="padding: 8px 0;">
                            <a href="mailto:{{ $booking->customer_email }}" style="color: {{config('app.email_color_tint')}}; text-decoration: none;">{{ $booking->customer_email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;">{{ __('Phone') }}:</td>
                        <td style="padding: 8px 0;">
                            <a href="tel:{{ $booking->customer_phone }}" style="color: {{config('app.email_color_tint')}}; text-decoration: none;">{{ $booking->customer_phone }}</a>
                        </td>
                    </tr>
                    @if($booking->notes)
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; vertical-align: top;">{{ __('Notes') }}:</td>
                        <td style="padding: 8px 0;">{{ $booking->notes }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <div role="separator" style="background-color: #e2e8f0; height: 1px; line-height: 1px; margin: 24px 0;">&zwj;</div>

            {{-- Action Buttons --}}
            <div style="text-align: center;">
                <a href="{{ url('/dashboard/bookings/' . $booking->id) }}" style="display: inline-block; border-radius: 16px; background-color: {{config('app.email_color_tint')}}; padding: 12px 32px; font-size: 16px; color: #fff; text-decoration-line: none; font-weight: 600; margin-right: 8px;">
                    {{ __('View in Dashboard') }}
                </a>
                <a href="mailto:{{ $booking->customer_email }}?subject={{ urlencode(__('Re: Your booking on :date', ['date' => $booking->booking_date->format('d-m-Y')])) }}" style="display: inline-block; border-radius: 16px; background-color: #e2e8f0; padding: 12px 32px; font-size: 16px; color: #334155; text-decoration-line: none; font-weight: 600;">
                    {{ __('Email Customer') }}
                </a>
            </div>

            <p style="margin: 24px 0 0; font-size: 14px; color: #64748b; text-align: center;">
                {{ __('This booking was received on :datetime', ['datetime' => $booking->created_at->format('d-m-Y H:i')]) }}
            </p>
        </td>
    </tr>
</x-layouts.email>
