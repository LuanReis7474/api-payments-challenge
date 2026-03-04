@extends('layouts.app')

@section('title', 'Editar Gastos')

@section('content')
    <div class="mt-5 max-w-2xl mx-auto bg-white p-5 sm:p-8 rounded-lg shadow-md">

        <div class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Cadastrar Novo Gasto</h1>
            <p class="text-gray-500 text-sm mt-1">Projeto: <span
                    class="font-semibold text-gray-700">{{ $project->name }}</span></p>
        </div>

        <form action="{{ route('expenses.update', [$project->id, $expense->id]) }}" method="POST" class="space-y-6"
            x-data="{ supplierId: '{{ old('supplier_id', $expense->supplier_id ?? '') }}' }">
            @csrf
            @method('PUT')
            @include('expenses.partials._form')

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('expenses.index', $project->id) }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition-colors text-sm font-medium text-center">
                    Cancelar
                </a>
                <button type="submit"
                    class="cursor-pointer px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium text-center">
                    Salvar Gasto
                </button>
            </div>
        </form>
    </div>
@endsection
