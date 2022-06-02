<div>
    <x-slot name="header">
        Diretores
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
            @foreach ($diretores as $diretor)
            <tr>
                <td>
                    <a href="{{ route('admin.diretores.editar', ['diretor' => $diretor->id]) }}">{{ $diretor->nome
                        }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>