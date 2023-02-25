<?php

namespace Tests\Unit\Application\ChargeDebts;

use App\Application\ChargeDebts\DebtsChargerResponse;
use App\Domain\Enum\DebtsChargeStatus;
use PHPUnit\Framework\TestCase;

class DebtsChargerResponseTest extends TestCase
{
    public function test_should_return_message_of_charge_debts_in_progress_when_charge_in_progress()
    {
        $status = DebtsChargeStatus::IN_PROGRESS;
        $response = new DebtsChargerResponse($status);

        $this->assertEquals(json_encode([
            DebtsChargerResponse::STATUS_FIELD => $status->name,
            DebtsChargerResponse::MESSAGE_FIELD => DebtsChargerResponse::IN_PROGRESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_debts_charged_when_sucess_charge()
    {
        $status = DebtsChargeStatus::SUCCESS;
        $response = new DebtsChargerResponse($status);

        $this->assertEquals(json_encode([
            DebtsChargerResponse::STATUS_FIELD => $status->name,
            DebtsChargerResponse::MESSAGE_FIELD => DebtsChargerResponse::SUCCESS_MESSAGE,
        ]), json_encode($response));
    }

    public function test_should_return_message_of_charge_debts_failed_when_fail_charge()
    {
        $status = DebtsChargeStatus::FAILED;
        $response = new DebtsChargerResponse($status);

        $this->assertEquals(json_encode([
            DebtsChargerResponse::STATUS_FIELD => $status->name,
            DebtsChargerResponse::MESSAGE_FIELD => DebtsChargerResponse::FAIL_MESSAGE,
        ]), json_encode($response));
    }
}