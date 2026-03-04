<?php

namespace App\Interfaces;

use App\Models\Expense;

interface ExpenseInterface
{
    public function getFinalAmount(Expense $expense): float;
    public function getSummary(Expense $expense): string;
    public function getTaxAmount(Expense $expense): float;
}
