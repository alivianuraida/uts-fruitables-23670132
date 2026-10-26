<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFormElementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_examples_render_inside_the_admin_layout(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.form-elements'));

        $response->assertOk()
            ->assertSee('Text Inputs')
            ->assertSee('Select Inputs')
            ->assertSee('File Inputs')
            ->assertSee('Datalist')
            ->assertSee('Checkboxes, Radios & Switches')
            ->assertSee('Input Mask')
            ->assertSee('Input Tags')
            ->assertSee('Range Inputs')
            ->assertSee('class="top-header"', false)
            ->assertSee('class="sidebar-wrapper"', false)
            ->assertSee(route('admin.form-elements'));
    }

    public function test_form_examples_redirect_guests_to_admin_login(): void
    {
        $this->get(route('admin.form-elements'))
            ->assertRedirect(route('admin.login'));
    }
}
