<?php

namespace App\Http\Controllers;

use App\Services\Projects\ProjectService;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(ProjectService $projectService): View
    {
        $projects = Project::where('session_id', session()->getId())
                           ->orderBy('created_at', 'desc')
                           ->paginate(5);
        return view('projects.index', compact('projects', 'projectService')); 
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function update(): View
    {
        return view('projects.update');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|string|max:100',
            'description'  => 'nullable|string',
            'total_budget' => 'required|numeric|min:0', 
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'total_budget.numeric' => 'O orçamento deve ser um valor numérico.'
        ]);

        $validatedData['session_id'] = session()->getId();

        Project::create($validatedData);
        
        return redirect()->route('projects.index')->with('success', 'Projeto cadastrado com sucesso!');
    }
}
