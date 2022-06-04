<?php

namespace App\Http\Livewire;

use App\Models\Filme;
use App\Services\FilmesService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TopFilmes extends Component
{
    public Collection $filmes;
    public int $abrirModal = 0;

    protected $listeners = [
        'filmeDesbloqueado' => 'mount',
        'filmeBloqueado' => 'mount'
    ];

    public function mount(FilmesService $filmesService)
    {
        $this->filmes = $filmesService->get();
    }

    public function handleClickFilme(Filme $filme)
    {
        if ($filme->desbloqueado) {
            $this->bloquearFilme($filme->id);
        } else {
            $this->abrirModal($filme->id);
        }
    }

    public function desbloquearFilme(int $filmeId)
    {
        $filmesService = App::make(FilmesService::class);
        $filmesService->desbloquearFilme($filmeId);
        $this->abrirModal(0);
        $this->emitSelf('filmeDesbloqueado');
    }

    public function bloquearFilme(int $filmeId)
    {
        $filmesService = App::make(FilmesService::class);
        $filmesService->bloquearFilme($filmeId);
        $this->emitSelf('filmeBloqueado');
    }

    public function abrirModal(int $filmeId)
    {
        $this->abrirModal = $filmeId;

        $this->emit($filmeId !== 0 ? 'modalAberto' : 'modalFechado');
    }

    public function render()
    {
        return view('livewire.top-filmes')
            ->layout('layouts.base');
    }
}
