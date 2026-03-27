<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MakerMarket - Ambachtelijke producten')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #60a5fa;
            --accent-yellow: #fbbf24;
            --accent-gold: #f59e0b;
            --dark-bg: #1f2937;
            --light-bg: #f9fafb;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-top: 76px;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(37, 99, 235, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: transform 0.3s;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            font-weight: 500;
            margin: 0 0.5rem;
            position: relative;
            transition: all 0.3s;
        }

        .nav-link:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--accent-yellow);
            transition: width 0.3s;
        }

        .nav-link:hover:before {
            width: 80%;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            border-radius: 30px;
            padding: 4rem 2rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, rgba(37,99,235,0) 70%);
            animation: pulse 10s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            position: relative;
            z-index: 1;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            border: none;
            padding: 1.2rem 1.5rem;
        }

        .card-header h4, .card-header h5 {
            color: white;
            margin: 0;
            font-weight: 600;
        }

        /* Button Styles */
        .btn {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 15px rgba(37,99,235,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
        }

        .btn-outline-primary:hover {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent-yellow), var(--accent-gold));
            border: none;
            color: #1f2937;
        }

        /* Badge Styles */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-pending { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #1f2937; }
        .badge-approved { background: linear-gradient(135deg, #10b981, #059669); color: white; }
        .badge-rejected { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        .badge-shipped { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: slideInDown 0.5s;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Form Styles */
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 0.7rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .footer a {
            color: var(--accent-yellow);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--accent-gold);
        }

        /* Animation Classes */
        .fade-up {
            animation: fadeUp 0.8s ease-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Rating Stars */
        .rating-stars {
            color: var(--accent-yellow);
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-section {
                padding: 2rem 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-hands-helping me-2"></i>MakerMarket
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 30 30\'%3e%3cpath stroke=\'rgba(255, 255, 255, 0.9)\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' stroke-width=\'2\' d=\'M4 7h22M4 15h22M4 23h22\'/%3e%3c/svg%3e');"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Inloggen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark px-3 ms-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Registreren
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-store me-1"></i>Producten
                            </a>
                        </li>

                        @if(auth()->user()->role === 'maker')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('maker.products.index') }}">
                                    <i class="fas fa-hammer me-1"></i>Mijn producten
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('maker.orders.index') }}">
                                    <i class="fas fa-truck me-1"></i>Bestellingen
                                    @php $pendingOrders = auth()->user()->products->flatMap->orders->where('status', 'in productie')->count(); @endphp
                                    @if($pendingOrders > 0)
                                        <span class="badge bg-warning text-dark ms-1">{{ $pendingOrders }}</span>
                                    @endif
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'koper')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    <i class="fas fa-shopping-cart me-1"></i>Mijn bestellingen
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'moderator')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="moderatorDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-gavel me-1"></i>Moderatie
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('moderator.products') }}">📦 Producten</a></li>
                                    <li><a class="dropdown-item" href="{{ route('moderator.users') }}">👥 Gebruikers</a></li>
                                    <li><a class="dropdown-item" href="{{ route('moderator.reports') }}">🚨 Meldingen</a></li>
                                    <li><a class="dropdown-item" href="{{ route('moderator.search') }}">🔍 Zoeken</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('moderator.statistics') }}">📊 Statistieken</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('notifications.index') }}">
                                <i class="fas fa-bell me-1"></i>
                                @php $unreadCount = auth()->user()->notifications()->where('is_read', false)->count(); @endphp
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount }}
                                        <span class="visually-hidden">notificaties</span>
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-id-card me-2"></i>Profiel
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Uitloggen
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if(!request()->routeIs('home') && !request()->routeIs('products.show'))
            <div class="container py-3">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Er zijn fouten gevonden:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-hands-helping me-2"></i>MakerMarket</h5>
                    <p class="text-muted">Waar ambachtelijke makers hun unieke producten delen met gepassioneerde kopers. Samen bouwen we aan een duurzame toekomst.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Navigatie</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-muted text-decoration-none">Producten</a></li>
                        @auth
                            <li><a href="{{ route('profile.edit') }}" class="text-muted text-decoration-none">Profiel</a></li>
                            <li><a href="{{ route('notifications.index') }}" class="text-muted text-decoration-none">Notificaties</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Volg ons</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Contact</h6>
                    <p class="text-muted mb-1"><i class="fas fa-envelope me-2"></i>info@makermarket.nl</p>
                    <p class="text-muted"><i class="fas fa-phone me-2"></i>+31 (0)20 123 4567</p>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center text-muted">
                <small>&copy; {{ date('Y') }} MakerMarket - Alle rechten voorbehouden</small>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        // Add loading state to forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if(submitBtn && !submitBtn.classList.contains('no-loading')) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="loading-spinner me-2"></span>Bezig...';
                    submitBtn.disabled = true;

                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
