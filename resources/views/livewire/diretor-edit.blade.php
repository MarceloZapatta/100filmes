<div>
    <x-slot name="header">
        Diretor {{ !empty($diretor) ? 'Editar' : 'Criar' }}
    </x-slot>
    <div class="mb-2">
        <label for="">
            Nome
        </label><br>
        <input type="text" wire:model="diretor.nome">
    </div>
    <div class="mt-2">
        <x-button wire:click="voltar">
            Cancelar
        </x-button>
        <x-button wire:click="salvar">
            Salvar
        </x-button>
    </div>
</div>
