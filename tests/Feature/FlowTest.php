<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Supplier;

class PortfolioFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_flow_with_session(): void
    {
        $this->withSession(['test_user' => true]);

        $sessionId = session()->getId();

        $this->post(route('projects.store'), [
            'name' => 'Projeto Teste',
            'type' => 'Comercial',
            'description' => 'ativo',
            'total_budget' => 'Cem reais'
        ])->assertRedirect(route('projects.index'));


        $this->post(route('suppliers.store'), [
            'name' => 'Teste fornecedor',
            'cnpj' => '11.111.111/0001-11',
            'phone' => '11999999999'
        ])->assertRedirect(route('suppliers.index'));

        $project = Project::first();
        $supplier = Supplier::first();

        $this->post(route('expenses.store', ['project' => $project->id]), [
            'name' => 'Gasto teste',
            'value' => 500.00,
            'date' => '2026-03-05',
            'category' => 'Ferramentas',
            'supplier_id' => $supplier->id,
            'description' => 'TESTE'
        ])->assertRedirect(route('expenses.index', ['project' => $project->id]));



        $this->assertDatabaseHas('projects', [
            'name' => 'Nome Completamente Errado',
            'session_id' => $project->session_id
        ]);

        $this->assertDatabaseHas('suppliers', [
            'name' => 'Teste fornecedor',
            'session_id' => $supplier->session_id
        ]);

        $this->assertDatabaseHas('expenses', [
            'name' => 'Gasto teste',
            'project_id' => $project->id,
            'supplier_id' => $supplier->id
        ]);
    }
}
