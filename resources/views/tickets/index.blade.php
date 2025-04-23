@extends('layouts.main')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    {{-- ✅ Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Tickets</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @if(auth()->user()->isAdmin())
                <a class="btn btn-primary mb-3" href="/tickets/create">Add New Ticket</a>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Event Start</th>
                    <th>Event End</th>
                    <th>Venue</th>
                    <th>Price</th>
                    @if(auth()->user()->isAdmin())
                        <th>Tickets Sold</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->summary }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->start_time ? \Carbon\Carbon::parse($ticket->start_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>{{ $ticket->end_time ? \Carbon\Carbon::parse($ticket->end_time)->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>{{ $ticket->venue }}</td>
                        <td>₹{{ number_format($ticket->price, 2) }}</td>
                        @if(auth()->user()->isAdmin())
                            <td>{{ $ticket->ticketsSold() }}</td>
                        @endif
                        <td>
                            @if(auth()->user()->isAdmin())
                                <a href="/tickets/{{ $ticket->id }}/edit" class="btn btn-primary btn-sm">Update</a>
                                <a href="/tickets/delete/{{ $ticket->id }}" class="btn btn-danger btn-sm">Delete</a>
                            @else
                                <a href="{{ route('tickets.buy', $ticket->id) }}" class="btn btn-success btn-sm">Buy</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $tickets->links() }}
        </div>
    </div>

</main>

@endsection
