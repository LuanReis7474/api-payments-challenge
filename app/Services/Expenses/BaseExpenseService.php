<?php

namespace App\Services\Expenses;

use App\Interfaces\ExpenseInterface;
use App\Models\Expense;

class BaseExpenseService implements ExpenseInterface
{

    public function getFinalAmount(Expense $expense): float
    {
        return $expense->value;
    }

    public function getSummary(Expense $expense): string
    {
        return 'Despesa de R$' . number_format($expense->value, 2, ',', '.') . ' para o projeto ' . $expense->project->name;
    }

    public function getTaxAmount(Expense $expense): float
    {
        return 0;
    }
}
