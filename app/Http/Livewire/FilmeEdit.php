<?php

namespace App\Http\Livewire;

use App\Models\Diretor;
use App\Models\Filme;
use App\Services\DiretoresService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class FilmeEdit extends Component
{
    use WithFileUploads;

    public $filme = [];
    public Collection $diretores;
    public $foto;

    protected $rules = [
        'filme.nome' => 'required|max:191',
        'filme.diretor_id' => 'required|exists:diretores,id',
        'filme.ano' => 'required|numeric|min:1900|max:9999',
        'filme.imdb_link' => 'required|max:191',
        'filme.rank' => 'required|numeric',
        'foto' => 'required|image|max:5120'
    ];

    public function mount(DiretoresService $diretoresService, $filme = null)
    {
        $this->filme = $filme ? Filme::findOrFail($filme) : [];
        $this->diretores = $diretoresService->get();
    }

    public function voltar()
    {
        return redirect()->route('admin.filmes.index');
    }

    public function salvar()
    {
        if ($this->filme instanceof Filme) {
            $this->validate(array_merge($this->rules, ['foto' => 'nullable|image|max:5120']));
        } else {
            $this->validate();
        }

        if ($this->foto) {
            if (!Storage::exists(storage_path('public/filmes'))) {
                Storage::makeDirectory('public/filmes');
            }

            $uuid = Str::uuid();
            $filename = $uuid . '.webp';

            $path = storage_path('app/public/filmes/' . $filename);

            Image::make($this->foto)
                ->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->resize(null, 900, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 90)
                ->save($path);

            $filenamePixelate = $uuid . '-pixelate.webp';
            $pathPixelate = storage_path('app/public/filmes/' . $filenamePixelate);

            Image::make($this->foto)
                ->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->resize(null, 900, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->pixelate(24)
                ->encode('webp', 90)
                ->save($pathPixelate);

            $filenameResized = $uuid . '-250-350.webp';
            $pathResized = storage_path('app/public/filmes/' . $filenameResized);

            Image::make($this->foto)
                ->fit(250, 350)
                ->encode('webp', 90)
                ->save($pathResized);

            $this->filme['foto'] = 'filmes/' . $filename;
        }

        if (is_array($this->filme)) {
            Filme::create($this->filme);
        } else {
            $this->filme->save();
        }

        return redirect()->route('admin.filmes.index');
    }

    public function render()
    {
        return view('livewire.filme-edit')
            ->layout('layouts.base');
    }
}
