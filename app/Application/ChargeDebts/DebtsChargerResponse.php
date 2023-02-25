<?php

namespace App\Application\ChargeDebts;

use App\Domain\Enum\DebtsChargeStatus;

class DebtsChargerResponse implements \JsonSerializable
{
    public const STATUS_FIELD = 'status';
    public const MESSAGE_FIELD = 'message';

    public const IN_PROGRESS_MESSAGE = 'As cobranças das dívidas estão sendo processadas e em breve serão realizadas.';
    public const SUCCESS_MESSAGE = 'As cobranças das dívidas foram realizadas com sucesso.';
    public const FAIL_MESSAGE = 'Não foi possível realizar a cobrança das dívidas, tente novamente.';

    public function __construct(private DebtsChargeStatus $debtsChargeStatus)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::STATUS_FIELD => $this->debtsChargeStatus->name,
            self::MESSAGE_FIELD => match($this->debtsChargeStatus) {
                DebtsChargeStatus::IN_PROGRESS => self::IN_PROGRESS_MESSAGE,
                DebtsChargeStatus::SUCCESS => self::SUCCESS_MESSAGE,
                DebtsChargeStatus::FAILED => self::FAIL_MESSAGE,
            },
        ];
    }
}