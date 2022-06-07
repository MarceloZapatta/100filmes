<?php

namespace App\Console\Commands;

use App\Models\Filme;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PegarPontuacaoImdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filmes:pontuacao-imdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pontuação IMDB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filmes = Filme::get();

        if (!Storage::disk('local')->exists('arquivo_pontuacao-' . Carbon::now()->format('Y-m-d') . '.tsv')) {
            $arquivoPontuacao = file_get_contents("https://datasets.imdbws.com/title.ratings.tsv.gz");
            $arquivoPontuacao = gzdecode($arquivoPontuacao);
    
            Storage::disk('local')->put('arquivo_pontuacao-' . Carbon::now()->format('Y-m-d') . '.tsv', $arquivoPontuacao);
        }

        $lines = file(storage_path('app/arquivo_pontuacao-' . Carbon::now()->format('Y-m-d') . '.tsv'));

        foreach ($lines as $key => $line) {
            if ($key === 1) {
                $lineExploded = explode($line, "\t");
                $filme =$filmes->where('imdbLink', 'LIKE', '%' . $lineExploded[0] . '%')
                    ->first();

                if ($filme) {
                    $filme->imdb_rating = (float) $lineExploded[1];
                    $filme->save();
                }
            }
        }

        return 0;
    }
}
