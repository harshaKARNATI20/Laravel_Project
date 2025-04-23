@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Buy Ticket - {{ $ticket->title }}</h4>
        </div>
        <div class="card-body">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($errors->has('payment_error'))
    <div class="alert alert-danger">
        {{ $errors->first('payment_error') }}
    </div>
@endif

<form method="POST" action="{{ route('tickets.pay', $ticket->id) }}">
    @csrf

    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Number of Tickets</label>
        <input type="number" min="1" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required>
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="card_number" class="form-label">Card Number</label>
        <input type="text" class="form-control @error('card_number') is-invalid @enderror" id="card_number" name="card_number" value="{{ old('card_number') }}" required>
        @error('card_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method</label>
        <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
            <option value="">Choose...</option>
            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
            <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
            <option value="upi" {{ old('payment_method') == 'upi' ? 'selected' : '' }}>UPI</option>
        </select>
        @error('payment_method')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Pay</button>
</form>
        </div>
    </div>
</div>
@endsection
