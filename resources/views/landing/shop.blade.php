@extends('landing.layouts.app')

@section('title', 'Belanja - Fruitables')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Belanja</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Produk</li>
        </ol>
    </div>

    <main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <h2 class="text-primary mb-0">Buah dan Sayur Segar</h2>
            <form action="{{ route('shop.index') }}" method="GET" class="d-flex gap-2">
                <label for="product-search" class="visually-hidden">Cari produk</label>
                <input id="product-search" type="search" name="q" value="{{ request('q') }}" class="form-control rounded-pill" placeholder="Cari produk">
                <button class="btn btn-primary rounded-pill px-4 text-white" type="submit">Cari</button>
            </form>
        </div>

        <div class="d-flex gap-2 mb-4">
            <a href="{{ route('shop.index', request()->only('q')) }}" class="btn btn-outline-primary rounded-pill">Semua</a>
            <a href="{{ route('shop.index', array_merge(request()->only('q'), ['category' => 'Buah'])) }}" class="btn btn-outline-primary rounded-pill">Buah</a>
            <a href="{{ route('shop.index', array_merge(request()->only('q'), ['category' => 'Sayur'])) }}" class="btn btn-outline-primary rounded-pill">Sayur</a>
        </div>

        @if ($products->isEmpty())
            <div class="alert alert-info">Produk tidak ditemukan. Coba kata kunci lain.</div>
        @else
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <article class="rounded position-relative fruite-item h-100">
                            <a href="{{ route('shop.show', $product['id']) }}" class="fruite-img d-block">
                                <img src="{{ asset('landing/img/'.$product['image']) }}" class="img-fluid w-100 rounded-top" alt="{{ $product['name'] }}">
                            </a>
                            <span class="text-white bg-secondary px-3 py-1 rounded position-absolute top-0 start-0 m-2">{{ $product['category'] }}</span>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h3 class="h5"><a href="{{ route('shop.show', $product['id']) }}" class="text-dark">{{ $product['name'] }}</a></h3>
                                <p>{{ $product['description'] }}</p>
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <strong class="text-dark">${{ number_format($product['price'], 2) }}</strong>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btn border border-secondary rounded-pill px-3 text-primary" type="submit">
                                            <i class="fa fa-shopping-bag me-1" aria-hidden="true"></i> Tambah
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
@endsection
