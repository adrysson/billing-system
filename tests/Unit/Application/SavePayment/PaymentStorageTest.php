<?php

namespace Tests\Unit\Application\SavePayment;

use App\Application\SavePayment\PaymentStorage;
use App\Application\SavePayment\PaymentStorageResponse;
use App\Domain\Enum\PaymentStorageStatus;
use App\Domain\Repository\FindDebtRepository;
use App\Domain\Repository\SavePaymentRepository;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;
use Tests\Stubs\Domain\ValueObject\Payment\PayerNameStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentAmountStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentTimeStub;

class PaymentStorageTest extends TestCase
{
    /** @dataProvider provideDebtsStorageStatus */
    public function test_should_return_payment_storage_response_when_invoke(PaymentStorageStatus $paymentStorageStatus)
    {
        $debt = DebtStub::random();

        $debtRepository = \Mockery::mock(FindDebtRepository::class);
        $debtRepository->shouldReceive('find')
            ->with($debt->id)
            ->andReturn($debt);

        $paymentRepository = \Mockery::mock(SavePaymentRepository::class);
        $paymentRepository->shouldReceive('save')
            ->andReturn($paymentStorageStatus);

        $paymentTime = PaymentTimeStub::random();
        $paymentAmount = PaymentAmountStub::random();
        $payerName = PayerNameStub::random();

        $paymentStorage = new PaymentStorage(
            debtRepository: $debtRepository,
            paymentRepository: $paymentRepository,
        );

        $response = $paymentStorage(
            debtId: $debt->id,
            paymentTime: $paymentTime,
            paymentAmount: $paymentAmount,
            payerName: $payerName,
        );

        $this->assertInstanceOf(PaymentStorageResponse::class, $response);
    }

    public static function provideDebtsStorageStatus(): \Iterator
    {
        $paymentStorageStatusCases = PaymentStorageStatus::cases();

        foreach ($paymentStorageStatusCases as $paymentStorageStatus) {
            yield 'status-' . $paymentStorageStatus->name => [
                'status' => $paymentStorageStatus,
            ];
        }
    }
}