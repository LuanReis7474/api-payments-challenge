<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Nome do Projeto</label>
    <input type="text" name="name" id="name" value="{{ old('name', $project->name ?? '') }}"
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
            <option value="Residencial" {{ old('type', $project->type ?? '') == 'Residencial' ? 'selected' : '' }}>Obra
                Residencial</option>
            <option value="Comercial" {{ old('type', $project->type ?? '') == 'Comercial' ? 'selected' : '' }}>Obra
                Comercial / Corporativa</option>
            <option value="Infraestrutura Civil"
                {{ old('type', $project->type ?? '') == 'Infraestrutura Civil' ? 'selected' : '' }}>Infraestrutura e
                Obras Públicas</option>
            <option value="Reforma/Interiores"
                {{ old('type', $project->type ?? '') == 'Reforma/Interiores' ? 'selected' : '' }}>Reformas e Interiores
            </option>
        </optgroup>

        <optgroup label="Engenharia Eletrônica e Automação">
            <option value="Sistemas Embarcados/IoT"
                {{ old('type', $project->type ?? '') == 'Sistemas Embarcados/IoT' ? 'selected' : '' }}>Sistemas
                Embarcados / IoT</option>
            <option value="Design de PCB" {{ old('type', $project->type ?? '') == 'Design de PCB' ? 'selected' : '' }}>
                Desenvolvimento de Equipamentos</option>
            <option value="Automação Industrial"
                {{ old('type', $project->type ?? '') == 'Automação Industrial' ? 'selected' : '' }}>Automação Industrial
            </option>
            <option value="Telecomunicações"
                {{ old('type', $project->type ?? '') == 'Telecomunicações' ? 'selected' : '' }}>Telecomunicações
            </option>
        </optgroup>

        <optgroup label="Meio Ambiente e Sustentabilidade">
            <option value="Energias Renováveis"
                {{ old('type', $project->type ?? '') == 'Energias Renováveis' ? 'selected' : '' }}>Energias Renováveis
                (Solar, Eólica)</option>
            <option value="Licenciamento Ambiental"
                {{ old('type', $project->type ?? '') == 'Licenciamento Ambiental' ? 'selected' : '' }}>Licenciamento e
                Consultoria</option>
            <option value="Gestão de Resíduos"
                {{ old('type', $project->type ?? '') == 'Gestão de Resíduos' ? 'selected' : '' }}>Gestão e Tratamento
                de Resíduos</option>
            <option value="Recuperação Ambiental"
                {{ old('type', $project->type ?? '') == 'Recuperação Ambiental' ? 'selected' : '' }}>Recuperação de
                Áreas Degradadas</option>
        </optgroup>

        <optgroup label="Outras Áreas">
            <option value="Engenharia Mecânica"
                {{ old('type', $project->type ?? '') == 'Engenharia Mecânica' ? 'selected' : '' }}>Engenharia Mecânica
                / Máquinas</option>
            <option value="Pesquisa e Desenvolvimento"
                {{ old('type', $project->type ?? '') == 'Pesquisa e Desenvolvimento' ? 'selected' : '' }}>Pesquisa e
                Desenvolvimento</option>
            <option value="Software/TI" {{ old('type', $project->type ?? '') == 'Software/TI' ? 'selected' : '' }}>
                Software / TI (Apoio)</option>
        </optgroup>

        <option value="Outro" {{ old('type', $project->type ?? '') == 'Outro' ? 'selected' : '' }}>Outro</option>
    </select>

    @error('type')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="total_budget" class="block text-sm font-medium text-gray-700">Orçamento Total (R$)</label>
    <input type="number" step="0.01" name="total_budget" id="total_budget"
        value="{{ old('total_budget', $project->total_budget ?? '') }}"
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
        placeholder="Detalhes sobre o projeto...">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
