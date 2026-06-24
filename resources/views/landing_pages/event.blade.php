@extends('layouts.landing')

@section('title', 'Events - Stasa Gallery')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/event.css') }}">
@endpush

@section('content')
<!-- HERO EVENT -->
@if($upcomingEvent)
<section class="event-hero d-flex align-items-center text-center" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ $upcomingEvent->image ? asset('storage/' . $upcomingEvent->image) : asset('assets/images/image1.jpeg') }}'); background-size: cover; background-position: center; height: 400px; color: white;">
    <div class="container">
        <h1 class="fw-bold">{{ $upcomingEvent->name }}</h1>
        <p class="mt-3">{{ \Carbon\Carbon::parse($upcomingEvent->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($upcomingEvent->end_date)->format('d F Y') }}</p>
        <p>{{ $upcomingEvent->location }}</p>
    </div>
</section>

<!-- DESKRIPSI EVENT -->
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold">{{ $upcomingEvent->name }}</h3>
        <p class="fw-semibold">
            {{ \Carbon\Carbon::parse($upcomingEvent->start_date)->format('d F Y') }} – {{ \Carbon\Carbon::parse($upcomingEvent->end_date)->format('d F Y') }} <br>
            {{ $upcomingEvent->location }}
        </p>

        <div class="mt-4">
            {!! $upcomingEvent->description !!}
        </div>

        <hr>
    </div>
</section>
@else
<section class="py-5 text-center">
    <div class="container">
        <h1 class="fw-bold">No Upcoming Art Exhibitions</h1>
        <p>Stay tuned for our next events!</p>
    </div>
</section>
@endif

<!-- ARTWORK -->
<section class="artwork py-5">
    <div class="container">
        <h4 class="fw-bold mb-4">Past & Other Events</h4>

        <div class="row g-4">
            @foreach($events as $event)
                @if(!$upcomingEvent || $event->id != $upcomingEvent->id)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/image3.jpeg') }}" class="card-img-top" alt="{{ $event->name }}">
                        <div class="card-body text-center d-flex flex-column">
                            <h6 class="card-title fw-bold">{{ $event->name }}</h6>
                            <p class="small text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('M Y') }}</p>
                            <a href="{{ route('event.detail', $event->id) }}" class="btn btn-outline-secondary btn-sm mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @if($events->count() <= 1 && $upcomingEvent)
            <div class="text-center mt-4">
                <p>No other events available.</p>
            </div>
        @endif
    </div>
</section>
@endsection
