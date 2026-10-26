@extends('landing.layouts.app')

@section('title', 'Keranjang - Fruitables')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Keranjang Belanja</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Keranjang</li>
        </ol>
    </div>

    <main class="container py-5">
        @if ($items->isEmpty())
            <div class="text-center py-5">
                <h2 class="text-primary">Keranjang Anda masih kosong</h2>
                <p class="mb-4">Jelajahi pilihan buah dan sayur segar kami.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-4 py-3 text-white">Lihat Produk</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col"><span class="visually-hidden">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('shop.show', $item['product']['id']) }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark">
                                        <img src="{{ asset('landing/img/'.$item['product']['image']) }}" class="rounded-circle" style="width: 72px; height: 72px; object-fit: cover;" alt="{{ $item['product']['name'] }}">
                                        <span>{{ $item['product']['name'] }}</span>
                                    </a>
                                </th>
                                <td>${{ number_format($item['product']['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item['product']['id']) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <label for="quantity-{{ $item['product']['id'] }}" class="visually-hidden">Jumlah {{ $item['product']['name'] }}</label>
                                        <input id="quantity-{{ $item['product']['id'] }}" type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="form-control" style="width: 90px;" required>
                                        <button type="submit" class="btn btn-outline-primary" aria-label="Perbarui jumlah {{ $item['product']['name'] }}"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                                <td>${{ number_format($item['total'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item['product']['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger rounded-circle" aria-label="Hapus {{ $item['product']['name'] }}"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end mt-4">
                <div class="col-sm-8 col-md-6 col-lg-5">
                    <div class="bg-light rounded p-4">
                        <h2 class="h4 mb-4">Ringkasan Belanja</h2>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <strong>${{ number_format($subtotal, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Ongkos kirim</span>
                            <strong>${{ number_format($shipping, 2) }}</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <strong>${{ number_format($subtotal + $shipping, 2) }}</strong>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-primary rounded-pill w-100 py-3 text-white">Lanjut ke Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
