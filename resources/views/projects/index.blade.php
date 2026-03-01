<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Projetos</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">
    <div class="max-w-6xl mx-auto mb-6 px-4 sm:px-0 mt-4 sm:mt-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Gestão de Projetos
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Gerencie orçamentos, acompanhe despesas e controle seus projetos.
        </p>
    </div>
    <div class="max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Projetos</h1>
            
            <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors inline-block w-full sm:w-auto text-center">
                + Novo Projeto
            </a>
        </div>
        
        @if($projects->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Não há projetos cadastrados.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nome</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Tipo</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Descrição</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Orçamento total</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Gasto atual</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Orçamento restante</th>
                            <th scope="col" colspan="2" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Custo ao cliente</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($projects as $project)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $project->name }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
                                        {{ $project->type }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-500 min-w-[200px] max-w-xs truncate">
                                    {{ $project->description ?? '-' }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                    R$ {{ number_format($project->total_budget, 2, ',', '.') }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-red-600">
                                    R$ {{ number_format($projectService->getCurrentExpenseTotal($project), 2, ',', '.') }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">
                                    R$ {{ number_format($projectService->getRemainingBudget($project), 2, ',', '.') }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-purple-600">
                                    R$ {{ number_format($projectService->getCostToCostumer($project), 2, ',', '.') }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/projetos/{{$project->id}}/gastos" 
                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-900 rounded-md transition-colors text-xs font-semibold border border-indigo-200 w-full justify-center sm:w-auto mt-2 sm:mt-0">
                                        + Incluir Gasto
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        <div class="max-w-6xl mx-auto mt-8 sm:mt-12 mb-2 sm:mb-6 border-t border-gray-200 pt-4 sm:pt-6 text-center sm:text-right px-4 sm:px-0">
            <p class="text-sm text-gray-500">
                Desenvolvido por 
                <a href="https://www.linkedin.com/in/luan-reis-de-carvalhotisrs/" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">
                    Luan  Reis
                </a>
            </p>
        </div>
    </div>

    <div class="mt-6 px-4 sm:px-0 max-w-6xl mx-auto">
        {{ $projects->links() }}
    </div>

</body>
</html>