<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = auth()->user()->tickets()->with(['play.movie', 'seat'])->get();

        return view('public.tickets.index', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);
        return view('public.tickets.show', [
            'ticket' => $ticket,
        ]);
    }

    public function downloadOne(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);
        $ticket->load(['play.movie', 'seat', 'user']);
        $pdf = Pdf::loadView('public.tickets.pdf', [
            'ticket' => $ticket
        ])
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true)
            ->setOption('defaultFont', 'dejavu sans');

        $filename = 'vstupenka-' . str($ticket->id)->slug() . '.pdf';
        return $pdf->download($filename);
    }

    public function downloadAllForPlay(Play $play)
    {
        $tickets = auth()->user()->tickets()
            ->where('play_id', $play->id)
            ->with(['seat'])
            ->get();

        if ($tickets->isEmpty()) {
            abort(403, 'Na toto představení nemáte žádné vstupenky.');
        }

        $play->load('movie');

        $pdf = Pdf::loadView('public.tickets.pdf_group', [
            'play' => $play,
            'tickets' => $tickets
        ]);

        $filename = 'vstupenky-' . str($play->movie->name)->slug() . '.pdf';

        return $pdf->download($filename);
    }
}
