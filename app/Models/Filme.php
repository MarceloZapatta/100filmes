<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'ano', 'diretor_id', 'imdb_link', 'rank', 'foto'];

    public function diretor()
    {
        return $this->belongsTo(Diretor::class);
    }

    public function desbloqueado()
    {
        return $this->hasOne(UserFilme::class)
            ->where('user_id', Auth::user()->id);
    }
}
