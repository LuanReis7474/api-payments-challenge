@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')
    <div class="mt-5 max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Fornecedores</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('projects.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors text-sm flex items-center justify-center w-full sm:w-auto">
                    Voltar aos Projetos
                </a>
                <a href="{{ route('suppliers.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors inline-block text-sm flex items-center justify-center w-full sm:w-auto">
                    + Novo Fornecedor
                </a>
            </div>
        </div>

        @if ($suppliers->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Não há fornecedores cadastrados no sistema.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Nome do Fornecedor</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                CNPJ</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Telefone / Contato</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Data de Cadastro</th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($suppliers as $supplier)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $supplier->name }}
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    @if ($supplier->cnpj)
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
                                            {{ $supplier->cnpj }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">Não informado</span>
                                    @endif
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $supplier->phone ?? 'Não informado' }}
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                    {{ $supplier->created_at->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="fornecedores/{{ $supplier->id }}/editar"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-900 rounded-md transition-colors border border-indigo-200"
                                            title="Editar Projeto">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>

                                        <button type="button" onclick="confirmedDestroy({{ $supplier->id }})"
                                            class="inline-flex items-center cursor-pointer justify-center w-8 h-8 bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-900 rounded-md transition-colors border border-red-200"
                                            title="Excluir Fornecedor">
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
        <div class="mt-4 sm:mt-6">
            {{ $suppliers->links() }}
        </div>

    </div>
@endsection

<form id="form-delete" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmedDestroy(id) {
        if (confirm('Tem certeza que deseja excluir este fornecedor? Esta ação não pode ser desfeita.')) {
            const form = document.getElementById('form-delete');
            form.action = `/fornecedores/${id}`;
            form.submit();
        }
    }
</script>
