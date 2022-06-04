<?php

namespace App\Services;

use App\Models\Filme;
use App\Models\UserFilme;
use Illuminate\Support\Facades\Auth;

class FilmesService
{
    /**
     * Retorna todos os filmes
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(): \Illuminate\Support\Collection
    {
        return Filme::orderBy('rank')
            ->with('diretor')
            ->with('desbloqueado')
            ->get();
    }

    /**
     * Desbloqueia o filme
     *
     * @param integer $filmeId
     * @return UserFilme
     */
    public function desbloquearFilme(int $filmeId): UserFilme
    {
        $user = Auth::user();
        $userFilme = UserFilme::where('user_id', $user->id)
            ->where('filme_id', $filmeId)
            ->first();

        if (!$userFilme) {
            $userFilme = UserFilme::create([
                'user_id' => $user->id,
                'filme_id' => $filmeId
            ]);
        }

        return $userFilme;
    }

    /**
     * Bloqueia o filme
     *
     * @param integer $filmeId
     * @return void
     */
    public function bloquearFilme(int $filmeId)
    {
        UserFilme::where('user_id', Auth::user()->id)
            ->where('filme_id', $filmeId)
            ->delete();
    }
}
