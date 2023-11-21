<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - Sistem Perizinan Kebun Raya ITERA</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="vh-100 gradient-custom">
        @yield('nav')
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="mb-4" src="{{ asset('assets/images/itera.png') }}" alt="logo itera"
                            width="75">
                    </div>
                    @yield('form')
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>

    @yield('script')
</body>

</html>
