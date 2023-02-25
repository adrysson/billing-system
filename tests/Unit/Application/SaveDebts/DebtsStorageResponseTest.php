<?php

namespace Tests\Unit\Application\SaveDebts;

use App\Application\SaveDebts\DebtsStorageResponse;
use PHPUnit\Framework\TestCase;

class DebtsStorageResponseTest extends TestCase
{
    public function test_should_return_message_of_debt_in_processing_when_save_in_process()
    {
        $saveInProcess = true;

        $response = new DebtsStorageResponse($saveInProcess);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::SAVE_IN_PROGRESS_FIELD => $saveInProcess,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_debt_not_in_processing_when_save_not_in_process()
    {
        $saveInProcess = false;

        $response = new DebtsStorageResponse($saveInProcess);

        $this->assertEquals(json_encode([
            DebtsStorageResponse::SAVE_IN_PROGRESS_FIELD => $saveInProcess,
            DebtsStorageResponse::MESSAGE_FIELD => DebtsStorageResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}