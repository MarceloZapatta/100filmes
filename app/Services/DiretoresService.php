<?php

namespace App\Services;

use App\Models\Diretor;

class DiretoresService {
    public function get()
    {
        return Diretor::orderBy('nome')->get();
    }
}
