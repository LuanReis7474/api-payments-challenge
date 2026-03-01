<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Gasto - {{ $project->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">

    <div class="max-w-2xl mx-auto bg-white p-5 sm:p-8 rounded-lg shadow-md">

        <div class="mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Cadastrar Novo Gasto</h1>
            <p class="text-gray-500 text-sm mt-1">Projeto: <span class="font-semibold text-gray-700">{{ $project->name }}</span></p>
        </div>

        <form action="{{ route('expenses.store', $project->id) }}" method="POST" class="space-y-6" x-data="{ supplierId: '{{ old('supplier_id') }}' }">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome do Gasto</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                        placeholder="Ex: Compra de Servidor">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700">Valor (R$)</label>
                    <input type="number" step="0.01" min="0" name="value" id="value" value="{{ old('value') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                        placeholder="Ex: 150.00">
                    @error('value')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Data do Gasto</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
    
                    <div :class="supplierId ? 'md:col-span-1' : 'md:col-span-2'">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Fornecedor (Opcional)</label>
                        <select name="supplier_id" id="supplier_id" x-model="supplierId" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 bg-white">
                            <option value="">-- Gasto Avulso (Sem Fornecedor) --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-show="supplierId" class="md:col-span-1" x-cloak x-transition>
                        <label for="tax" class="block text-sm font-medium text-gray-700">Taxa administrativa repassada ao cliente (%)</label>
                        <input type="number" step="0.01" name="tax" id="tax" value="{{ old('tax', 0) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                            placeholder="Ex: 5">
                        @error('tax')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select name="category" id="category" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 bg-white">
                        
                        <option value="">-- Selecione uma categoria --</option>

                        <optgroup label="Tecnologia e Infraestrutura">
                            <option value="Cloud/Hosting" {{ old('category') == 'Cloud/Hosting' ? 'selected' : '' }}>Cloud / Hospedagem</option>
                            <option value="Software/Licenças" {{ old('category') == 'Software/Licenças' ? 'selected' : '' }}>Software e Licenças</option>
                            <option value="Hardware" {{ old('category') == 'Hardware' ? 'selected' : '' }}>Hardware e Equipamentos</option>
                            <option value="Segurança" {{ old('category') == 'Segurança' ? 'selected' : '' }}>Segurança Digital</option>
                        </optgroup>

                        <optgroup label="Recursos Humanos e Serviços">
                            <option value="Mão de Obra" {{ old('category') == 'Mão de Obra' ? 'selected' : '' }}>Mão de Obra / Freelancer</option>
                            <option value="Consultoria" {{ old('category') == 'Consultoria' ? 'selected' : '' }}>Consultoria Especializada</option>
                            <option value="Treinamento" {{ old('category') == 'Treinamento' ? 'selected' : '' }}>Treinamento e Capacitação</option>
                            <option value="Serviços Terceirizados" {{ old('category') == 'Serviços Terceirizados' ? 'selected' : '' }}>Serviços Terceirizados</option>
                        </optgroup>

                        <optgroup label="Operacional e Logística">
                            <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing e Publicidade</option>
                            <option value="Viagens/Logística" {{ old('category') == 'Viagens/Logística' ? 'selected' : '' }}>Viagens e Deslocamento</option>
                            <option value="Alimentação" {{ old('category') == 'Alimentação' ? 'selected' : '' }}>Alimentação</option>
                            <option value="Materiais" {{ old('category') == 'Materiais' ? 'selected' : '' }}>Materiais de Consumo</option>
                        </optgroup>

                        <optgroup label="Financeiro e Legal">
                            <option value="Impostos" {{ old('category') == 'Impostos' ? 'selected' : '' }}>Impostos e Taxas Legais</option>
                            <option value="Seguros" {{ old('category') == 'Seguros' ? 'selected' : '' }}>Seguros</option>
                            <option value="Encargos" {{ old('category') == 'Encargos' ? 'selected' : '' }}>Encargos Financeiros</option>
                        </optgroup>

                        <option value="Outra" {{ old('category') == 'Outra' ? 'selected' : '' }}>Outra</option>
                    </select>

                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição Detalhada</label>
                <textarea name="description" id="description" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                    placeholder="Detalhes adicionais sobre este gasto...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('expenses.index', $project->id) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition-colors text-sm font-medium text-center">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium text-center">
                    Salvar Gasto
                </button>
            </div>
        </form>
    </div>

</body>
</html>