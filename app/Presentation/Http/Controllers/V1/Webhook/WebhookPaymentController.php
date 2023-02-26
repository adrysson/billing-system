<?php

namespace App\Presentation\Http\Controllers\V1\Webhook;

use App\Application\SavePayment\PaymentStorage;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Debt\DebtId;
use App\Domain\ValueObject\Payment\PayerName;
use App\Domain\ValueObject\Payment\PaymentTime;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\V1\Webhook\WebhookStorePaymentRequest;

class WebhookPaymentController extends Controller
{
    public function __construct(
        private PaymentStorage $paymentStorage,
    )
    {
    }

    public function store(WebhookStorePaymentRequest $request)
    {
        $debtId = DebtId::create($request->{WebhookStorePaymentRequest::DEBT_ID});
        $paymentTime = PaymentTime::create($request->{WebhookStorePaymentRequest::PAID_AT});
        $paymentAmount = Currency::create($request->{WebhookStorePaymentRequest::PAID_AMOUNT});
        $payerName = PayerName::create($request->{WebhookStorePaymentRequest::PAID_BY});

        $response = ($this->paymentStorage)(
            debtId: $debtId,
            paymentTime: $paymentTime,
            paymentAmount: $paymentAmount,
            payerName: $payerName,
        );

        return response()->json($response);
    }
}
