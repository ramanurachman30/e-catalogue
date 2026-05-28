@extends('layouts.landing')

@section('title', 'Home - Stasa Gallery')

@push('styles')
    <style>
        /* Hero Section Modernization */
        .hero-modern {
            padding: 150px 0 100px;
            background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('{{ asset('assets/images/bg-pattern.png') }}');
            text-align: center;
        }

        .hero-modern h2 {
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-family: var(--font-sans);
            font-weight: 500;
        }

        .hero-modern h1 {
            font-size: 4rem;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .hero-modern p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto 40px;
        }

        /* Carousel Modernization */
        .carousel-container {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .carousel-item {
            height: 600px;
            border-radius: 0;
        }

        .carousel-item img {
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
        }

        .carousel-caption {
            bottom: 15%;
            text-align: left;
            left: 10%;
            right: auto;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            color: var(--text-dark);
            border-radius: 0;
            border-left: 5px solid var(--primary-color);
            box-shadow: 20px 20px 0 rgba(163, 50, 42, 0.1);
        }

        .carousel-caption h5 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .carousel-caption p {
            font-family: var(--font-sans);
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        /* Card Modernization */
        .art-card {
            border: none;
            border-radius: 0;
            transition: all 0.4s ease;
            background: transparent;
        }

        .art-card .card-img-container {
            height: 350px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .art-card .card-img-top {
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .art-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .art-card .card-body {
            padding: 25px 0;
        }

        .art-card .card-title {
            font-size: 1.25rem;
            margin-bottom: 5px;
        }

        .art-card .author {
            font-family: var(--font-sans);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .art-card .details {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .btn-wa-modern {
            display: inline-block;
            width: 100%;
            padding: 12px;
            background-color: #25d366;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-wa-modern:hover {
            background-color: #128c7e;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        @media (max-width: 768px) {
            .hero-modern h1 { font-size: 2.5rem; }
            .carousel-item { height: 400px; }
            .carousel-caption { 
                padding: 20px; 
                left: 5%; 
                right: 5%; 
                max-width: 100%; 
                bottom: 5%;
            }
        }
    </style>
@endpush

@section('content')
<!-- Modern Hero -->
<section class="hero-modern">
    <div class="container">
        <h2>Curated Collection</h2>
        <h1>Where Art Meets <br> Imagination</h1>
        <p>Explore a world of artistic expression through our exclusive collection of masterpieces from renowned artists.</p>
        <a href="{{ route('gallery') }}" class="btn btn-primary-custom">Explore Gallery</a>
    </div>
</section>

<!-- Carousel Section -->
<div class="container carousel-container">
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($catalogues as $key => $value)
                <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner shadow-lg">
            @foreach($catalogues as $key => $value)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="5000">
                <img src="{{ asset('storage/' . $value->img) }}" class="d-block w-100" alt="{{ $value->name }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $value->name }}</h5>
                    <p>{{ Str::limit($value->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Art Preview Section -->
<section class="py-5 mt-5">
    <div class="container py-5">
        <div class="section-title">
            <h2>Art Preview</h2>
            <p class="text-muted">Jelajahi beberapa karya pilihan terbaru kami</p>
        </div>

        <div class="row g-5">
            @foreach($catalogues as $catalogue)
            @php
                $wa_number = $whatsapp->url ?? '628381090769';
                $wa_number = preg_replace('/[^0-9]/', '', $wa_number);
                $message = urlencode("Halo Stasa Gallery, saya tertarik untuk memesan karya seni berikut:\n\nNama Produk: " . $catalogue->name . "\nAuthor: " . $catalogue->author . "\nUkuran: " . $catalogue->size_painting . "\n\nMohon informasi lebih lanjut. Terima kasih.");
                $wa_url = "https://wa.me/{$wa_number}?text={$message}";
            @endphp
            <div class="col-md-6 col-lg-3">
                <div class="art-card">
                    <div class="card-img-container">
                        <img src="{{ asset('storage/' . $catalogue->img) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $catalogue->name }}" onerror="this.src='{{ asset('assets/images/image2.jpeg') }}'">
                        <div class="badge bg-dark position-absolute top-0 end-0 m-3 px-3 py-2 rounded-0 small">{{ $catalogue->status->name ?? 'Tersedia' }}</div>
                    </div>
                    <div class="card-body">
                        <div class="author">{{ $catalogue->author }}</div>
                        <h3 class="card-title">{{ $catalogue->name }}</h3>
                        <div class="details">{{ $catalogue->size_painting }}</div>
                        <a href="{{ $wa_url }}" target="_blank" class="btn-wa-modern">
                             Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            @if($catalogues->isEmpty())
                <div class="col-12 text-center py-5">
                    <p class="text-muted italic">Koleksi belum tersedia.</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('gallery') }}" class="btn btn-outline-dark px-5 py-3 rounded-0 fw-bold text-uppercase letter-spacing-1">Lihat Seluruh Koleksi</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 mb-4">Ingin Mengetahui Lebih Lanjut Tentang Kami?</h2>
                <p class="lead text-muted mb-4">Pelajari sejarah, visi, dan misi Stasa Gallery dalam mendukung para seniman lokal dan internasional.</p>
                <a href="{{ route('about') }}" class="btn btn-primary-custom">Tentang Kami</a>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="{{ asset('assets/images/image1.jpeg') }}" class="img-fluid shadow-lg" alt="About Us Preview">
            </div>
        </div>
    </div>
</section>
@endsection
