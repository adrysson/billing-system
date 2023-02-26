<?php

namespace App\Domain\ValueObject\Debtor;

class DebtorEmail implements \JsonSerializable
{
    public const INVALID_EMAIL_MESSAGE = 'O valor informado deve ser um e-mail válido';

    protected function __construct(
        public readonly string $value
    )
    {
    }

    public static function create(string $value): self
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(self::INVALID_EMAIL_MESSAGE);
        }
        return new self($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}