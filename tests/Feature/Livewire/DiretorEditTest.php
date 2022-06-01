<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\DiretorEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DiretorEditTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DiretorEdit::class);

        $component->assertStatus(200);
    }
}
