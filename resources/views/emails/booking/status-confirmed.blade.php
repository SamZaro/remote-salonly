<x-layouts.email>
    <x-slot name="preview">
        {{ __('Your booking on :date at :time has been confirmed!', ['date' => $booking->booking_date->format('d-m-Y'), 'time' => $booking->booking_time]) }}
    </x-slot>

    <tr>
        <td class="sm-px-6" style="border-radius: 4px; padding: 48px; font-size: 16px; color: #334155; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05)" bgcolor="#ffffff">
            <h1 class="sm-leading-8" style="margin: 0 0 24px; font-size: 24px; font-weight: 600; color: #000">
                {{ __('Your booking has been confirmed!') }}
            </h1>

            <p style="margin: 0 0 24px; line-height: 24px">
                {{ __('Dear :name,', ['name' => $booking->customer_name]) }}
            </p>

            <p style="margin: 0 0 24px; line-height: 24px">
                {{ __('Great news! Your booking at :app_name has been confirmed. Below you will find the details of your appointment.', ['app_name' => config('app.name')]) }}
            </p>

            {{-- Booking Details Card --}}
            <div style="background-color: #f0fdf4; border-radius: 8px; padding: 24px; margin-bottom: 24px; border-left: 4px solid #16a34a;">
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
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; background-color: #dcfce7; color: #166534;">
                                {{ $booking->status->label() }}
                            </span>
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

            <p style="margin: 0 0 24px; line-height: 24px">
                {{ __('We look forward to welcoming you. Do you have any questions or would you like to change your booking? Please contact us.') }}
            </p>

            {{-- Contact Button --}}
            @if(config('app.support_email'))
            <div style="text-align: center;">
                <a href="mailto:{{ config('app.support_email') }}" style="display: inline-block; border-radius: 16px; background-color: {{config('app.email_color_tint')}}; padding: 12px 32px; font-size: 16px; color: #fff; text-decoration-line: none; font-weight: 600;">
                    {{ __('Contact Us') }}
                </a>
            </div>
            @endif

            <div role="separator" style="background-color: #e2e8f0; height: 1px; line-height: 1px; margin: 24px 0;">&zwj;</div>

            <p style="margin: 0; font-size: 14px; color: #64748b;">
                {{ __('Kind regards,') }}<br>
                {{ __('The :app_name team', ['app_name' => config('app.name')]) }}
            </p>
        </td>
    </tr>
</x-layouts.email>
