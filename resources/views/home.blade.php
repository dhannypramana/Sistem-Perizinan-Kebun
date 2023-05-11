<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Perizinan Layanan Kebun Raya ITERA</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>

<body>
    <section class="vh-100 border bg-gray">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <div class="card rounded-3">
                    <div class="row">
                        <div class="col-lg-6 my-5">
                            <div class="card-body p-md-5 mx-md-4 my-5">
                                <div class="d-grid">
                                    <img src="{{ asset('assets/images/itera.png') }}" alt="logo_itera" width="75">
                                </div>
                                <h1 class="mt-5">Sistem Perizinan Layanan Kebun Raya ITERA</h1>
                                <p class="mt-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis
                                    mollitia
                                    impedit
                                    voluptate, reiciendis, ut deleniti culpa magni quod ipsa nulla ipsum
                                    expedita?
                                    Vitae tempore qui deserunt. A doloremque reiciendis quas?</p>
                                @guest
                                    <div class="pt-4">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                    </div>
                                @else
                                    <p>Welcome Back, {{ auth()->user()->name }}</p>
                                    <div class="pt-5">
                                        <a href="{{ route('user_dashboard') }}" class="btn btn-primary">Dashboard</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                        <div class="col-lg-6 p-0">
                            <img src="{{ asset('assets/images/kebun.jpeg') }}" alt="Kebun Raya ITERA" class="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
