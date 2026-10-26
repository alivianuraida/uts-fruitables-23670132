@extends('landing.layouts.app')

@section('title', 'Fruitables - Buah dan Sayur Segar')

@section('content')
    <section class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7">
                    <p class="mb-3 text-secondary fw-bold">Segar dari kebun untuk keluarga</p>
                    <h1 class="mb-4 display-3 text-primary">Buah dan sayur pilihan, setiap hari.</h1>
                    <p class="mb-4 text-dark">Belanja hasil bumi berkualitas dengan mudah. Pilih produk favorit dan kami siapkan untuk Anda.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-4 py-3 text-white">Mulai Belanja</a>
                </div>
                <div class="col-lg-5">
                    <img src="{{ asset('landing/img/hero-img-1.png') }}" class="img-fluid w-100 rounded" alt="Pilihan buah segar">
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-secondary mb-1">Pilihan terbaik</p>
                <h2 class="text-primary mb-0">Produk Segar Kami</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn border-secondary rounded-pill px-4 py-2 text-primary">Lihat Semua</a>
        </div>

        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-sm-6 col-lg-3">
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
    </section>
@endsection
