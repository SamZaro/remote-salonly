<?php

namespace App\Filament\Dashboard\Resources\EmailProviders\Pages;

use App\Filament\Dashboard\Resources\EmailProviders\EmailProviderResource;
use Filament\Resources\Pages\ListRecords;

class ListEmailProviders extends ListRecords
{
    protected static string $resource = EmailProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
