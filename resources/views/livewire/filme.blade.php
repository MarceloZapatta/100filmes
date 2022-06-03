<div>
    <x-slot name="header">
        Filmes
    </x-slot>
    <x-button wire:click="novo">
        Novo
    </x-button>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $filme)
            <tr>
                <td>
                    <a href="{{ route('admin.filmes.editar', ['filme' => $filme->id]) }}">{{ $filme->nome
                        }} {{ $filme->ano }} ({{ $filme->diretor->nome }})</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>