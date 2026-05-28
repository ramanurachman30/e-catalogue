<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Stasa Gallery')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Global Custom Styles -->
    <style>
        :root {
            --primary-color: #a3322a;
            --primary-dark: #8b2922;
            --text-dark: #1a1a1a;
            --text-muted: #6c757d;
            --bg-light: #fdfdfd;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Montserrat', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: var(--font-serif);
            font-weight: 700;
        }

        .navbar {
            transition: all 0.4s ease;
            padding: 20px 0;
            background-color: transparent !important;
        }

        .navbar.scrolled {
            background-color: rgba(163, 50, 42, 0.98) !important;
            backdrop-filter: blur(15px);
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-size: 1.6rem;
            letter-spacing: 2px;
            color: #fff !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .navbar.scrolled .navbar-brand {
            text-shadow: none;
        }

        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            margin: 0 12px;
            position: relative;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.9) !important;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }

        .navbar.scrolled .nav-link {
            color: #fff !important;
            text-shadow: none;
            opacity: 0.85;
        }

        .navbar.scrolled .nav-link:hover, 
        .navbar.scrolled .nav-link.active {
            opacity: 1;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-family: var(--font-sans);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 0; /* Modern gallery look often uses sharp edges */
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(163, 50, 42, 0.3);
        }

        footer {
            background-color: #1a1a1a !important;
            color: #fff !important;
        }

        footer a {
            color: rgba(255,255,255,0.7) !important;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--primary-color) !important;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">STASA GALLERY</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('event') ? 'active' : '' }}" href="{{ route('event') }}">Event</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="py-5 mt-5">
    <div class="container px-md-3">
        <div class="row g-4">
            <div class="col-lg-4 mb-3">
                <h4 class="mb-4 text-white">STASA GALLERY</h4>
                <p class="text-secondary">Eksplorasi visual yang mengangkat nilai estetika, imajinasi, dan ekspresi artistik dalam setiap karya seni lukis eksklusif.</p>
                <p class="text-secondary small mt-4">&copy; {{ date('Y') }} Stasa Gallery. All rights reserved.</p>
            </div>
            <div class="col-6 col-lg-2 mb-3">
                <h5 class="mb-4 text-white">Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ route('gallery') }}" class="text-decoration-none">Gallery</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none">About</a></li>
                    <li class="mb-2"><a href="{{ route('event') }}" class="text-decoration-none">Event</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <h5 class="mb-4 text-white">Social Media</h5>
                <ul class="list-unstyled">
                    @foreach($sosmeds as $sosmed)
                        <li class="mb-2"><a href="{{ $sosmed->url }}" target="_blank" class="text-decoration-none">{{ $sosmed->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 mb-3">
                <h5 class="mb-4 text-white">Contact</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2">Ciater Barat, Tangerang Selatan</li>
                    <li class="mb-2">info@stasagallery.com</li>
                    <li class="mb-2">+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- javascript bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const navbar = document.getElementById("mainNav");

    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>
@stack('scripts')
</body>
</html>
