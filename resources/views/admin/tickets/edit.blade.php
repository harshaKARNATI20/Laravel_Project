@extends('layouts.main')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Ticket</h1>
    </div>

    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="summary">Name</label>
            <input type="text" id="summary" name="summary" value="{{ old('summary', $ticket->summary) }}" class="form-control @error('summary') is-invalid @enderror">
            @error('summary')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{ old('description', $ticket->description) }}" class="form-control @error('description') is-invalid @enderror">
            @error('description')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_time">Event Start Time</label>
            <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time', $ticket->start_time ? $ticket->start_time->format('Y-m-d\TH:i') : '') }}" class="form-control @error('start_time') is-invalid @enderror">
            @error('start_time')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_time">Event End Time</label>
            <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time', $ticket->end_time ? $ticket->end_time->format('Y-m-d\TH:i') : '') }}" class="form-control @error('end_time') is-invalid @enderror">
            @error('end_time')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" value="{{ old('venue', $ticket->venue) }}" class="form-control @error('venue') is-invalid @enderror">
            @error('venue')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Ticket Price</label>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $ticket->price) }}" class="form-control @error('price') is-invalid @enderror">
            @error('price')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="ticket_limit">Ticket Limit</label>
            <input type="number" id="ticket_limit" name="ticket_limit" value="{{ old('ticket_limit', $ticket->ticket_limit) }}" class="form-control @error('ticket_limit') is-invalid @enderror">
            @error('ticket_limit')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                @foreach($statuses as $status)
                    <option value="{{ $status->name }}" {{ old('status', $ticket->status) == $status->name ? 'selected' : '' }}>{{ ucfirst($status->name) }}</option>
                @endforeach
            </select>
            @error('status')
            <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Back</a>
    </form>
</main>
@endsection
