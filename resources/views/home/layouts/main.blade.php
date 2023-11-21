<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href={{ asset('/assets/css/bootstrap5/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('/assets/css/index.css') }}>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>Sisperlak - Landing Page</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center border border-light rounded shadow px-3" href="/">
                <img src="{{ asset('assets/images/itera.png') }}" alt="itera-nav" style="width: 30px; height: 35px;">
                <span class="ms-3">SISPERLAK</span>
            </a>
            {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if ($active == 'news') active @endif"
                        href="{{ route('newsHome') }}">News</a>
                </li>
            </ul> --}}
            <div id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div class="text-white">
                                @if (auth()->user()->photo)
                                    <img class="img-profile rounded-circle" style="width: 20px"
                                        src="{{ asset('storage/image/' . auth()->user()->photo) }}">
                                @else
                                    <img class="img-profile rounded-circle" style="width: 20px"
                                        src="{{ asset('assets/images/no-profile.jpeg') }}">
                                @endif
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->name }}
                                </span>
                            </div>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    @yield('container')
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>

    @include('sweetalert::alert')
</body>

</html>
