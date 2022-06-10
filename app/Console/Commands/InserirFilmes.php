<?php

namespace App\Console\Commands;

use App\Models\Diretor;
use App\Models\Filme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class InserirFilmes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inserir:filmes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insere os filmes baseado na foto';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filmes = Storage::disk('public_folder')->allFiles('filmes');

        try {
            //code...
            foreach ($filmes as $filme) {
                $nomeArquivo = pathinfo($filme, PATHINFO_FILENAME);
                $nomeArquivo = explode('||', $nomeArquivo);

                $rankingFilme = $nomeArquivo[0];
                $nomeFilme = $nomeArquivo[1];
                $anoFilme = $nomeArquivo[2];
                $diretorFilme = $nomeArquivo[3];
                $imdbLink = urldecode($nomeArquivo[4]);
    
                $diretor = Diretor::updateOrCreate([
                    'nome' => $diretorFilme
                ]);
    
                $uuid = Str::uuid();
    
                $filename = $uuid . '.webp';
    
                Storage::write('filmes/' . $filename, Image::make(public_path($filme))
                    ->resize(1920, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->resize(null, 900, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('webp', 90)
                    ->response('webp')->content());
    
                $filenameResized = $uuid . '-250-350.webp';
    
                Storage::write('filmes/' . $filenameResized, Image::make(public_path($filme))
                    ->fit(250, 350)
                    ->encode('webp', 90)
                    ->response('webp')->content());
    
                Filme::create([
                    'nome' => $nomeFilme,
                    'diretor_id' => $diretor->id,
                    'rank' => $rankingFilme,
                    'foto' => 'filmes/' . $filename,
                    'imdb_link' => $imdbLink,
                    'ano' => $anoFilme
                ]);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }

        return 0;
    }
}
