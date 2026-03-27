@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Mijn producten</h1>
    <a href="{{ route('maker.products.create') }}" class="btn btn-primary">➕ Nieuw product toevoegen</a>
</div>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-8">
        <input type="text" name="search" class="form-control" placeholder="Zoeken op productnaam..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Alle statussen</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>In afwachting</option>
            <option value="approved" {{ request('status')=='approved' ? 'selected' : '' }}>Goedgekeurd</option>
            <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>Afgekeurd</option>
        </select>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
</form>

<div class="row">
    @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <span class="badge
                        @if($product->status == 'pending') badge-pending
                        @elseif($product->status == 'approved') badge-approved
                        @else badge-rejected
                        @endif mb-2">
                        @if($product->status == 'pending') ⏳ In afwachting
                        @elseif($product->status == 'approved') ✅ Goedgekeurd
                        @else ❌ Afgekeurd
                        @endif
                    </span>
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                    <hr>
                    <p class="mb-1"><strong>Type:</strong> {{ $product->type }}</p>
                    <p class="mb-1"><strong>Materiaal:</strong> {{ $product->material }}</p>
                    <p class="mb-3"><strong>Levertijd:</strong> {{ $product->production_time }} dagen</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('maker.products.edit', $product) }}" class="btn btn-secondary flex-grow-1">✏️ Bewerken</a>
                        <form action="{{ route('maker.products.destroy', $product) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">🗑️ Verwijderen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Je hebt nog geen producten toegevoegd.
                <a href="{{ route('maker.products.create') }}" class="alert-link">Voeg je eerste product toe</a>
            </div>
        </div>
    @endforelse
</div>

{{ $products->links() }}
@endsection
