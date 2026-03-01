<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Fornecedor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">

    <div class="max-w-2xl mx-auto bg-white p-4 sm:p-8 rounded-lg shadow-md">
        
        <div class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Cadastrar Novo Fornecedor</h1>
            <p class="text-gray-500 text-sm mt-1">Adicione um novo parceiro ou prestador de serviço ao catálogo global.</p>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Razão Social / Nome <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                    placeholder="Ex: Amazon Web Services, João Designer">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ (Opcional)</label>
                    <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                        placeholder="Ex: 00.000.000/0001-00">
                    @error('cnpj')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefone / Contato (Opcional)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                        placeholder="Ex: (11) 99999-9999">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('suppliers.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition-colors text-sm font-medium text-center w-full sm:w-auto">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium text-center w-full sm:w-auto">
                    Salvar Fornecedor
                </button>
            </div>
        </form>
    </div>

</body>
</html>