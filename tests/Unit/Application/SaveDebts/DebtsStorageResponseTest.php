<?php

namespace Tests\Unit\Application\SaveDebts;

use App\Application\SaveDebts\DebtsStorageResponse;
use App\Domain\Enum\DebtStorageStatus;
use PHPUnit\Framework\TestCase;

class DebtsStorageResponseTest extends TestCase
{
    public function test_should_return_message_of_save_debt_in_progress_when_save_in_progress()
    {
        $status = DebtStorageStatus::IN_PROGRESS;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::IN_PROGRESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_debt_saved_when_sucess_save()
    {
        $status = DebtStorageStatus::SUCCESS;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_save_debt_failed_when_fail_save()
    {
        $status = DebtStorageStatus::FAILED;
        $response = new DebtsStorageResponse($status);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::STATUS_FIELD => $status,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}