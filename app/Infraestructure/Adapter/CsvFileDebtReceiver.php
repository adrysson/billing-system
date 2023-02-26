<?php

namespace App\Infraestructure\Adapter;

use App\Domain\Adapter\FileDebtReceiver;
use App\Domain\Collection\DebtCollection;
use App\Domain\Entity\Debt;
use App\Domain\Entity\Debtor;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Debt\DebtDueDate;
use App\Domain\ValueObject\Debt\DebtId;
use App\Domain\ValueObject\Debtor\DebtorEmail;
use App\Domain\ValueObject\Debtor\DebtorName;
use App\Domain\ValueObject\GovernmentId;

class CsvFileDebtReceiver implements FileDebtReceiver
{
    public const DEBTOR_NAME = 'name';
    public const DEBTOR_GOVERNMENT_ID = 'governmentId';
    public const DEBTOR_EMAIL = 'email';
    public const DEBT_AMOUNT = 'debtAmount';
    public const DEBT_DUE_DATE = 'debtDueDate';
    public const DEBT_ID = 'debtId';

    public function receive(\SplFileInfo $file): DebtCollection
    {
        $rows = $this->rows($file);

        $header = array_shift($rows);

        $data = $this->addHeaderKeys($header, $rows);

        $debts = new DebtCollection;

        foreach ($data as $item) {
            $debtor = new Debtor(
                name: DebtorName::create($item[self::DEBTOR_NAME]),
                governmentId: GovernmentId::create($item[self::DEBTOR_GOVERNMENT_ID]),
                email: DebtorEmail::create($item[self::DEBTOR_EMAIL]),
            );

            $debt = new Debt(
                debtor: $debtor,
                id: DebtId::create($item[self::DEBT_ID]),
                amount: Currency::create($item[self::DEBT_AMOUNT]),
                dueDate: DebtDueDate::create($item[self::DEBT_DUE_DATE]),
            );

            $debts->push($debt);
        }

        return $debts;
    }

    private function rows(\SplFileInfo $file): array
    {
        $rows = [];

        if (($open = fopen($file->getRealPath(), 'r')) !== false) {

            while (($data = fgetcsv($open)) !== false) {
                $rows[] = $data;
            }

            fclose($open);
        }

        return $rows;
    }

    private function addHeaderKeys(array $headers, array $rows): array
    {
        $data = [];

        foreach ($rows as $row) {
            $rowData = [];
            foreach ($row as $key => $item) {
                $header = $headers[$key];
                $rowData[$header] = $item;
            }
            $data[] = $rowData;
        }

        return $data;
    }
}