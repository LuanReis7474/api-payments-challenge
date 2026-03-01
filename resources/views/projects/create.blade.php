<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Projeto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 sm:p-8 antialiased">

    <div class="max-w-2xl mx-auto bg-white p-4 sm:p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Cadastrar Novo Projeto</h1>

        <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome do Projeto</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                    placeholder="Ex: Sistema de Gestão">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Projeto</label>
                <select name="type" id="type" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 bg-white">
                    
                    <option value="">-- Selecione o tipo de projeto --</option>
                    
                    <optgroup label="Construção Civil e Arquitetura">
                        <option value="Residencial" {{ old('type') == 'Residencial' ? 'selected' : '' }}>Obra Residencial</option>
                        <option value="Comercial" {{ old('type') == 'Comercial' ? 'selected' : '' }}>Obra Comercial / Corporativa</option>
                        <option value="Infraestrutura Civil" {{ old('type') == 'Infraestrutura Civil' ? 'selected' : '' }}>Infraestrutura e Obras Públicas</option>
                        <option value="Reforma/Interiores" {{ old('type') == 'Reforma/Interiores' ? 'selected' : '' }}>Reformas e Interiores</option>
                    </optgroup>

                    <optgroup label="Engenharia Eletrônica e Automação">
                        <option value="Sistemas Embarcados/IoT" {{ old('type') == 'Sistemas Embarcados/IoT' ? 'selected' : '' }}>Sistemas Embarcados / IoT</option>
                        <option value="Design de PCB" {{ old('type') == 'Design de PCB' ? 'selected' : '' }}>Desenvolvimento de Equipamentos</option>
                        <option value="Automação Industrial" {{ old('type') == 'Automação Industrial' ? 'selected' : '' }}>Automação Industrial</option>
                        <option value="Telecomunicações" {{ old('type') == 'Telecomunicações' ? 'selected' : '' }}>Telecomunicações</option>
                    </optgroup>

                    <optgroup label="Meio Ambiente e Sustentabilidade">
                        <option value="Energias Renováveis" {{ old('type') == 'Energias Renováveis' ? 'selected' : '' }}>Energias Renováveis (Solar, Eólica)</option>
                        <option value="Licenciamento Ambiental" {{ old('type') == 'Licenciamento Ambiental' ? 'selected' : '' }}>Licenciamento e Consultoria</option>
                        <option value="Gestão de Resíduos" {{ old('type') == 'Gestão de Resíduos' ? 'selected' : '' }}>Gestão e Tratamento de Resíduos</option>
                        <option value="Recuperação Ambiental" {{ old('type') == 'Recuperação Ambiental' ? 'selected' : '' }}>Recuperação de Áreas Degradadas</option>
                    </optgroup>

                    <optgroup label="Outras Áreas">
                        <option value="Engenharia Mecânica" {{ old('type') == 'Engenharia Mecânica' ? 'selected' : '' }}>Engenharia Mecânica / Máquinas</option>
                        <option value="Pesquisa e Desenvolvimento" {{ old('type') == 'Pesquisa e Desenvolvimento' ? 'selected' : '' }}>Pesquisa e Desenvolvimento</option>
                        <option value="Software/TI" {{ old('type') == 'Software/TI' ? 'selected' : '' }}>Software / TI (Apoio)</option>
                    </optgroup>

                    <option value="Outro" {{ old('type') == 'Outro' ? 'selected' : '' }}>Outro</option>
                </select>
                
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="total_budget" class="block text-sm font-medium text-gray-700">Orçamento Total (R$)</label>
                <input type="number" step="0.01" name="total_budget" id="total_budget" value="{{ old('total_budget') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                    placeholder="Ex: 5000.00">
                @error('total_budget')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="description" id="description" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"
                    placeholder="Detalhes sobre o projeto...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition-colors text-sm font-medium text-center w-full sm:w-auto">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium w-full sm:w-auto">
                    Salvar Projeto
                </button>
            </div>
        </form>
    </div>

</body>
</html>