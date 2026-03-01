<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Project;
use App\Models\Supplier; 
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Expenses\ExpenseService;
use App\Http\Requests\Expenses\BaseExpenseRequest;
use App\Http\Requests\Expenses\ComercialExpenseRequest;

class ExpenseController extends Controller
{
    public function index(Project $project, ExpenseService $expenseService): View
    {
        $expenses = $project->expenses()->with('supplier')->orderBy('created_at', 'desc')->paginate(5);
        return view('expenses.index', compact('project', 'expenses', 'expenseService'));
    }

    public function create(Project $project): View
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('expenses.create', compact('project', 'suppliers'));
    }


    public function store(Request $request, Project $project)
    {
       if ($request->filled('supplier_id')) {
          
            $validatedRequest = app(ComercialExpenseRequest::class);
        } else {
            $validatedRequest = app(BaseExpenseRequest::class);
        }

        $validatedData = $validatedRequest->validated();

        $expense = $project->expenses()->create($validatedData);

        return redirect()->route('expenses.index', $project->id)
                         ->with('success', 'Gasto cadastrado com sucesso!');
    }
}
