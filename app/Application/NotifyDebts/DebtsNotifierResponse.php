<?php

namespace App\Application\NotifyDebts;

use App\Domain\Enum\DebtsNotificationStatus;

class DebtsNotifierResponse implements \JsonSerializable
{
    public const STATUS_FIELD = 'status';
    public const MESSAGE_FIELD = 'message';

    public const IN_PROGRESS_MESSAGE = 'As cobranças das dívidas estão sendo processadas e em breve serão realizadas.';
    public const SUCCESS_MESSAGE = 'As cobranças das dívidas foram realizadas com sucesso.';
    public const FAIL_MESSAGE = 'Não foi possível realizar a cobrança das dívidas, tente novamente.';

    public function __construct(private DebtsNotificationStatus $debtsNotificationStatus)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::STATUS_FIELD => $this->debtsNotificationStatus->name,
            self::MESSAGE_FIELD => match($this->debtsNotificationStatus) {
                DebtsNotificationStatus::IN_PROGRESS => self::IN_PROGRESS_MESSAGE,
                DebtsNotificationStatus::SUCCESS => self::SUCCESS_MESSAGE,
                DebtsNotificationStatus::FAILED => self::FAIL_MESSAGE,
            },
        ];
    }
}