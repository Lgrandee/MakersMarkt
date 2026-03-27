@extends('layouts.app')

@section('title', $product->name . ' - MakerMarket')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- Product Card -->
            <div class="card mb-4" data-aos="fade-right">
                <div class="card-body p-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $product->name }}</li>
                        </ol>
                    </nav>

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="display-5 fw-bold">{{ $product->name }}</h1>
                        <span class="badge badge-approved fs-6">
                            <i class="fas fa-check-circle me-1"></i>Goedgekeurd
                        </span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                                <div>
                                    <small class="text-muted">Gemaakt door</small>
                                    <h5 class="mb-0">{{ $product->maker->name }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="fas fa-clock fa-2x text-primary me-3"></i>
                                <div>
                                    <small class="text-muted">Levertijd</small>
                                    <h5 class="mb-0">{{ $product->production_time }} werkdagen</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4><i class="fas fa-align-left text-primary me-2"></i>Beschrijving</h4>
                    <p class="lead">{{ $product->description }}</p>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-tag text-primary me-2"></i>Type</h5>
                            <p class="badge bg-primary fs-6">{{ $product->type }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-cube text-primary me-2"></i>Materiaal</h5>
                            <p class="badge bg-secondary fs-6">{{ $product->material }}</p>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'koper' && $product->status === 'approved')
                            <hr>
                            <div class="alert alert-success">
                                <i class="fas fa-shopping-cart me-2"></i>
                                <strong>Geïnteresseerd?</strong> Plaats direct een bestelling!
                            </div>
                            <form action="{{ route('orders.store', $product) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="comment" class="form-label">
                                        <i class="fas fa-comment me-2"></i>Opmerking bij bestelling
                                    </label>
                                    <textarea name="comment" class="form-control" rows="3"
                                              placeholder="Bijv. speciale wensen, kleur, maat, leveringsadres etc."></textarea>
                                    <small class="text-muted">Optioneel - je kunt hier extra instructies geven aan de maker.</small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Bestellen
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->role === 'koper')
                            <hr>
                            <div class="card border-danger">
                                <div class="card-body">
                                    <h5 class="text-danger">
                                        <i class="fas fa-flag me-2"></i>Product melden
                                    </h5>
                                    <p class="small">Zie je iets dat niet klopt? Meld het product bij een moderator.</p>
                                    <form action="{{ route('reports.store', $product) }}" method="POST">
                                        @csrf
                                        <div class="mb-2">
                                            <textarea name="reason" class="form-control" rows="2"
                                                      placeholder="Reden van melding..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-flag me-2"></i>Melden
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth

                    @guest
                        <div class="alert alert-info text-center mt-4">
                            <i class="fas fa-lock me-2"></i>
                            <strong>Wil je dit product bestellen?</strong>
                            <a href="{{ route('login') }}" class="alert-link">Log in</a> of
                            <a href="{{ route('register') }}" class="alert-link">registreer</a> om verder te gaan.
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Reviews Section -->
            <div class="card sticky-top" style="top: 100px;" data-aos="fade-left">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-star me-2"></i>Reviews
                        @if($product->reviews->count() > 0)
                            <span class="badge bg-light text-dark ms-2">{{ $product->reviews->count() }}</span>
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    @if($product->reviews->count() > 0)
                        @php
                            $avgRating = $product->reviews->avg('rating');
                            $totalReviews = $product->reviews->count();
                        @endphp

                        <div class="text-center mb-4">
                            <div class="rating-stars fs-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($avgRating))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $avgRating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <h3 class="mt-2">{{ number_format($avgRating, 1) }}/5</h3>
                            <p class="text-muted">Gebaseerd op {{ $totalReviews }} review(s)</p>
                        </div>

                        <div class="reviews-list">
                            @foreach($product->reviews as $review)
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong>
                                            <i class="fas fa-user-circle me-1"></i>
                                            {{ $review->user->name }}
                                        </strong>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star fa-sm"></i>
                                                @else
                                                    <i class="far fa-star fa-sm"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-1">{{ $review->comment }}</p>
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $review->created_at->format('d-m-Y') }}
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-star-half-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Nog geen reviews voor dit product.</p>
                            @auth
                                @if(auth()->user()->role === 'koper')
                                    <small>Word de eerste die een review plaatst!</small>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
