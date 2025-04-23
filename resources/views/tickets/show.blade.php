@extends('layouts.main')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h1 class="h2">{{ $ticket->summary }}</h1>

    <div class="mb-3">
        <strong>Description:</strong>
        <p>{{ $ticket->description }}</p>
    </div>

    <div class="mb-3">
        <strong>Status:</strong> {{ $ticket->status }}
    </div>

    <div class="mb-3">
        <strong>Event Start Time:</strong> {{ $ticket->start_time ? \Carbon\Carbon::parse($ticket->start_time)->format('Y-m-d H:i') : 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Event End Time:</strong> {{ $ticket->end_time ? \Carbon\Carbon::parse($ticket->end_time)->format('Y-m-d H:i') : 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Venue:</strong> {{ $ticket->venue ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Price:</strong> ${{ number_format($ticket->price, 2) }}
    </div>



    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to Tickets</a>
</main>
@endsection
