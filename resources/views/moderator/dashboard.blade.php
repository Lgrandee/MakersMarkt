@extends('layouts.app')

@section('content')
<h1>Statistieken Dashboard</h1>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Producten per categorie</h5>
            </div>
            <div class="card-body">
                <canvas id="productsPerCategoryChart" height="300"></canvas>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Categorie</th>
                            <th>Aantal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productsPerCategory as $stat)
                        <tr>
                            <td>{{ ucfirst($stat->type) }}</td>
                            <td>{{ $stat->count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Populairste producttypes (meest besteld)</h5>
            </div>
            <div class="card-body">
                <canvas id="popularTypesChart" height="300"></canvas>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Aantal bestellingen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($popularTypes as $stat)
                        <tr>
                            <td>{{ ucfirst($stat->type) }}</td>
                            <td>{{ $stat->orders_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Gemiddelde beoordeling per maker</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Maker</th>
                                <th>Gemiddelde score</th>
                                <th>Visualisatie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($avgRatingPerMaker as $stat)
                            <tr>
                                <td>{{ $stat->maker->name ?? 'Onbekend' }}</td>
                                <td>{{ number_format($stat->avg_rating, 1) }}/5</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                             style="width: {{ ($stat->avg_rating / 5) * 100 }}%"
                                             aria-valuenow="{{ $stat->avg_rating }}" aria-valuemin="0" aria-valuemax="5">
                                            {{ number_format($stat->avg_rating, 1) }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Products per category chart
    const productsCtx = document.getElementById('productsPerCategoryChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productsPerCategory->pluck('type')->map('ucfirst')) !!},
            datasets: [{
                label: 'Aantal producten',
                data: {!! json_encode($productsPerCategory->pluck('count')) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.5)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Popular types chart
    const popularCtx = document.getElementById('popularTypesChart').getContext('2d');
    new Chart(popularCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($popularTypes->pluck('type')->map('ucfirst')) !!},
            datasets: [{
                data: {!! json_encode($popularTypes->pluck('orders_count')) !!},
                backgroundColor: ['#ffc107', '#0d6efd', '#198754', '#dc3545', '#fd7e14']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
