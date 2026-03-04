<?php

namespace App\Services\Expenses;

use App\Models\Expense;
use App\Interfaces\ExpenseInterface;

class ExpenseService
{
    public function getCalculator(Expense $expense): ExpenseInterface
    {
        if ($expense->supplier_id) {
            return new ComercialExpenseService($expense);
        }

        return new BaseExpenseService($expense);
    }
}
