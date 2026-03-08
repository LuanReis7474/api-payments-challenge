@extends('layouts.app')

@section('title', 'Projetos')

@section('content')
    <div class="mt-5 max-w-6xl mx-auto mb-6 px-4 sm:px-0 mt-4 sm:mt-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Gestão de Projetos
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Gerencie orçamentos, acompanhe despesas e controle seus projetos.
        </p>
    </div>
    <div class="max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Projetos</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('suppliers.index') }}"
                    class="bg-blue-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto flex items-center justify-center">
                    Meus Fornecedores
                </a>

                <a href="{{ route('projects.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors inline-block w-full sm:w-auto text-center flex items-center justify-center">
                    + Novo Projeto
                </a>
            </div>
        </div>
        @if ($projects->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Não há projetos cadastrados.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Nome</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Tipo</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Descrição</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Orçamento Total</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Gasto Atual</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Restante</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Custo ao Cliente</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Status projeto</th>
                            <th scope="col"
                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($projects as $project)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $project->name }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
                                        {{ $project->type }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 text-sm text-gray-500 max-w-[150px] truncate"
                                    title="{{ $project->description }}">
                                    {{ $project->description ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-semibold text-green-600">
                                    R$ {{ number_format($project->total_budget, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-semibold text-red-600">
                                    R$ {{ number_format($projectService->getCurrentExpenseTotal($project), 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-semibold">
                                    @php
                                        $remainingBudget = $projectService->getRemainingBudget($project);
                                    @endphp

                                    <div
                                        class="flex items-center justify-center gap-2 {{ $remainingBudget < 0 ? 'text-red-600' : 'text-blue-600' }}">

                                        @if ($remainingBudget < 0)
                                            <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-pulse shadow-sm"
                                                title="Orçamento Estourado!"></span>
                                        @endif

                                        R$ {{ number_format($remainingBudget, 2, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-semibold text-purple-600">
                                    R$ {{ number_format($projectService->getCostToCostumer($project), 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-semibold text-purple-600"
                                    x-data="{
                                        isAtivo: {{ $project->status ? 'true' : 'false' }},
                                        toggleStatus() {
                                            if (confirm('Tem certeza que deseja alterar o status desse projeto?')) {
                                                fetch(`/projetos/{{ $project->id }}/status`, {
                                                        method: 'PATCH',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                                                            'Accept': 'application/json'
                                                        },
                                                        body: JSON.stringify({ status: this.isAtivo ? 1 : 0 })
                                                    })
                                                    .then(res => {
                                                        if (res.ok) {
                                                            window.dispatchEvent(new CustomEvent('toast-sucesso'));
                                                        } else {
                                                            this.isAtivo = !this.isAtivo;
                                                        }
                                                    })
                                            }
                                        }
                                    }">

                                    <label
                                        class="inline-flex items-center cursor-pointer select-none touch-manipulation py-3 px-2">
                                        <input type="checkbox" x-model="isAtivo" @change="toggleStatus"
                                            class="sr-only peer">

                                        <div
                                            class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>

                                        <span class="ms-3 text-sm font-medium text-gray-700"
                                            x-text="isAtivo ? 'Ativo' : 'Inativo'"></span>
                                    </label>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="/projetos/{{ $project->id }}/editar"
                                            class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-900 rounded-md transition-colors border border-indigo-200"
                                            title="Editar Projeto">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>

                                        <a href="/projetos/{{ $project->id }}/gastos"
                                            class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 hover:text-emerald-900 rounded-md transition-colors border border-emerald-200"
                                            title="Incluir Gasto">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                            </svg>
                                        </a>

                                        <button type="button" onclick="confirmedDestroy({{ $project->id }})"
                                            class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-900 rounded-md transition-colors border border-red-200"
                                            title="Excluir Projeto">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div
            class="max-w-6xl mx-auto mt-8 sm:mt-12 mb-2 sm:mb-6 border-t border-gray-200 pt-4 sm:pt-6 text-center sm:text-right px-4 sm:px-0">
            <p class="text-sm text-gray-500">
                Desenvolvido por
                <a href="https://www.linkedin.com/in/luan-reis-de-carvalhotisrs/"
                    class="font-semibold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">
                    Luan Reis
                </a>
            </p>
        </div>
    </div>

    <div class="mt-6 px-4 sm:px-0 max-w-6xl mx-auto">
        {{ $projects->links() }}
    </div>

    <div x-data="{ show: false }" @toast-sucesso.window="show = true; setTimeout(() => show = false, 3000)" x-show="show"
        x-transition.opacity.duration.300ms
        class="fixed z-[9999] inset-x-0 bottom-5 mx-auto w-[92%] max-w-sm sm:w-auto sm:inset-x-auto sm:right-5 flex items-center p-4 space-x-3 text-gray-500 bg-white rounded-lg shadow-2xl border border-gray-200"
        style="display: none;" role="alert">

        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
        </div>
        <div class="ml-3 text-sm font-normal">Status atualizado com sucesso.</div>
    </div>

    <div x-data="{ show: false }" @toast-delete-sucesso.window="show = true; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition.opacity.duration.300ms
        class="fixed z-[9999] inset-x-0 bottom-5 mx-auto w-[92%] max-w-sm sm:w-auto sm:inset-x-auto sm:right-5 flex items-center p-4 space-x-3 text-gray-500 bg-white rounded-lg shadow-2xl border border-gray-200"
        style="display: none;" role="alert">

        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
        </div>
        <div class="ml-3 text-sm font-normal">Projeto apagado com sucesso.</div>
    </div>
@endsection

<form id="form-delete" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmedDestroy(id) {
        if (confirm('Tem certeza que deseja excluir este projeto? Esta ação não pode ser desfeita.')) {
            const form = document.getElementById('form-delete');
            form.action = `/projetos/${id}`;
            window.dispatchEvent(new CustomEvent('toast-delete-sucesso'));
            form.submit();
        }
    }
</script>
