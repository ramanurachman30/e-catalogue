@extends('layouts.landing')

@section('title', $event->name . ' - Stasa Gallery')

@push('styles')
    <style>
        .event-detail-hero {
            position: relative;
            height: 500px;
            overflow: hidden;
        }

        .event-detail-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.4);
        }

        .event-detail-hero .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            padding-bottom: 60px;
        }

        .event-detail-hero .hero-overlay .container {
            color: #fff;
        }

        .event-detail-hero .event-meta {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .event-detail-hero .event-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-sans);
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .event-detail-hero .event-meta-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .event-status-badge {
            display: inline-block;
            padding: 6px 18px;
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .badge-upcoming {
            background-color: var(--primary-color);
            color: #fff;
        }

        .badge-past {
            background-color: #6c757d;
            color: #fff;
        }

        .event-detail-content {
            padding: 80px 0;
        }

        .event-detail-content .description-section {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #444;
        }

        .event-detail-content .description-section p {
            margin-bottom: 1.2rem;
        }

        .event-info-card {
            background: #f8f9fa;
            padding: 40px;
            border-left: 4px solid var(--primary-color);
            position: sticky;
            top: 100px;
        }

        .event-info-card h5 {
            font-size: 1.1rem;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: var(--font-sans);
            font-weight: 700;
            color: var(--primary-color);
        }

        .event-info-card .info-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .event-info-card .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .event-info-card .info-label {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .event-info-card .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Other Events Section */
        .other-events-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .other-events-section .section-header {
            margin-bottom: 50px;
        }

        .other-events-section .section-header h2 {
            font-size: 2rem;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .other-events-section .section-header h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            bottom: 0;
            left: 0;
        }

        .other-event-card {
            background: #fff;
            transition: all 0.4s ease;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .other-event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .other-event-card .card-img-container {
            height: 220px;
            overflow: hidden;
        }

        .other-event-card .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .other-event-card:hover .card-img-container img {
            transform: scale(1.1);
        }

        .other-event-card .card-body {
            padding: 25px;
        }

        .other-event-card .card-body .event-date {
            font-family: var(--font-sans);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .other-event-card .card-body h5 {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .other-event-card .card-body p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 15px;
        }

        .btn-detail {
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

        .btn-detail:hover {
            background-color: var(--text-dark);
            color: #fff;
        }

        .breadcrumb-nav {
            padding: 15px 0;
            background: transparent;
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

        @media (max-width: 768px) {
            .event-detail-hero {
                height: 350px;
            }

            .event-detail-hero h1 {
                font-size: 1.8rem;
            }

            .event-detail-content {
                padding: 40px 0;
            }

            .event-info-card {
                margin-top: 40px;
                position: static;
            }
        }
    </style>
@endpush

@section('content')
<!-- Hero -->
<section class="event-detail-hero">
    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/image1.jpeg') }}" alt="{{ $event->name }}">
    <div class="hero-overlay">
        <div class="container">
            @php
                $isUpcoming = \Carbon\Carbon::parse($event->end_date)->gte(now());
            @endphp
            <span class="event-status-badge {{ $isUpcoming ? 'badge-upcoming' : 'badge-past' }}">
                {{ $isUpcoming ? 'Upcoming Event' : 'Past Event' }}
            </span>
            <h1 class="display-5 fw-bold">{{ $event->name }}</h1>
            <div class="event-meta">
                <div class="event-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} – {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                </div>
                <div class="event-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    {{ $event->location }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="container">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('event') }}">Events</a>
        <span class="separator">/</span>
        <span>{{ $event->name }}</span>
    </nav>
</div>

<!-- Content -->
<section class="event-detail-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="description-section">
                    {!! $event->description !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="event-info-card">
                    <h5>Detail Event</h5>
                    <div class="info-item">
                        <div class="info-label">Nama Event</div>
                        <div class="info-value">{{ $event->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal Mulai</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal Selesai</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($event->end_date)->format('d F Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Lokasi</div>
                        <div class="info-value">{{ $event->location }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            <span class="event-status-badge {{ $isUpcoming ? 'badge-upcoming' : 'badge-past' }}" style="font-size: 0.7rem; padding: 4px 12px;">
                                {{ $isUpcoming ? 'Upcoming' : 'Selesai' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Events -->
@if($otherEvents->count() > 0)
<section class="other-events-section">
    <div class="container">
        <div class="section-header">
            <h2>Event Lainnya</h2>
        </div>
        <div class="row g-4">
            @foreach($otherEvents as $otherEvent)
            <div class="col-md-4">
                <div class="other-event-card">
                    <div class="card-img-container">
                        <img src="{{ $otherEvent->image ? asset('storage/' . $otherEvent->image) : asset('assets/images/image3.jpeg') }}" alt="{{ $otherEvent->name }}">
                    </div>
                    <div class="card-body">
                        <div class="event-date">{{ \Carbon\Carbon::parse($otherEvent->start_date)->format('d M Y') }}</div>
                        <h5>{{ $otherEvent->name }}</h5>
                        <p>{{ $otherEvent->location }}</p>
                        <a href="{{ route('event.detail', $otherEvent->id) }}" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
