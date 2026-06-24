@extends('layouts.landing')

@section('title', 'Gallery - Stasa Gallery')

@push('styles')
    <style>
        .gallery-header {
            padding: 150px 0 60px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .search-box-modern {
            background: #fff;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
        }

        .search-box-modern input {
            border: none;
            padding: 10px 20px;
            width: 100%;
            outline: none;
            font-family: var(--font-sans);
        }

        .filter-nav {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            overflow-x: auto;
        }

        .filter-item {
            text-decoration: none;
            color: var(--text-muted);
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            position: relative;
            padding-bottom: 15px;
            transition: all 0.3s ease;
        }

        .filter-item:hover, .filter-item.active {
            color: var(--primary-color);
        }

        .filter-item.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
            bottom: -1px;
            left: 0;
        }

        /* Card Modernization (Same as Home) */
        .art-card {
            border: none;
            border-radius: 0;
            transition: all 0.4s ease;
            background: transparent;
            margin-bottom: 40px;
        }

        .art-card .card-img-container {
            height: 400px;
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
            font-size: 1.4rem;
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
            font-size: 0.9rem;
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

        .pagination {
            border-radius: 0;
        }

        .page-link {
            color: var(--text-dark);
            border: 1px solid #eee;
            padding: 10px 20px;
            font-family: var(--font-sans);
            font-weight: 600;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
@endpush

@section('content')
<!-- Gallery Header -->
<section class="gallery-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-2">Our Gallery</h1>
                <p class="text-muted lead">Jelajahi koleksi lengkap lukisan eksklusif kami.</p>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <form action="{{ route('gallery') }}" method="GET">
                    <div class="search-box-modern">
                        <input type="text" name="search" placeholder="Cari karya atau seniman..." value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category', 'all') }}">
                        <button class="btn btn-primary-custom" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-5 mt-4">
    <!-- Filter Navigation -->
    <div class="filter-nav">
        <a href="{{ route('gallery', ['category' => 'all', 'search' => request('search')]) }}" class="filter-item {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">Semua Karya</a>
        @foreach($categories as $category)
            <a href="{{ route('gallery', ['category' => $category->name, 'search' => request('search')]) }}" class="filter-item {{ request('category') == $category->name ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Gallery Grid -->
    <div class="row">
        @forelse($catalogues as $catalogue)
        @php
            $wa_number = $whatsapp->url ?? '6281220568007';
            $wa_number = preg_replace('/[^0-9]/', '', $wa_number);
            $message = urlencode("Halo Stasa Gallery, saya tertarik untuk memesan karya seni berikut:\n\nNama Produk: " . $catalogue->name . "\nAuthor: " . $catalogue->author . "\nUkuran: " . $catalogue->size_painting . "\n\nMohon informasi lebih lanjut. Terima kasih.");
            $wa_url = "https://wa.me/{$wa_number}?text={$message}";
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="art-card">
                <a href="{{ route('catalogue.detail', $catalogue->id) }}">
                    <div class="card-img-container">
                        <img src="{{ asset('storage/' . $catalogue->img) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $catalogue->name }}" onerror="this.src='{{ asset('assets/images/image2.jpeg') }}'">
                        <div class="badge bg-dark position-absolute top-0 end-0 m-4 px-3 py-2 rounded-0 small shadow-sm">{{ $catalogue->status->name ?? 'Tersedia' }}</div>
                    </div>
                </a>
                <div class="card-body">
                    <div class="author">{{ $catalogue->author }}</div>
                    <h3 class="card-title"><a href="{{ route('catalogue.detail', $catalogue->id) }}" style="text-decoration: none; color: inherit;">{{ $catalogue->name }}</a></h3>
                    <div class="details">{{ $catalogue->size_painting }} | {{ $catalogue->category->name ?? 'Uncategorized' }}</div>
                    <a href="{{ $wa_url }}" target="_blank" class="btn-wa-modern">
                         Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="py-5">
                <h3 class="text-muted">Tidak ada karya yang ditemukan.</h3>
                <p>Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('gallery') }}" class="btn btn-outline-dark mt-3 px-4 py-2 rounded-0">Reset Filter</a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $catalogues->appends(request()->query())->links() }}
    </div>
</div>
@endsection
