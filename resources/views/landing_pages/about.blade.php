@extends('layouts.landing')

@section('title', 'About Us - Stasa Gallery')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>{{ $about->title ?? 'ABOUT STASA GALLERY' }}</h1>
        <div class="mt-3">
            {!! nl2br(e($about->description ?? 'Lahirnya Karya masdibyo yang dipamerkan dalam peresmian Stasa Gallery masdibyo')) !!}
        </div>
        <hr>
        <p>
            @if(isset($vissions))
                @foreach($vissions as $vission)
                    <strong>{{ $vission->title }}:</strong> {{ $vission->description }} <br>
                @endforeach
            @endif
        </p>
    </div>
</section>

<!-- Content -->
<section class="content py-5">
    <div class="container">
        <div class="row">
            <!-- Kiri -->
            <div class="col-md-6">
                <p class="dropcap">
                    Aku tak pernah mengeluhkan apa pun kepada siapa pun,
                    kecuali pada kesunyianku sendiri...
                </p>
                <p>
                    Jujur, selama ini aku bisa mengabaikan sikap mereka
                    dengan terus berkarya...
                </p>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <p>
                    Karya-karyaku adalah orang-orang berkelas,
                    dengan daya beli yang layak...
                </p>
                @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded shadow" alt="About Image">
                @else
                    <img src="{{ asset('assets/images/image1.jpeg') }}" class="img-fluid rounded shadow" alt="Default Artwork">
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
