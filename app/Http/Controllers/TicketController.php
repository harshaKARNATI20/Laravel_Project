<?php

namespace App\Http\Controllers;
use App\Mail\TicketPurchasedMail;
use App\Http\Requests\TicketUpdateRequest;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tickets = Ticket::orderBy('id', 'asc')->get();
        $tickets = Ticket::orderBy('id', 'asc')->paginate(10);
        return view('tickets.index', compact('tickets'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');

    }

    public function delete(Ticket $ticket){
        return view('tickets.delete',compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('tickets.index')->with('success', 'Ticket added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)

    {
        $statuses = Status::get();
        return view('tickets.show', compact(['ticket','statuses']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $statuses = Status::get();
        return view('tickets.edit', compact(['ticket', 'statuses']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket->summary = $request->summary;
        $ticket->description = $request->description;
        $ticket->status = $request->status;
        $ticket->start_time = $request->start_time;
        $ticket->end_time = $request->end_time;
        $ticket->venue = $request->venue;
        $ticket->price = $request->price;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        // dd($ticket);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully!');

    }

// Show the payment page
public function buy($id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->updateStatus();

    if ($ticket->status === 'closed') {
        return redirect()->route('tickets.index')->withErrors(['Ticket sales are closed for this event.']);
    }

    return view('tickets.buy', compact('ticket'));
}

    public function pay(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->updateStatus();

        if ($ticket->status === 'closed') {
            return redirect()->route('tickets.index')->withErrors(['Ticket sales are closed for this event.']);
        }

        // Validate payment form inputs
        $request->validate([
            'full_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'card_number' => 'required|string|max:19',
            'payment_method' => 'required|string|in:credit_card,debit_card,upi',
        ]);

        try {
            // Record the purchase
            $purchase = $ticket->purchases()->create([
                'user_id' => Auth::id(),
                'payment_method' => $request->payment_method,
                'card_number' => $request->card_number,
                'quantity' => $request->quantity,
            ]);

            // Send email to currently logged-in user
            $user = Auth::user();
            Mail::to($user->email)->send(new TicketPurchasedMail($purchase));

            // Update ticket status after purchase
            $ticket->updateStatus();

            return redirect()
                ->route('tickets.index')
                ->with('success', 'Payment Successful. Confirmation email sent!');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return back()->withErrors(['payment_error' => 'Payment failed. Please try again later.']);
        }
    }

    // Show the user's purchased tickets
    public function myPurchases()
    {
        $user = Auth::user();
        $purchases = $user->purchases()->with('ticket')->paginate(10);
        return view('tickets.my-purchases', compact('purchases'));
    }

}
