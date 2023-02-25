<?php

namespace App\Application\SavePayment;

use App\Domain\Entity\Payment;
use App\Domain\Repository\FindDebtRepository;
use App\Domain\Repository\SavePaymentRepository;
use App\Domain\ValueObject\Debt\DebtId;
use App\Domain\ValueObject\Payment\PayerName;
use App\Domain\ValueObject\Payment\PaymentAmount;
use App\Domain\ValueObject\Payment\PaymentTime;

class PaymentStorage
{
    public function __construct(
        private FindDebtRepository $debtRepository,
        private SavePaymentRepository $paymentRepository
    )
    {
    }

    public function __invoke(
        DebtId $debtId,
        PaymentTime $paymentTime,
        PaymentAmount $paymentAmount,
        PayerName $payerName,
    ): PaymentStorageResponse
    {
        $debt = $this->debtRepository->find($debtId);

        $payment = new Payment(
            paymentTime: $paymentTime,
            amount: $paymentAmount,
            payerName: $payerName,
            debt: $debt,
        );

        $paymentSaved = $this->paymentRepository->save($payment);

        return new PaymentStorageResponse($paymentSaved);
    }
}