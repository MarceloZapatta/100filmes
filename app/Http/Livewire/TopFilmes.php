<?php

namespace App\Http\Livewire;

use App\Services\FilmesService;
use Illuminate\Support\Collection;
use Livewire\Component;

class TopFilmes extends Component
{
    public Collection $filmes;

    public function mount(FilmesService $filmesService)
    {
        $this->filmes = $filmesService->get();
    }

    public function render()
    {
        return view('livewire.top-filmes')
            ->layout('layouts.base');
    }
}
