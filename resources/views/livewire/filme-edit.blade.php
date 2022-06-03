<div>
    <x-slot name="header">
        Filme {{ !empty($diretor) ? 'Editar' : 'Criar' }}
    </x-slot>
    <div class="mb-2">
        @if ($filme->foto ?? false)
        <img src="{{ Storage::url($filme->foto) }}" alt="" style="max-width: 400px;max-heigth: 400px">
        @endif
        <label for="">
            Foto
        </label><br>
        <input type="file" wire:model="foto" accept="image/*">
        @error('foto') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label for="">
            Nome
        </label><br>
        <input type="text" wire:model="filme.nome">
        @error('filme.nome') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label for="">
            Ano
        </label><br>
        <input type="number" wire:model="filme.ano" max="{{ date('Y') }}" min="1900">
        @error('filme.ano') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label for="">
            Diretor
        </label><br>
        <select wire:model="filme.diretor_id">
            @foreach ($diretores as $diretor)
            <option value="{{ $diretor->id }}">
                {{ $diretor->nome }}
            </option>
            @endforeach
        </select>
        @error('filme.diretor_id') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label for="">
            IMDB link
        </label><br>
        <input type="text" wire:model="filme.imdb_link">
        @error('filme.imdb_link') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label for="">
            Rank
        </label><br>
        <input type="number" wire:model="filme.rank">
        @error('filme.rank') <span class="error">{{ $message }}</span> @enderror
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