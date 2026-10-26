<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('landing.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw($validated['message'], function ($mail) use ($validated): void {
            $mail->to(config('mail.from.address'))
                ->replyTo($validated['email'], $validated['name'])
                ->subject('Pesan dari formulir Fruitables');
        });

        return redirect()->route('contact')->with('status', 'Pesan Anda berhasil dikirim.');
    }
}
