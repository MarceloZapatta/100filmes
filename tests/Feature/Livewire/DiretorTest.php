<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Diretor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DiretorTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Diretor::class);

        $component->assertStatus(200);
    }
}
