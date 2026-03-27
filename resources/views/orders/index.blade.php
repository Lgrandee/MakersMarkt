@extends('layouts.app')

@section('content')
<h1>Mijn bestellingen</h1>

@if($orders->count() > 0)
    <div class="list-group">
        @foreach($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Bestelling #{{ $order->order_id }} - {{ $order->product->name }}</h5>
                    <small>{{ $order->created_at->format('d-m-Y') }}</small>
                </div>
                <p class="mb-1">
                    <strong>Status:</strong>
                    <span class="badge
                        @if($order->status == 'in productie') bg-warning text-dark
                        @elseif($order->status == 'verzonden') bg-success
                        @else bg-danger
                        @endif">
                        {{ $order->status }}
                    </span>
                </p>
                @if($order->review)
                    <small class="text-success">✓ Review geplaatst ({{ $order->review->rating }}/5)</small>
                @endif
            </a>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        Je hebt nog geen bestellingen geplaatst.
        <br>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Bekijk producten</a>
    </div>
@endif
@endsection
