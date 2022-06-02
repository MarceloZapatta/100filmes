<?php

namespace App\Http\Livewire;

use App\Models\Diretor;
use Livewire\Component;

class DiretorEdit extends Component
{
    public $diretor = [];

    protected $rules = [
        'diretor.nome' => 'required|max:191'
    ];

    public function mount($diretor = null)
    {
        $this->diretor = $diretor ? Diretor::findOrFail($diretor) : [];
    }

    public function voltar()
    {
        return redirect()->route('admin.diretores.index');
    }

    public function salvar()
    {
        if (is_array($this->diretor)) {
            Diretor::create($this->diretor);
        } else {
            $this->diretor->save();
        }

        return redirect()->route('admin.diretores.index');
    }

    public function render()
    {
        return view('livewire.diretor-edit')
            ->layout('layouts.base');
    }
}
