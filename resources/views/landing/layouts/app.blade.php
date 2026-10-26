<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('landing.layouts.head')
    </head>

    <body>

        {{-- Spinner, Navbar & Modal Search --}}
        @include('landing.layouts.header')

        {{-- Konten halaman --}}
        @if (session('status'))
            <div class="container pt-4">
                <div class="alert alert-success alert-dismissible fade show" role="status">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="container pt-4">
                <div class="alert alert-danger" role="alert">
                    <p class="fw-bold mb-2">Periksa kembali data yang Anda masukkan:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @yield('content')

        {{-- Footer, Copyright & Back to Top --}}
        @include('landing.layouts.footer')

        {{-- JavaScript --}}
        @include('landing.layouts.script')

        @stack('scripts')
    </body>

</html>