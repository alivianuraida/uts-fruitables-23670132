@extends('landing.layouts.app')

@section('title', 'Checkout - Fruitables')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Keranjang</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>

    <main class="container py-5">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-5">
                <section class="col-lg-7">
                    <h2 class="h3 mb-4">Informasi Pengiriman</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Nama depan</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control" autocomplete="given-name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Nama belakang</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control" autocomplete="family-name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor telepon</label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="form-control" autocomplete="tel" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat</label>
                            <input id="address" name="address" value="{{ old('address') }}" class="form-control" autocomplete="street-address" required>
                        </div>
                        <div class="col-md-8">
                            <label for="city" class="form-label">Kota</label>
                            <input id="city" name="city" value="{{ old('city') }}" class="form-control" autocomplete="address-level2" required>
                        </div>
                        <div class="col-md-4">
                            <label for="postcode" class="form-label">Kode pos</label>
                            <input id="postcode" name="postcode" value="{{ old('postcode') }}" class="form-control" autocomplete="postal-code" required>
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label">Catatan pesanan (opsional)</label>
                            <textarea id="notes" name="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="col-lg-5">
                    <div class="bg-light rounded p-4">
                        <h2 class="h3 mb-4">Pesanan Anda</h2>
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between gap-3 mb-3">
                                <span>{{ $item['product']['name'] }} × {{ $item['quantity'] }}</span>
                                <strong>${{ number_format($item['total'], 2) }}</strong>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <strong>${{ number_format($subtotal, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Ongkos kirim</span>
                            <strong>${{ number_format($shipping, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3 mb-4">
                            <span class="fw-bold">Total</span>
                            <strong>${{ number_format($subtotal + $shipping, 2) }}</strong>
                        </div>
                        <p class="small text-muted">Checkout ini merupakan demonstrasi dan belum memproses pembayaran.</p>
                        <button type="submit" class="btn btn-primary rounded-pill w-100 py-3 text-white">Konfirmasi Checkout</button>
                    </div>
                </section>
            </div>
        </form>
    </main>
@endsection
