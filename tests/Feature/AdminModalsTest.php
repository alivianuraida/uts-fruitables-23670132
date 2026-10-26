<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModalsTest extends TestCase
{
    use RefreshDatabase;

    public function test_modal_examples_render_inside_the_admin_layout(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.modals'));

        $response->assertOk()
            ->assertSee('Basic Modal')
            ->assertSee('Scrollable Modal')
            ->assertSee('Fullscreen Modal')
            ->assertSee('Form Modal')
            ->assertSee('class="top-header"', false)
            ->assertSee('class="sidebar-wrapper"', false)
            ->assertSee(route('admin.modals'));
    }

    public function test_modal_examples_are_redirected_for_guests(): void
    {
        $this->get(route('admin.modals'))
            ->assertRedirect(route('admin.login'));
    }
}
