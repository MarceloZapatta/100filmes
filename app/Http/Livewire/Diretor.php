<?php

namespace App\Http\Livewire;

use App\Services\DiretoresService;
use Illuminate\Support\Collection;
use Livewire\Component;

class Diretor extends Component
{
    public Collection $diretores;

    public function mount(DiretoresService $diretoresService)
    {
        $this->diretores = $diretoresService->get();
    }

    public function render()
    {
        return view('livewire.diretor');
    }
}
