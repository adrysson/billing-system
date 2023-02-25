<?php

namespace App\Infraestructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    public const ID = 'id';
    public const NAME = 'name';
    public const GOVERNMENT_ID = 'government_id';
    public const EMAIL = 'email';
    public const AMOUNT = 'amount';
    public const DUE_DATE = 'due_date';

    use HasFactory;

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
}