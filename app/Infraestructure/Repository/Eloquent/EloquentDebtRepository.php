<?php

namespace App\Infraestructure\Repository\Eloquent;

use App\Domain\Collection\DebtCollection;
use App\Domain\Collection\PaymentCollection;
use App\Domain\Entity\Debt;
use App\Domain\Entity\Debtor;
use App\Domain\Entity\Payment;
use App\Domain\Enum\DebtsStorageStatus;
use App\Domain\Repository\FindDebtRepository;
use App\Domain\Repository\GetPendingDebtsRepository;
use App\Domain\Repository\SaveDebtRepository;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Debt\DebtDueDate;
use App\Domain\ValueObject\Debt\DebtId;
use App\Domain\ValueObject\Debtor\DebtorEmail;
use App\Domain\ValueObject\Debtor\DebtorName;
use App\Domain\ValueObject\GovernmentId;
use App\Domain\ValueObject\Payment\PayerName;
use App\Domain\ValueObject\Payment\PaymentTime;
use App\Infraestructure\Models\Debt as DebtModel;
use App\Infraestructure\Models\Payment as PaymentModel;

class EloquentDebtRepository implements SaveDebtRepository, FindDebtRepository, GetPendingDebtsRepository
{
    public function saveAll(DebtCollection $debts): DebtsStorageStatus
    {
        $data = [];

        foreach ($debts->getIterator() as $debt) {
            $data[] = [
                DebtModel::ID => $debt->id->value,
                DebtModel::NAME => $debt->debtor->name->value,
                DebtModel::GOVERNMENT_ID => $debt->debtor->governmentId->value,
                DebtModel::EMAIL => $debt->debtor->email->value,
                DebtModel::AMOUNT => $debt->amount->value,
                DebtModel::DUE_DATE => $debt->dueDate->value,
            ];
        }

        if (DebtModel::insert($data)) {
            return DebtsStorageStatus::SUCCESS;
        }

        return DebtsStorageStatus::FAILED;
    }

    public function find(DebtId $debtId): Debt
    {
        $debt = DebtModel::find($debtId->value);

        return $this->makeDebtFromModel($debt);
    }

    public function getPendings(): DebtCollection
    {
        $debts = new DebtCollection;

        $pendingDebts = DebtModel::whereRaw('(select sum(`payments`.`amount`) from `payments` where `debts`.`id` = `payments`.`debt_id`) < `debts`.`amount`')
            ->orDoesntHave('payments')->get();

        foreach ($pendingDebts as $debt) {
            $debts->push($this->makeDebtFromModel($debt));
        }

        return $debts;
    }

    private function makeDebtFromModel(DebtModel $debt): Debt
    {
        $debtorName = $debt->{DebtModel::NAME};
        $governmentId = $debt->{DebtModel::GOVERNMENT_ID};
        $debtorEmail = $debt->{DebtModel::EMAIL};

        $debtor = new Debtor(
            name: DebtorName::create($debtorName),
            governmentId: GovernmentId::create($governmentId),
            email: DebtorEmail::create($debtorEmail),
        );

        $debtId = $debt->{DebtModel::ID};
        $debtAmount = $debt->{DebtModel::AMOUNT};
        $debtDueDate = $debt->{DebtModel::DUE_DATE};

        $payments = new PaymentCollection;
        foreach ($debt->{DebtModel::PAYMENTS} as $payment) {
            $payments->push(new Payment(
                paymentTime: PaymentTime::create($payment->{PaymentModel::PAID_AT}),
                amount: Currency::create($payment->{PaymentModel::AMOUNT}),
                payerName: PayerName::create($payment->{PaymentModel::PAID_BY})
            ));
        }

        return new Debt(
            debtor: $debtor,
            id: DebtId::create($debtId),
            amount: Currency::create($debtAmount),
            dueDate: DebtDueDate::create($debtDueDate),
            payments: $payments,
        );
    }
}