<x-layouts.email>
    <x-slot name="preview">
        {{ __('Nieuw contactformulier bericht van :name', ['name' => $name]) }}
    </x-slot>

    <tr>
        <td class="sm-px-6" style="border-radius: 4px; padding: 48px; font-size: 16px; color: #334155; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05)" bgcolor="#ffffff">
            <h1 class="sm-leading-8" style="margin: 0 0 24px; font-size: 24px; font-weight: 600; color: #000">
                {{ __('Nieuw bericht via contactformulier') }}
            </h1>

            <p style="margin: 0 0 16px; line-height: 24px">
                {{ __('Er is een nieuw bericht binnengekomen via het contactformulier op :app_name.', ['app_name' => config('app.name')]) }}
            </p>

            <div role="separator" style="background-color: #e2e8f0; height: 1px; line-height: 1px; margin: 24px 0;">&zwj;</div>

            {{-- Contact Details --}}
            <table style="width: 100%; margin-bottom: 24px;" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding: 8px 0; color: #64748b; width: 120px;">{{ __('Naam') }}:</td>
                    <td style="padding: 8px 0; font-weight: 600;">{{ $name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #64748b;">{{ __('E-mail') }}:</td>
                    <td style="padding: 8px 0;">
                        <a href="mailto:{{ $email }}" style="color: {{config('app.email_color_tint')}}; text-decoration: none;">{{ $email }}</a>
                    </td>
                </tr>
                @if($phone)
                <tr>
                    <td style="padding: 8px 0; color: #64748b;">{{ __('Telefoon') }}:</td>
                    <td style="padding: 8px 0;">
                        <a href="tel:{{ $phone }}" style="color: {{config('app.email_color_tint')}}; text-decoration: none;">{{ $phone }}</a>
                    </td>
                </tr>
                @endif
            </table>

            <div role="separator" style="background-color: #e2e8f0; height: 1px; line-height: 1px; margin: 24px 0;">&zwj;</div>

            {{-- Message Content --}}
            <h2 style="margin: 0 0 16px; font-size: 18px; font-weight: 600; color: #000">
                {{ __('Bericht') }}:
            </h2>

            <div style="background-color: #f8fafc; border-radius: 8px; padding: 16px; line-height: 24px;">
                {!! nl2br(e($messageContent)) !!}
            </div>

            <div role="separator" style="background-color: #e2e8f0; height: 1px; line-height: 1px; margin: 24px 0;">&zwj;</div>

            {{-- Reply Button --}}
            <div style="text-align: center;">
                <a href="mailto:{{ $email }}?subject=Re: {{ __('Contactformulier') }} - {{ config('app.name') }}" style="display: inline-block; border-radius: 16px; background-color: {{config('app.email_color_tint')}}; padding: 12px 32px; font-size: 16px; color: #fff; text-decoration-line: none; font-weight: 600;">
                    {{ __('Beantwoorden') }}
                </a>
            </div>

            <p style="margin: 24px 0 0; font-size: 14px; color: #64748b; text-align: center;">
                {{ __('Dit bericht is verzonden op :date', ['date' => now()->format('d-m-Y H:i')]) }}
            </p>
        </td>
    </tr>
</x-layouts.email>
