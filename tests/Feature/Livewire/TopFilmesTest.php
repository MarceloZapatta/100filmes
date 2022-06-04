<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\TopFilmes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TopFilmesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TopFilmes::class);

        $component->assertStatus(200);
    }
}
