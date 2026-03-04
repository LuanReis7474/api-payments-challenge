<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Nome do Gasto</label>
        <input type="text" name="name" id="name" value="{{ old('name', $expense->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
            placeholder="Ex: Compra de Servidor">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="value" class="block text-sm font-medium text-gray-700">Valor (R$)</label>
        <input type="number" step="0.01" min="0" name="value" id="value"
            value="{{ old('value', $expense->value ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
            placeholder="Ex: 150.00">
        @error('value')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="date" class="block text-sm font-medium text-gray-700">Data do Gasto</label>
        <input type="date" name="date" id="date"
            value="{{ old('date', isset($expense) ? \Carbon\Carbon::parse($expense->date)->format('Y-m-d') : '') }}"
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
                <option value="0">-- Gasto Avulso (Sem Fornecedor) --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div x-show="supplierId" class="md:col-span-1" x-cloak x-transition>
            <label for="tax" class="block text-sm font-medium text-gray-700">Taxa administrativa repassada ao
                cliente (%)</label>
            <input type="number" step="0.01" name="tax" id="tax"
                value="{{ old('tax', $expense->tax ?? 0) }}"
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

            @php $cat = old('category', $expense->category ?? ''); @endphp

            <optgroup label="Tecnologia e Infraestrutura">
                <option value="Cloud/Hosting" {{ $cat == 'Cloud/Hosting' ? 'selected' : '' }}>Cloud / Hospedagem
                </option>
                <option value="Software/Licenças" {{ $cat == 'Software/Licenças' ? 'selected' : '' }}>Software e
                    Licenças</option>
                <option value="Hardware" {{ $cat == 'Hardware' ? 'selected' : '' }}>Hardware e Equipamentos</option>
                <option value="Segurança" {{ $cat == 'Segurança' ? 'selected' : '' }}>Segurança Digital</option>
            </optgroup>

            <optgroup label="Recursos Humanos e Serviços">
                <option value="Mão de Obra" {{ $cat == 'Mão de Obra' ? 'selected' : '' }}>Mão de Obra / Freelancer
                </option>
                <option value="Consultoria" {{ $cat == 'Consultoria' ? 'selected' : '' }}>Consultoria Especializada
                </option>
                <option value="Treinamento" {{ $cat == 'Treinamento' ? 'selected' : '' }}>Treinamento e Capacitação
                </option>
                <option value="Serviços Terceirizados" {{ $cat == 'Serviços Terceirizados' ? 'selected' : '' }}>
                    Serviços Terceirizados</option>
            </optgroup>

            <optgroup label="Operacional e Logística">
                <option value="Marketing" {{ $cat == 'Marketing' ? 'selected' : '' }}>Marketing e Publicidade</option>
                <option value="Viagens/Logística" {{ $cat == 'Viagens/Logística' ? 'selected' : '' }}>Viagens e
                    Deslocamento</option>
                <option value="Alimentação" {{ $cat == 'Alimentação' ? 'selected' : '' }}>Alimentação</option>
                <option value="Materiais" {{ $cat == 'Materiais' ? 'selected' : '' }}>Materiais de Consumo</option>
            </optgroup>

            <optgroup label="Financeiro e Legal">
                <option value="Impostos" {{ $cat == 'Impostos' ? 'selected' : '' }}>Impostos e Taxas Legais</option>
                <option value="Seguros" {{ $cat == 'Seguros' ? 'selected' : '' }}>Seguros</option>
                <option value="Encargos" {{ $cat == 'Encargos' ? 'selected' : '' }}>Encargos Financeiros</option>
            </optgroup>

            <option value="Outra" {{ $cat == 'Outra' ? 'selected' : '' }}>Outra</option>
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
        placeholder="Detalhes adicionais sobre este gasto...">{{ old('description', $expense->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
