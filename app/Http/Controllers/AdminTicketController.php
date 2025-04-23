<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketUpdateRequest;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $tickets = Ticket::orderBy('id', 'asc')->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(TicketUpdateRequest $request)
    {
        Ticket::create([
            'summary' => $request->summary,
            'description' => $request->description,
            'status' => $request->status,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'venue' => $request->venue,
            'price' => $request->price,
            'ticket_limit' => $request->ticket_limit,
        ]);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket added successfully!');
    }

    public function show(Ticket $ticket)
    {
        $statuses = Status::get();
        return view('admin.tickets.show', compact(['ticket', 'statuses']));
    }

    public function edit(Ticket $ticket)
    {
        $statuses = Status::get();
        return view('admin.tickets.edit', compact(['ticket', 'statuses']));
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket->summary = $request->summary;
        $ticket->description = $request->description;
        $ticket->status = $request->status;
        $ticket->start_time = $request->start_time;
        $ticket->end_time = $request->end_time;
        $ticket->venue = $request->venue;
        $ticket->price = $request->price;
        $ticket->ticket_limit = $request->ticket_limit;
        $ticket->save();

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully!');
    }

    public function delete(Ticket $ticket)
    {
        return view('admin.tickets.delete', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully!');
    }
}
