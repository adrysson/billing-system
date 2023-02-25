<?php

namespace App\Application\SaveDebts;
use App\Domain\Enum\DebtStorageStatus;

class DebtsStorageResponse implements \JsonSerializable
{
    public const STATUS_FIELD = 'status';
    public const MESSAGE_FIELD = 'message';

    public const IN_PROGRESS_MESSAGE = 'As dívidas estão sendo processadas e em breve serão salvas.';
    public const SUCCESS_MESSAGE = 'As dívidas foram salvas com sucesso.';
    public const FAIL_MESSAGE = 'Não foi possível salvar as dívidas, tente novamente.';

    public function __construct(private DebtStorageStatus $debtStorageStatus)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::STATUS_FIELD => $this->debtStorageStatus,
            self::MESSAGE_FIELD => match($this->debtStorageStatus) {
                DebtStorageStatus::IN_PROGRESS => self::IN_PROGRESS_MESSAGE,
                DebtStorageStatus::SUCCESS => self::SUCCESS_MESSAGE,
                DebtStorageStatus::FAILED => self::FAIL_MESSAGE,
            },
        ];
    }
}