@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Review plaatsen</h4>
            </div>
            <div class="card-body">
                <h5>Product: {{ $order->product->name }}</h5>
                <p class="text-muted">Bestelling #{{ $order->order_id }}</p>
                <hr>

                <form method="POST" action="{{ route('reviews.store', $order) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Beoordeling *</label>
                        <div class="rating-input">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1" required>
                                <label class="form-check-label" for="rating1">1 ★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                                <label class="form-check-label" for="rating2">2 ★★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                                <label class="form-check-label" for="rating3">3 ★★★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                                <label class="form-check-label" for="rating4">4 ★★★★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5">
                                <label class="form-check-label" for="rating5">5 ★★★★★</label>
                            </div>
                        </div>
                        @error('rating')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Jouw ervaring *</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror"
                                  id="comment" name="comment" rows="5" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Wat vond je van het product? Deel je ervaring met anderen.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Review plaatsen</button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuleren</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
