<?php

namespace App\Http\Livewire;

use App\Services\FilmesService;
use Livewire\Component;

class Filme extends Component
{
    public function mount(FilmesService $filmesService)
    {
        $this->filmes = $filmesService->get();
    }

    public function novo()
    {
        return redirect()->route('admin.filmes.criar');
    }

    public function render()
    {
        return view('livewire.filme')
            ->layout('layouts.base');
    }
}
