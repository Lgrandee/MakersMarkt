@extends('layouts.app')

@section('content')
<h1>Ontvangen bestellingen</h1>

@if($orders->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Bestelling #</th>
                    <th>Product</th>
                    <th>Koper</th>
                    <th>Datum</th>
                    <th>Status</th>
                    <th>Opmerking</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td><strong>{{ $order->product->name }}</strong></td>
                    <td>{{ $order->buyer->name }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge
                            @if($order->status == 'in productie') bg-warning text-dark
                            @elseif($order->status == 'verzonden') bg-success
                            @else bg-danger
                            @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->comment ?: '-' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $order->order_id }}">
                            Status wijzigen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="updateModal{{ $order->order_id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('maker.orders.updateStatus', $order) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Status bijwerken - Bestelling #{{ $order->order_id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="in productie" {{ $order->status == 'in productie' ? 'selected' : '' }}>In productie</option>
                                                    <option value="verzonden" {{ $order->status == 'verzonden' ? 'selected' : '' }}>Verzonden</option>
                                                    <option value="geweigerd" {{ $order->status == 'geweigerd' ? 'selected' : '' }}>Geweigerd</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Opmerking (optioneel)</label>
                                                <textarea name="comment" class="form-control" rows="3">{{ $order->comment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                                            <button type="submit" class="btn btn-primary">Opslaan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@else
    <div class="alert alert-info text-center">
        Je hebt nog geen bestellingen ontvangen.
    </div>
@endif
@endsection 
