<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDataTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_data_tables_render_user_and_product_records_inside_the_admin_layout(): void
    {
        $this->actingAs(User::factory()->create([
            'name' => 'Ayu Admin',
            'email' => 'ayu@example.com',
        ]));

        User::factory()->create([
            'name' => 'Budi Pelanggan',
            'email' => 'budi@example.com',
        ]);

        $response = $this->get(route('admin.datatable'));

        $response->assertOk()
            ->assertSee('Pengguna Terdaftar')
            ->assertSee('Ayu Admin')
            ->assertSee('budi@example.com')
            ->assertSee('Anggur Segar')
            ->assertSee('Brokoli Organik')
            ->assertSee('id="usersTable"', false)
            ->assertSee('id="productsTable"', false)
            ->assertSee('class="top-header"', false)
            ->assertSee('class="sidebar-wrapper"', false)
            ->assertSee(route('admin.datatable'));
    }

    public function test_data_tables_redirect_guests_to_admin_login(): void
    {
        $this->get(route('admin.datatable'))
            ->assertRedirect(route('admin.login'));
    }
}
