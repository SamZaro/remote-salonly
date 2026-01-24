<?php

namespace App\Services;

use App\Constants\SessionConstants;
use App\Dto\SmsVerificationDto;

class SessionService
{
    public function saveSmsVerificationDto(SmsVerificationDto $smsVerificationDto): void
    {
        session()->put(SessionConstants::SMS_VERIFICATION_DTO, $smsVerificationDto);
    }

    public function getSmsVerificationDto(): ?SmsVerificationDto
    {
        return session()->get(SessionConstants::SMS_VERIFICATION_DTO);
    }

    public function clearSmsVerificationDto(): void
    {
        session()->forget(SessionConstants::SMS_VERIFICATION_DTO);
    }
}
