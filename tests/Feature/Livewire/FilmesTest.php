<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Filmes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FilmesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Filmes::class);

        $component->assertStatus(200);
    }
}
