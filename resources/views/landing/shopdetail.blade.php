@extends('landing.layouts.app')

@section('title', $product['name'].' - Fruitables')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Detail Produk</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Belanja</a></li>
            <li class="breadcrumb-item active text-white">{{ $product['name'] }}</li>
        </ol>
    </div>

    <main class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('landing/img/'.$product['image']) }}" class="img-fluid rounded w-100" alt="{{ $product['name'] }}">
            </div>
            <div class="col-lg-6">
                <span class="text-secondary fw-semibold">{{ $product['category'] }}</span>
                <h2 class="display-5 fw-bold mt-2">{{ $product['name'] }}</h2>
                <p class="fs-3 fw-bold text-primary">${{ number_format($product['price'], 2) }} <span class="fs-6 text-muted">/ kg</span></p>
                <p class="mb-4">{{ $product['description'] }}</p>
                <form action="{{ route('cart.store') }}" method="POST" class="d-flex flex-wrap align-items-end gap-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <div>
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input id="quantity" type="number" name="quantity" class="form-control" value="1" min="1" max="99" required>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4 py-3 text-white" type="submit">
                        <i class="fa fa-shopping-bag me-2" aria-hidden="true"></i> Tambahkan ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
