<?php

namespace App\Infraestructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    public const ID = 'id';
    public const DEBT_ID = 'debt_id';
    public const PAID_AT = 'paid_at';
    public const AMOUNT = 'amount';
    public const PAID_BY = 'paid_by';

    protected $fillable = [
        self::DEBT_ID,
        self::PAID_AT,
        self::AMOUNT,
        self::PAID_BY,
    ];

    protected $casts = [
        self::PAID_AT => 'datetime',
    ];

    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class);
    }
}