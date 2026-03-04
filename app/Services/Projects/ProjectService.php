<?php

namespace App\Services\Projects;

use App\Interfaces\ProjectInterface;
use App\Models\Project;

class ProjectService implements ProjectInterface
{
    public function getCurrentExpenseTotal(Project $project): float
    {
        return (float) $project->expenses()->sum('value');
    }

    public function getRemainingBudget(Project $project): float
    {
        return (float) $project->total_budget - $this->getCurrentExpenseTotal($project);
    }

    public function getCostToCostumer(Project $project): float
    {
        $totalWithTaxes = $project->expenses()
            ->selectRaw('SUM(value + (value * tax / 100)) as total_cost')
            ->value('total_cost');

        return (float) $totalWithTaxes;
    }
}
