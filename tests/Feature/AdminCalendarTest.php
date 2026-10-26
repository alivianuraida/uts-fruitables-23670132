<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCalendarTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_route_renders_inside_the_admin_layout(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.calendar'));

        $response->assertOk()
            ->assertSee('Jadwal dan Agenda')
            ->assertSee('id="calendar"', false)
            ->assertSee('class="top-header"', false)
            ->assertSee('class="sidebar-wrapper"', false)
            ->assertSee(route('admin.dashboard'))
            ->assertSee(route('admin.calendar'));
    }

    public function test_admin_dashboard_route_is_available_from_the_calendar_layout(): void
    {
        $this->actingAs(User::factory()->create([
            'name' => 'Nadia Admin',
            'email' => 'nadia@example.com',
        ]));

        User::factory()->create([
            'name' => 'Budi Pelanggan',
            'email' => 'budi@example.com',
        ]);

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Selamat datang kembali,')
            ->assertSee('Nadia Admin')
            ->assertSee('>2</div>', false)
            ->assertSee('akun terdaftar')
            ->assertSee('Budi Pelanggan')
            ->assertSee('budi@example.com')
            ->assertSee('6 produk')
            ->assertSee('Anggur Segar')
            ->assertSee('Analysis')
            ->assertSee(route('admin.calendar'));
    }
}
