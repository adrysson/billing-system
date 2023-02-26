<?php

namespace App\Infraestructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Debt extends Model
{
    public const ID = 'id';
    public const NAME = 'name';
    public const GOVERNMENT_ID = 'government_id';
    public const EMAIL = 'email';
    public const AMOUNT = 'amount';
    public const DUE_DATE = 'due_date';

    protected $fillable = [
        self::ID,
        self::NAME,
        self::GOVERNMENT_ID,
        self::EMAIL,
        self::AMOUNT,
        self::DUE_DATE,
    ];

    protected $casts = [
        self::DUE_DATE => 'date',
    ];

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}