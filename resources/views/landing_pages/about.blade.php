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
        @if(isset($about->sub_title))
            <h4 class="fw-bold mt-2">{{ $about->sub_title }}</h4>
        @endif
        <div class="mt-3">
            {!! $about->description ?? '' !!}
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
                <div class="description-left">
                    @php
                        $contentLeft = $about->content_left ?? '';
                        // Inject 'dropcap' class ONLY into the first <p> tag
                        $contentLeft = Str::replaceFirst('<p>', '<p class="dropcap">', $contentLeft);
                    @endphp
                    {!! $contentLeft !!}
                </div>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="description-right">
                    {!! $about->content_right ?? '' !!}
                </div>
                @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded shadow mt-3" alt="About Image">
                @else
                    <img src="{{ asset('assets/images/image1.jpeg') }}" class="img-fluid rounded shadow mt-3" alt="Default Artwork">
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
