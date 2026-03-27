@extends('layouts.app')

@section('content')
<h1>Moderatie - Producten in afwachting</h1>

@if($products->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Maker</th>
                    <th>Type</th>
                    <th>Materiaal</th>
                    <th>Levertijd</th>
                    <th>Datum</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <small>{{ Str::limit($product->description, 50) }}</small>
                    </td>
                    <td>{{ $product->maker->name }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->material }}</td>
                    <td>{{ $product->production_time }} dagen</td>
                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('moderator.approve', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">✅ Goedkeuren</button>
                        </form>
                        <form action="{{ route('moderator.reject', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">❌ Afkeuren</button>
                        </form>
                        <form action="{{ route('moderator.delete.product', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-secondary" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">🗑️ Verwijderen</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@else
    <div class="alert alert-success text-center">
        Er zijn geen producten die wachten op goedkeuring.
    </div>
@endif

<hr>

<h2 class="mt-4">Alle producten beheren</h2>
<a href="{{ route('home') }}" class="btn btn-primary" target="_blank">Bekijk openbare producten</a>
@endsection
