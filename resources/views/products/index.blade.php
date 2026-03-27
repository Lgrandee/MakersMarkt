@extends('layouts.app')

@section('title', 'Ontdek unieke handgemaakte producten')

@section('content')
<!-- Hero Section -->
<div class="hero-section container" data-aos="fade-up">
    <div class="row align-items-center">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="hero-title">
                <i class="fas fa-gem me-3"></i>Ontdek unieke handgemaakte producten
            </h1>
            <p class="hero-subtitle mb-4">
                Van ambachtelijke makers, direct bij jou thuis. Steun lokale kunstenaars en vind het perfecte stuk.
            </p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 me-2">
                    <i class="fas fa-user-plus me-2"></i>Word lid
                </a>
                <a href="#products" class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-search me-2"></i>Bekijk producten
                </a>
            @else
                <a href="#products" class="btn btn-warning btn-lg px-5">
                    <i class="fas fa-store me-2"></i>Ontdek producten
                </a>
            @endguest
        </div>
    </div>
</div>

<div class="container" id="products">
    <!-- Search & Filter Section -->
    <div class="card mb-5" data-aos="fade-up" data-aos-delay="100">
        <div class="card-body p-4">
            <h4 class="mb-4">
                <i class="fas fa-filter me-2 text-primary"></i>Producten filteren
            </h4>
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                               placeholder="Zoeken op naam of beschrijving..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-select">
                        <option value="">Alle types</option>
                        <option value="sieraden" {{ request('type')=='sieraden' ? 'selected' : '' }}>💎 Sieraden</option>
                        <option value="meubels" {{ request('type')=='meubels' ? 'selected' : '' }}>🪑 Meubels</option>
                        <option value="kleding" {{ request('type')=='kleding' ? 'selected' : '' }}>👕 Kleding</option>
                        <option value="kunst" {{ request('type')=='kunst' ? 'selected' : '' }}>🎨 Kunst</option>
                        <option value="keramiek" {{ request('type')=='keramiek' ? 'selected' : '' }}>🏺 Keramiek</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="material" class="form-select">
                        <option value="">Alle materialen</option>
                        <option value="hout" {{ request('material')=='hout' ? 'selected' : '' }}>🌳 Hout</option>
                        <option value="metaal" {{ request('material')=='metaal' ? 'selected' : '' }}>⚙️ Metaal</option>
                        <option value="textiel" {{ request('material')=='textiel' ? 'selected' : '' }}>🧵 Textiel</option>
                        <option value="keramiek" {{ request('material')=='keramiek' ? 'selected' : '' }}>🏺 Keramiek</option>
                        <option value="glas" {{ request('material')=='glas' ? 'selected' : '' }}>🔮 Glas</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="production_time" class="form-control"
                           placeholder="Max. levertijd (dagen)" value="{{ request('production_time') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary">{{ $product->type }}</span>
                            <span class="badge bg-light text-dark">{{ $product->production_time }} dagen</span>
                        </div>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                        <hr>
                        <div class="mb-2">
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            <small>{{ $product->maker->name }}</small>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-cube text-primary me-2"></i>
                            <small>{{ $product->material }}</small>
                        </div>
                        @if($product->reviews->count() > 0)
                            <div class="rating-stars mb-2">
                                @php $avgRating = $product->reviews->avg('rating'); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($avgRating))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $avgRating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <small class="text-muted ms-2">({{ $product->reviews->count() }})</small>
                            </div>
                        @endif
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary w-100 mt-2">
                            <i class="fas fa-eye me-2"></i>Bekijk product
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center p-5" data-aos="fade-up">
                    <i class="fas fa-box-open fa-3x mb-3"></i>
                    <h4>Geen producten gevonden</h4>
                    <p>Probeer andere zoektermen of filters.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>

<!-- Features Section -->
<div class="container mt-5">
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-hand-sparkles fa-3x text-primary mb-3"></i>
                    <h5>Handgemaakt met passie</h5>
                    <p class="text-muted">Elk product is met liefde en aandacht gemaakt door lokale makers.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-truck-fast fa-3x text-primary mb-3"></i>
                    <h5>Snelle levering</h5>
                    <p class="text-muted">Direct contact met de maker voor een persoonlijke service.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h5>Veilig betalen</h5>
                    <p class="text-muted">Jouw betaling is veilig en beschermd via ons platform.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Smooth scroll to products
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
