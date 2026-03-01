<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos do Projeto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">

    <div class="max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        
        <div class="mb-6 border-b pb-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gastos do Projeto</h1>
                    <p class="text-gray-500 text-sm mt-1">Projeto: <span class="font-semibold text-gray-700">{{ $project->name }}</span></p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="{{ route('projects.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        Voltar aos Projetos
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        + Novo Fornecedor
                    </a>
                    <a href="{{ route('expenses.create', $project->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm text-center w-full sm:w-auto">
                        + Novo Gasto
                    </a>
                </div>
            </div>
        </div>

        @if($expenses->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Nenhuma despesa registrada para este projeto ainda.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Data</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nome</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Categoria</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Descrição</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Valor repassado ao cliente</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($expenses as $expense)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $expense->name }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <span class="bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-0.5 rounded border border-indigo-200">
                                        {{ $expense->category }}
                                    </span>
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-500 min-w-[200px] max-w-xs truncate" title="{{ $expense->description }}">
                                    {{ $expense->description ?? '-' }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600">
                                    @if($expenseService->getCalculator($expense)->getTaxAmount($expense) > 0) 
                                        R$ {{ number_format($expenseService->getCalculator($expense)->getTaxAmount($expense), 2, ',', '.') }}
                                    @else
                                        R$ 0,00
                                    @endif
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600">
                                    R$ {{ number_format($expenseService->getCalculator($expense)->getFinalAmount($expense), 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4 sm