@extends('layouts.main')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h1 class="h2 mb-4">My Purchased Tickets</h1>

    @if($purchases->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Event Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price per Ticket</th>
                        <th>Total Price</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Venue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->ticket->summary }}</td>
                            <td>{{ $purchase->ticket->description }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>₹{{ number_format($purchase->ticket->price, 2) }}</td>
                            <td>₹{{ number_format($purchase->ticket->price * $purchase->quantity, 2) }}</td>
                            <td>{{ $purchase->ticket->start_time ? \Carbon\Carbon::parse($purchase->ticket->start_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>{{ $purchase->ticket->end_time ? \Carbon\Carbon::parse($purchase->ticket->end_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>{{ $purchase->ticket->venue }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $purchases->links() }}
            </div>
        </div>
    @else
        <p>You have not purchased any tickets yet.</p>
    @endif
</main>
@endsection
