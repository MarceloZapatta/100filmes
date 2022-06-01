<?php

namespace App\Services;

use App\Models\Filme;

class FilmesService
{
    public function get()
    {
        return Filme::orderBy('rank')->get();
    }
}
