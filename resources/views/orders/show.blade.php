@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Bestelling #{{ $order->order_id }}</h4>
            </div>
            <div class="card-body">
                <h5>Product: {{ $order->product->name }}</h5>
                <p class="text-muted">Gemaakt door: {{ $order->product->maker->name }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Besteldatum:</strong><br>
                        {{ $order->created_at->format('d-m-Y H:i') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <span class="badge
                            @if($order->status == 'in productie') bg-warning text-dark
                            @elseif($order->status == 'verzonden') bg-success
                            @else bg-danger
                            @endif" style="font-size: 1rem;">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                @if($order->comment)
                    <hr>
                    <strong>Mijn opmerking:</strong>
                    <p class="alert alert-info">{{ $order->comment }}</p>
                @endif

                @if($order->status == 'verzonden' && !$order->review)
                    <hr>
                    <div class="alert alert-success">
                        <h5>Je bestelling is verzonden!</h5>
                        <p>We horen graag wat je van het product vindt. Plaats een review!</p>
                        <a href="{{ route('reviews.create', $order) }}" class="btn btn-primary">Review plaatsen</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($order->review)
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Jouw review</h5>
                </div>
                <div class="card-body">
                    <div class="rating mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $order->review->rating) ★ @else ☆ @endif
                        @endfor
                        <span class="ms-2">({{ $order->review->rating }}/5)</span>
                    </div>
                    <p>{{ $order->review->comment }}</p>
                    <small class="text-muted">Geplaatst op: {{ $order->review->created_at->format('d-m-Y') }}</small>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
