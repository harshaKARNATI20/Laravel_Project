@extends('layouts.main')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Delete Ticket {{ $ticket->id }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn btn-sm btn-outline-secondary">Share</button>
                    <button class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>
        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label for="summary">Name</label>
                <input type="text" id="summary" name="summary" class="form-control" value="{{ $ticket->summary }}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                    value="{{ $ticket->description }}" disabled>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $ticket->status }}" disabled>
            </div>
            <button class="btn btn-danger" type="submit">Delete</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </main>

@endsection