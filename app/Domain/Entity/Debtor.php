<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Debtor\DebtorEmail;
use App\Domain\ValueObject\Debtor\DebtorName;
use App\Domain\ValueObject\GovernmentId;

class Debtor implements \JsonSerializable
{
    public const NAME = 'name';
    public const GOVERNMENT_ID = 'government_id';
    public const EMAIL = 'email';

    public function __construct(
        public readonly DebtorName $name,
        public readonly GovernmentId $governmentId,
        public readonly DebtorEmail $email,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::NAME => $this->name,
            self::GOVERNMENT_ID => $this->governmentId,
            self::EMAIL => $this->email,
        ];
    }
}