<?php

namespace Tests\Unit\Application\NotifyDebts;

use App\Application\NotifyDebts\DebtsNotifierResponse;
use App\Domain\Enum\DebtsNotificationStatus;
use PHPUnit\Framework\TestCase;

class DebtsNotifierResponseTest extends TestCase
{
    public function test_should_return_message_of_notify_debts_in_progress_when_notify_in_progress()
    {
        $status = DebtsNotificationStatus::IN_PROGRESS;
        $response = new DebtsNotifierResponse($status);

        $this->assertEquals(json_encode([
            DebtsNotifierResponse::STATUS_FIELD => $status->name,
            DebtsNotifierResponse::MESSAGE_FIELD => DebtsNotifierResponse::IN_PROGRESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_debts_notified_when_sucess_notify()
    {
        $status = DebtsNotificationStatus::SUCCESS;
        $response = new DebtsNotifierResponse($status);

        $this->assertEquals(json_encode([
            DebtsNotifierResponse::STATUS_FIELD => $status->name,
            DebtsNotifierResponse::MESSAGE_FIELD => DebtsNotifierResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_notify_debts_failed_when_fail_notify()
    {
        $status = DebtsNotificationStatus::FAILED;
        $response = new DebtsNotifierResponse($status);

        $this->assertEquals(json_encode([
            DebtsNotifierResponse::STATUS_FIELD => $status->name,
            DebtsNotifierResponse::MESSAGE_FIELD => DebtsNotifierResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}