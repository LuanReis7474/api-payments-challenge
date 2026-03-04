@extends('layouts.app')

@section('title', 'Novo Projeto')

@section('content')
    <div class="mt-5 max-w-2xl mx-auto bg-white p-4 sm:p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Cadastrar Novo Projeto</h1>

        <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('projects.partials._form')

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('projects.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition-colors text-sm font-medium text-center w-full sm:w-auto">
                    Cancelar
                </a>
                <button type="submit"
                    class="cursor-pointer px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium w-full sm:w-auto">
                    Salvar Projeto
                </button>
            </div>


        </form>
    </div>
@endsection
