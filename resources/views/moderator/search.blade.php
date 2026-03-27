@extends('layouts.app')

@section('content')
<h1>Zoekresultaten</h1>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('moderator.search') }}" class="row g-3">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Zoeken..." value="{{ $query }}" required>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="products" {{ $type == 'products' ? 'selected' : '' }}>Producten</option>
                    <option value="reviews" {{ $type == 'reviews' ? 'selected' : '' }}>Reviews</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Zoek</button>
            </div>
        </form>
    </div>
</div>

@if($type == 'products')
    <h3>Producten ({{ $results->total() }})</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Maker</th>
                    <th>Status</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <small>{{ Str::limit($product->description, 50) }}</small>
                    </td>
                    <td>{{ $product->maker->name }}</td>
                    <td>
                        <span class="badge
                            @if($product->status == 'pending') bg-warning text-dark
                            @elseif($product->status == 'approved') bg-success
                            @else bg-danger
                            @endif">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info" target="_blank">Bekijk</a>
                        @if($product->status == 'pending')
                            <form action="{{ route('moderator.approve', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Goedkeuren</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <h3>Reviews ({{ $results->total() }})</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Reviewer</th>
                    <th>Rating</th>
                    <th>Commentaar</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $review)
                <tr>
                    <td>{{ $review->product->name }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating) ★ @else ☆ @endif
                        @endfor
                    </td>
                    <td>{{ Str::limit($review->comment, 100) }}</td>
                    <td>{{ $review->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="mt-4">
    {{ $results->appends(['search' => $query, 'type' => $type])->links() }}
</div>
@endsection
