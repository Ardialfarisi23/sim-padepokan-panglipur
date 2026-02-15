@extends('layouts.landing')


@section('title', $informasi->judul)


@section('content')
@include('layouts.navbar')


<section class="detail-berita">
    <div class="detail-container">


        {{-- CONTENT --}}
        <div class="detail-main">
            <img class="detail-thumb"
                 src="{{ asset('storage/'.$informasi->thumbnail) }}"
                 alt="{{ $informasi->judul }}">


            <h1 class="detail-title">
                {{ $informasi->judul }}
            </h1>


            <span class="detail-date">
                {{ $informasi->created_at->translatedFormat('d F Y') }}
            </span>


            <div class="detail-content">
                {!! nl2br(e($informasi->konten)) !!}
            </div>
        </div>


        {{-- SIDEBAR --}}
        <aside class="detail-sidebar">


            @foreach ($informasi_lainnya as $item)
                <div class="sidebar-card">
                    <img src="{{ asset('storage/'.$item->thumbnail) }}"
                         alt="{{ $item->judul }}">


                    <div class="sidebar-body">
                        <span class="sidebar-label">Berita</span>
                        <h4>{{ $item->judul }}</h4>


                        <a href="{{ route('informasi.show', $item->slug) }}"
                           class="animated-button animated-button--white informasi-btn">


    <svg class="arr-1" viewBox="0 0 24 24">
        <path d="M5 12h14M13 5l6 7-6 7"/>
    </svg>


    <span class="text">Selengkapnya</span>


    <span class="circle"></span>


    <svg class="arr-2" viewBox="0 0 24 24">
        <path d="M5 12h14M13 5l6 7-6 7"/>
    </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </aside>


    </div>
</section>
@endsection
