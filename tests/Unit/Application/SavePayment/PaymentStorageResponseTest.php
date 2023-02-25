<?php

namespace Tests\Unit\Application\SavePayment;

use App\Application\SavePayment\PaymentStorageResponse;
use App\Domain\Enum\PaymentStorageStatus;
use PHPUnit\Framework\TestCase;

class PaymentStorageResponseTest extends TestCase
{
    public function test_should_return_message_of_save_payment_in_progress_when_save_in_progress()
    {
        $status = PaymentStorageStatus::IN_PROGRESS;
        $response = new PaymentStorageResponse($status);

        $this->assertEquals(json_encode([
            PaymentStorageResponse::STATUS_FIELD => $status->name,
            PaymentStorageResponse::MESSAGE_FIELD => PaymentStorageResponse::IN_PROGRESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_payment_saved_when_sucess_save()
    {
        $status = PaymentStorageStatus::SUCCESS;
        $response = new PaymentStorageResponse($status);

        $this->assertEquals(json_encode([
            PaymentStorageResponse::STATUS_FIELD => $status->name,
            PaymentStorageResponse::MESSAGE_FIELD => PaymentStorageResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_save_payment_failed_when_fail_save()
    {
        $status = PaymentStorageStatus::FAILED;
        $response = new PaymentStorageResponse($status);

        $this->assertEquals(json_encode([
            PaymentStorageResponse::STATUS_FIELD => $status->name,
            PaymentStorageResponse::MESSAGE_FIELD => PaymentStorageResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}