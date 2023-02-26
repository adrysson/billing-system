<?php

namespace App\Domain\ValueObject;

class GovernmentId implements \JsonSerializable
{
    public const INVALID_GOVERNMENT_ID_MESSAGE = 'O valor informado deve ser um CPF válido';

    protected function __construct(
        public readonly string $value
    )
    {
    }

    public static function create(string $value): self
    {
        $formattedValue = self::format($value);

        if (!self::isValid($formattedValue)) {
            throw new \InvalidArgumentException(self::INVALID_GOVERNMENT_ID_MESSAGE);
        }

        return new self($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    private static function format(string $value): string
    {
        return preg_replace('/[^0-9]/is', '', $value);
    }

    private static function isValid(string $value): bool
    {
        if (strlen($value) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $value)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $value[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($value[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}