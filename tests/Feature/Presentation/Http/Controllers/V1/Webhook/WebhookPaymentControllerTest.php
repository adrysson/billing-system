<?php

namespace Tests\Feature\Presentation\Http\Controllers\V1\Webhook;

use App\Application\SavePayment\PaymentStorageResponse;
use App\Domain\Enum\PaymentStorageStatus;
use App\Infraestructure\Models\Debt;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Stubs\Domain\Entity\PaymentStub;
use Tests\TestCase;

class WebhookPaymentControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_return_success_response_when_all_required_data_send_sucessful(): void
    {
        $payment = PaymentStub::random();

        Debt::insert([
            Debt::ID => $payment->debt->id->value,
            Debt::NAME => $payment->debt->debtor->name->value,
            Debt::GOVERNMENT_ID => $payment->debt->debtor->governmentId->value,
            Debt::EMAIL => $payment->debt->debtor->email->value,
            Debt::AMOUNT => $payment->amount->value,
            Debt::DUE_DATE => $payment->debt->dueDate->value,
        ]);

        $response = $this->postJson('/api/v1/webhook/payments', [
            'debtId' => $payment->debt->id->value,
            'paidAt' => $payment->paymentTime->value,
            'paidAmount' => $payment->amount->value,
            'paidBy' => $payment->payerName->value,
        ]);

        $response->assertStatus(200);

        $expectedResponse = new PaymentStorageResponse(PaymentStorageStatus::SUCCESS);

        $this->assertEquals(json_encode($expectedResponse), json_encode($response->original));
    }
}