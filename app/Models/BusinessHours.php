<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_week',
        'open_time',
        'close_time',
        'is_open',
        'slot_duration',
    ];

    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
            'is_open' => 'boolean',
            'slot_duration' => 'integer',
        ];
    }

    public function getDayNameAttribute(): string
    {
        $days = [
            0 => __('Zondag'),
            1 => __('Maandag'),
            2 => __('Dinsdag'),
            3 => __('Woensdag'),
            4 => __('Donderdag'),
            5 => __('Vrijdag'),
            6 => __('Zaterdag'),
        ];

        return $days[$this->day_of_week] ?? '';
    }
}
