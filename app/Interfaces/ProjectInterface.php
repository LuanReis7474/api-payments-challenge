<?php

namespace App\Interfaces;

use App\Models\Project;

interface ProjectInterface
{
    public function getCurrentExpenseTotal(Project $project): float;

    public function getRemainingBudget(Project $project): float;

    public function getCostToCostumer(Project $project): float;
}
