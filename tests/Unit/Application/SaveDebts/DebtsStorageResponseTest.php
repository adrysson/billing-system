<?php

namespace Tests\Unit\Application\SaveDebts;

use App\Application\SaveDebts\DebtsStorageResponse;
use App\Domain\Enum\DebtsStorageStatus;
use PHPUnit\Framework\TestCase;

class DebtsStorageResponseTest extends TestCase
{
    public function test_should_return_message_of_save_debts_in_progress_when_save_in_progress()
    {
        $status = DebtsStorageStatus::IN_PROGRESS;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::IN_PROGRESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_debts_saved_when_sucess_save()
    {
        $status = DebtsStorageStatus::SUCCESS;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_save_debts_failed_when_fail_save()
    {
        $status = DebtsStorageStatus::FAILED;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}