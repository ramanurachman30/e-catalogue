@extends('layouts.landing')

@section('title', $catalogue->name . ' - Stasa Gallery')

@push('styles')
    <style>
        .catalogue-detail-section {
            padding: 140px 0 80px;
        }

        .breadcrumb-nav {
            margin-bottom: 40px;
        }

        .breadcrumb-nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-family: var(--font-sans);
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb-nav a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-nav span {
            color: var(--text-muted);
            font-family: var(--font-sans);
            font-size: 0.85rem;
        }

        .breadcrumb-nav .separator {
            margin: 0 10px;
            color: #ccc;
        }

        /* Image Section */
        .catalogue-image-wrapper {
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            background: #f5f5f5;
        }

        .catalogue-image-wrapper img {
            width: 100%;
            height: auto;
            max-height: 650px;
            object-fit: contain;
            display: block;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .catalogue-image-wrapper:hover img {
            transform: scale(1.03);
        }

        .catalogue-image-wrapper .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 20px;
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            z-index: 2;
        }

        .status-available {
            background-color: var(--primary-color);
            color: #fff;
        }

        .status-sold {
            background-color: #333;
            color: #fff;
        }

        /* Info Section */
        .catalogue-info {
            padding-left: 40px;
        }

        .catalogue-info .category-label {
            font-family: var(--font-sans);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
            display: inline-block;
        }

        .catalogue-info h1 {
            font-size: 2.5rem;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .catalogue-info .author-name {
            font-family: var(--font-sans);
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 30px;
            font-weight: 500;
        }

        .catalogue-info .author-name strong {
            color: var(--text-dark);
        }

        .catalogue-info .divider {
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            margin-bottom: 30px;
        }

        .catalogue-info .description-text {
            font-size: 1rem;
            line-height: 1.9;
            color: #555;
            margin-bottom: 35px;
        }

        /* Specification Table */
        .spec-table {
            width: 100%;
            margin-bottom: 35px;
        }

        .spec-table .spec-row {
            display: flex;
            border-bottom: 1px solid #eee;
            padding: 14px 0;
        }

        .spec-table .spec-row:last-child {
            border-bottom: none;
        }

        .spec-table .spec-label {
            width: 140px;
            flex-shrink: 0;
            font-family: var(--font-sans);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .spec-table .spec-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        /* WhatsApp Button */
        .btn-wa-detail {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 16px 30px;
            background-color: #25d366;
            color: white;
            text-decoration: none;
            font-family: var(--font-sans);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
            text-align: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-wa-detail:hover {
            background-color: #128c7e;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
        }

        .btn-wa-detail svg {
            width: 22px;
            height: 22px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: 2px solid var(--text-dark);
            color: var(--text-dark);
            text-decoration: none;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-top: 15px;
            width: 100%;
            justify-content: center;
        }

        .btn-back:hover {
            background-color: var(--text-dark);
            color: #fff;
        }

        /* Related Section */
        .related-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .related-section .section-header {
            margin-bottom: 50px;
        }

        .related-section .section-header h2 {
            font-size: 2rem;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .related-section .section-header h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            bottom: 0;
            left: 0;
        }

        .related-card {
            border: none;
            border-radius: 0;
            transition: all 0.4s ease;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .related-card .card-img-container {
            height: 280px;
            overflow: hidden;
        }

        .related-card .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .related-card:hover .card-img-container img {
            transform: scale(1.1);
        }

        .related-card .card-body {
            padding: 25px;
        }

        .related-card .card-body .author {
            font-family: var(--font-sans);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .related-card .card-body h5 {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .related-card .card-body .details {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 15px;
        }

        .btn-view-detail {
            display: inline-block;
            padding: 8px 24px;
            border: 2px solid var(--text-dark);
            color: var(--text-dark);
            text-decoration: none;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-view-detail:hover {
            background-color: var(--text-dark);
            color: #fff;
        }

        @media (max-width: 991px) {
            .catalogue-info {
                padding-left: 0;
                margin-top: 40px;
            }

            .catalogue-info h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .catalogue-detail-section {
                padding: 120px 0 50px;
            }

            .catalogue-info h1 {
                font-size: 1.6rem;
            }

            .spec-table .spec-row {
                flex-direction: column;
                gap: 4px;
            }

            .spec-table .spec-label {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
<section class="catalogue-detail-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('gallery') }}">Gallery</a>
            <span class="separator">/</span>
            <span>{{ $catalogue->name }}</span>
        </nav>

        <div class="row">
            <!-- Image -->
            <div class="col-lg-6">
                <div class="catalogue-image-wrapper">
                    <img src="{{ asset('storage/' . $catalogue->img) }}" alt="{{ $catalogue->name }}" onerror="this.src='{{ asset('assets/images/image2.jpeg') }}'">
                    <div class="status-badge {{ strtolower($catalogue->status->name ?? '') == 'terjual' || strtolower($catalogue->status->name ?? '') == 'sold' ? 'status-sold' : 'status-available' }}">
                        {{ $catalogue->status->name ?? 'Tersedia' }}
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="col-lg-6">
                <div class="catalogue-info">
                    <span class="category-label">{{ $catalogue->category->name ?? 'Uncategorized' }}</span>
                    <h1>{{ $catalogue->name }}</h1>
                    <p class="author-name">oleh <strong>{{ $catalogue->author }}</strong></p>

                    <div class="divider"></div>

                    @if($catalogue->description)
                    <div class="description-text">
                        {!! $catalogue->description !!}
                    </div>
                    @endif

                    <!-- Specifications -->
                    <div class="spec-table">
                        <div class="spec-row">
                            <div class="spec-label">Seniman</div>
                            <div class="spec-value">{{ $catalogue->author }}</div>
                        </div>
                        <div class="spec-row">
                            <div class="spec-label">Ukuran</div>
                            <div class="spec-value">{{ $catalogue->size_painting }}</div>
                        </div>
                        <div class="spec-row">
                            <div class="spec-label">Kategori</div>
                            <div class="spec-value">{{ $catalogue->category->name ?? 'Uncategorized' }}</div>
                        </div>
                        @if($catalogue->date_release)
                        <div class="spec-row">
                            <div class="spec-label">Tahun</div>
                            <div class="spec-value">{{ \Carbon\Carbon::parse($catalogue->date_release)->format('Y') }}</div>
                        </div>
                        @endif
                        <div class="spec-row">
                            <div class="spec-label">Status</div>
                            <div class="spec-value">{{ $catalogue->status->name ?? 'Tersedia' }}</div>
                        </div>
                    </div>

                    <!-- WhatsApp Order -->
                    @php
                        $wa_number = $whatsapp->url ?? '6281220568007';
                        $wa_number = preg_replace('/[^0-9]/', '', $wa_number);
                        $message = urlencode("Halo Stasa Gallery, saya tertarik untuk memesan karya seni berikut:\n\nNama Produk: " . $catalogue->name . "\nAuthor: " . $catalogue->author . "\nUkuran: " . $catalogue->size_painting . "\n\nMohon informasi lebih lanjut. Terima kasih.");
                        $wa_url = "https://wa.me/{$wa_number}?text={$message}";
                    @endphp
                    <a href="{{ $wa_url }}" target="_blank" class="btn-wa-detail">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Pesan via WhatsApp
                    </a>
                    <a href="{{ route('gallery') }}" class="btn-back">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Kembali ke Gallery
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Artworks -->
@if($relatedCatalogues->count() > 0)
<section class="related-section">
    <div class="container">
        <div class="section-header">
            <h2>Karya Serupa</h2>
        </div>
        <div class="row g-4">
            @foreach($relatedCatalogues as $related)
            <div class="col-md-6 col-lg-3">
                <div class="related-card">
                    <div class="card-img-container">
                        <img src="{{ asset('storage/' . $related->img) }}" alt="{{ $related->name }}" onerror="this.src='{{ asset('assets/images/image2.jpeg') }}'">
                    </div>
                    <div class="card-body">
                        <div class="author">{{ $related->author }}</div>
                        <h5>{{ $related->name }}</h5>
                        <div class="details">{{ $related->size_painting }} | {{ $related->category->name ?? 'Uncategorized' }}</div>
                        <a href="{{ route('catalogue.detail', $related->id) }}" class="btn-view-detail">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
