<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_type',
        'discount_percentage',
        'valid_from',
        'valid_until',
        'usage_limit',
        'is_active',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function getDiscountValueAttribute()
    {
        return $this->discount_type === 'percentage' ? $this->discount_percentage : $this->discount_amount;
    }
}
