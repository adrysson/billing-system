<?php

namespace App\Domain\ValueObject\Debt;

class DebtDueDate implements \JsonSerializable
{
    protected function __construct(
        public readonly string $value
    )
    {
    }

    public static function create(string $value): self
    {
        return new self(date('Y-m-d', strtotime($value)));
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}