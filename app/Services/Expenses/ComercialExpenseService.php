<?php

namespace App\Services\Expenses;

use App\Models\Expense;

class ComercialExpenseService extends BaseExpenseService
{
    public function getFinalAmount(Expense $expense): float
    {
        $valueAmount = $expense->value;
        $taxValue = $expense->tax ?? 0;

        if ($taxValue > 0) {
            $taxValue = ($taxValue / 100) * $valueAmount;
        }

        return $valueAmount + $taxValue;
    }

    public function getSummary(Expense $expense): string
    {
        $nomeFornecedor = $expense->supplier->name ?? 'Fornecedor Desconhecido';
        return 'Gastos de R$' . number_format($this->getFinalAmount($expense), 2, ',', '.') . ' para o projeto com o fornecedor ' . $nomeFornecedor;
    }

    public function getTaxAmount(Expense $expense): float
    {
        $valueAmount = $expense->value;
        $taxValue = $expense->tax ?? 0;

        if ($taxValue <= 0) {
            return 0;
        }

        return ($taxValue / 100) * $valueAmount;
    }
}
