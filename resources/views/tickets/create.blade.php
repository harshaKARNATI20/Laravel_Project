@extends('layouts.main')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Tickets</h1>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>
        <form action="{{ route('tickets.store') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="summary">Name</label>
                <input type="text" id="summary" name="summary" class="form-control {{ $errors->has('summary') ? "is-invalid" : "" }}">
                @if($errors->has('summary'))
                <span class="help-block">
                    <strong>{{ $errors->first('summary') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control {{ $errors->has('description') ? "is-invalid" : "" }}">
                @if($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="start_time">Event Start Time</label>
                <input type="datetime-local" id="start_time" name="start_time" class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}">
                @if($errors->has('start_time'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_time') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="end_time">Event End Time</label>
                <input type="datetime-local" id="end_time" name="end_time" class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}">
                @if($errors->has('end_time'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_time') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" id="venue" name="venue" class="form-control {{ $errors->has('venue') ? 'is-invalid' : '' }}">
                @if($errors->has('venue'))
                <span class="help-block">
                    <strong>{{ $errors->first('venue') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">Ticket Price</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                @if($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                @endif
            </div>



            <div class="form-group">
                <label for="ticket_limit">Ticket Limit</label>
                <input type="number" id="ticket_limit" name="ticket_limit" class="form-control {{ $errors->has('ticket_limit') ? 'is-invalid' : '' }}" min="0">
                @if($errors->has('ticket_limit'))
                <span class="help-block">
                    <strong>{{ $errors->first('ticket_limit') }}</strong>
                </span>
                @endif
            </div>

            @include('layouts.partials._statuses')

            <button class="btn btn-primary" type="submit">Add</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back</a>
            <br><br>
        </form>
    </main>


@endsection
