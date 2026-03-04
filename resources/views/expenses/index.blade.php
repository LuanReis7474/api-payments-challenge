@extends('layouts.app')

@section('title', 'Novo Gasto')

@section('content')
    <div class="mt-5 max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">

        <div class="mb-6 border-b pb-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gastos do Projeto</h1>
                    <p class="text-gray-500 text-sm mt-1">Projeto: <span
                            class="font-semibold text-gray-700">{{ $project->name }}</span></p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('projects.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        Voltar aos Projetos
                    </a>
                    <a href="{{ route('suppliers.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        Meus Fornecedor
                    </a>
                    <a href="{{ route('expenses.create', $project->id) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        + Novo Gasto
                    </a>
                </div>
            </div>
        </div>

        @if ($expenses->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Nenhuma despesa registrada para este projeto ainda.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Data</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Nome</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Categoria</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Descrição</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Valor repassado ao cliente</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Gasto Total</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($expenses as $expense)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $expense->name }}
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <span
                                        class="bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-0.5 rounded border border-indigo-200">
                                        {{ $expense->category }}
                                    </span>
                                </td>

                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-500 min-w-[200px] max-w-xs truncate"
                                    title="{{ $expense->description }}">
                                    {{ $expense->description ?? '-' }}
                                </td>

                                <td
                                    class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600">
                                    @if ($expenseService->getCalculator($expense)->getTaxAmount($expense) > 0)
                                        R$
                                        {{ number_format($expenseService->getCalculator($expense)->getTaxAmount($expense), 2, ',', '.') }}
                                    @else
                                        R$ 0,00
                                    @endif
                                </td>

                                <td
                                    class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600">
                                    R$
                                    {{ number_format($expense->value, 2, ',', '.') }}
                                </td>

                                <td
                                    class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600">
                                    <a href="/projetos/{{ $project->id }}/gastos/{{ $expense->id }}/editar"
                                        class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-900 rounded-md transition-colors border border-indigo-200"
                                        title="Editar Gasto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    <button type="button"
                                        onclick="confirmedDestroy({{ $project->id }}, {{ $expense->id }})"
                                        class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-900 rounded-md transition-colors border border-red-200"
                                        title="Excluir Projeto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4 sm:mt-6">
        {{ $expenses->links() }}
    </div>

@endsection

<form id="form-delete" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmedDestroy(projectId, expenseId) {
        if (confirm('Tem certeza que deseja excluir este gasto? Esta ação não pode ser desfeita.')) {
            const form = document.getElementById('form-delete');
            form.action = `/projetos/${projectId}/gastos/${expenseId}`;
            form.submit();
        }
    }
</script>
