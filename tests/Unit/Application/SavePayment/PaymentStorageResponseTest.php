<?php

namespace Tests\Unit\Application\SavePayment;

use App\Application\SavePayment\PaymentStorageResponse;
use PHPUnit\Framework\TestCase;

class PaymentStorageResponseTest extends TestCase
{
    public function test_should_return_message_of_payment_saved_when_success_payment_save()
    {
        $paymentSaved = true;

        $response = new PaymentStorageResponse($paymentSaved);

        $this->assertEquals(json_encode([
            PaymentStorageResponse::PAYMENT_SAVED_FIELD => $paymentSaved,
            PaymentStorageResponse::MESSAGE_FIELD => PaymentStorageResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_payment_not_saved_when_fail_payment_save()
    {
        $paymentSaved = false;

        $response = new PaymentStorageResponse($paymentSaved);

        $this->assertEquals(json_encode([
            PaymentStorageResponse::PAYMENT_SAVED_FIELD => $paymentSaved,
            PaymentStorageResponse::MESSAGE_FIELD => PaymentStorageResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}