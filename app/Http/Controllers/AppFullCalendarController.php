<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AppFullCalendarController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();

        return view('admin.app-fullcalender', [
            'events' => [
                [
                    'title' => 'Pemeriksaan stok',
                    'start' => $today,
                    'allDay' => true,
                ],
                [
                    'title' => 'Jadwal pengiriman',
                    'start' => $tomorrow,
                    'allDay' => true,
                ],
            ],
        ]);
    }
}
