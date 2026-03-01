<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Fornecedores</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">

    <div class="max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Fornecedores</h1>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('projects.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors text-sm flex items-center justify-center w-full sm:w-auto">
                    Voltar aos Projetos
                </a>
                <a href="{{ route('suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors inline-block text-sm flex items-center justify-center w-full sm:w-auto">
                    + Novo Fornecedor
                </a>
            </div>
        </div>

        @if($suppliers->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                <p class="text-yellow-700">Não há fornecedores cadastrados no sistema.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nome do Fornecedor</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">CNPJ</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Telefone / Contato</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Data de Cadastro</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($suppliers as $supplier)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $supplier->name }}
                                </td>
                                
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    @if($supplier->cnpj)
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
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

</body>
</html>