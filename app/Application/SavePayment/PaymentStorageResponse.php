<?php

namespace App\Application\SavePayment;

class PaymentStorageResponse implements \JsonSerializable
{
    public const MESSAGE_FIELD = 'message';
    public const PAYMENT_SAVED_FIELD = 'payment_saved';

    public const SUCCESS_MESSAGE = 'O pagamento foi salvo com sucesso.';

    public const FAIL_MESSAGE = 'Não foi possível salvar o pagamento.';

    public function __construct(private bool $paymentSaved)
    {
    }

    public function jsonSerialize(): array
    {
        $response = [
            self::PAYMENT_SAVED_FIELD => $this->paymentSaved,
            self::MESSAGE_FIELD => self::SUCCESS_MESSAGE,
        ];

        if (!$this->paymentSaved) {
            $response[self::MESSAGE_FIELD] = self::FAIL_MESSAGE;
        }

        return $response;
    }

}