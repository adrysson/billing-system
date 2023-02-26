<?php

namespace App\Application\SavePayment;

use App\Domain\Enum\PaymentStorageStatus;

class PaymentStorageResponse implements \JsonSerializable
{
    public const STATUS_FIELD = 'status';
    public const MESSAGE_FIELD = 'message';

    public const IN_PROGRESS_MESSAGE = 'O pagamento está sendo processado e em breve será salvo.';
    public const SUCCESS_MESSAGE = 'O pagamento foi salvo com sucesso.';
    public const FAIL_MESSAGE = 'Não foi possível salvar ao pagamento, tente novamente.';

    public function __construct(private PaymentStorageStatus $paymentStorageStatus)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::STATUS_FIELD => $this->paymentStorageStatus->name,
            self::MESSAGE_FIELD => match ($this->paymentStorageStatus) {
                PaymentStorageStatus::IN_PROGRESS => self::IN_PROGRESS_MESSAGE,
                PaymentStorageStatus::SUCCESS => self::SUCCESS_MESSAGE,
                PaymentStorageStatus::FAILED => self::FAIL_MESSAGE,
            },
        ];
    }
}