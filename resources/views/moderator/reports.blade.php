@extends('layouts.app')

@section('content')
<h1>Gemelde producten</h1>

@if($reports->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Datum</th>
                    <th>Gemeld door</th>
                    <th>Product</th>
                    <th>Maker</th>
                    <th>Reden</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>
                        <strong>{{ $report->product->name }}</strong><br>
                        <small>{{ Str::limit($report->product->description, 50) }}</small>
                    </td>
                    <td>{{ $report->product->maker->name }}</td>
                    <td>{{ $report->reason }}</td>
                    <td>
                        <form action="{{ route('moderator.delete.product', $report->product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Product verwijderen?')">Verwijder product</button>
                        </form>
                        <a href="{{ route('products.show', $report->product) }}" class="btn btn-sm btn-info" target="_blank">Bekijk</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $reports->links() }}
@else
    <div class="alert alert-success text-center">
        Er zijn geen meldingen.
    </div>
@endif
@endsection
