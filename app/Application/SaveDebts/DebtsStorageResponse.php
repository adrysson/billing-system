<?php

namespace App\Application\SaveDebts;

class DebtsStorageResponse implements \JsonSerializable
{
    public const SAVE_IN_PROGRESS_FIELD = 'save_in_progress';
    public const MESSAGE_FIELD = 'message';

    public const SUCCESS_MESSAGE = 'As dívidas estão sendo processadas e em breve serão salvas.';
    public const FAIL_MESSAGE = 'Não foi possível processar as dívidas, tente novamente.';

    public function __construct(private bool $saveInProgress)
    {
    }

    public function jsonSerialize(): array
    {
        $response = [
            self::SAVE_IN_PROGRESS_FIELD => $this->saveInProgress,
            self::MESSAGE_FIELD => self::SUCCESS_MESSAGE,
        ];

        if (!$this->saveInProgress) {
            $response[self::MESSAGE_FIELD] = self::FAIL_MESSAGE;
        }

        return $response;
    }
}