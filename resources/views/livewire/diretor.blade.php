<div>
    <x-slot name="header">
        Diretores
    </x-slot>
    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                    <a href="{{ route('admin.diretores.edit', ['teste' => $diretor->id]) }}">{{ $diretor->nome }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>