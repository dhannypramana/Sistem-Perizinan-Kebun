@extends('home.layouts.main')

@section('container')
    <section class="jumbotron text-center">
        <div class="row justify-content-center">
            <h1 class="display-4 text-primary fw-bold">Sistem Perizinan <br> Layanan Kebun Raya ITERA</h1>
            <p class="lead col-md-4 mt-3">Yuk Ajukan dan Cek Proposal Peizinan yang Kamu Miliki di Kebun Raya ITERA!</p>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                @if (auth()->user())
                    <a class="btn btn-primary btn-lg p-3" style="margin-bottom: 100px" href="{{ route('user_dashboard') }}"
                        role="button">Dashboard</a>
                @else
                    <a class="btn btn-primary btn-lg p-3" style="margin-bottom: 100px" href="/register"
                        role="button">Daftar Sekarang </a>
                @endif
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0d6efd" fill-opacity="1"
                d="M0,32L40,26.7C80,21,160,11,240,37.3C320,64,400,128,480,160C560,192,640,192,720,176C800,160,880,128,960,112C1040,96,1120,96,1200,106.7C1280,117,1360,139,1400,149.3L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
            </path>
        </svg>
    </section>

    <section id="about">
        <div class="container">
            <div class="row text-center text-white mb-3">
                <div class="col">
                    <h2 class="fw-bold text-uppercase">About SISPERLAK</h2>
                </div>
            </div>
            <div class="row text-white justify-content-center mt-4">
                <div class="col-md-5 mb-3">
                    <div class="icon" style="text-align: center">
                        <i class="fa-solid fa-newspaper fa-6x"></i>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                            illum consequatur expedita error porro et dolorum nisi voluptate architecto autem! Dolore quae
                            voluptatum odit eius incidunt, qui voluptate consequatur. Doloribus?</p>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <div class="icon" style="text-align: center">
                        <i class="fa-solid fa-circle-check fa-6x"></i>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                            illum consequatur expedita error porro et dolorum nisi voluptate architecto autem! Dolore quae
                            voluptatum odit eius incidunt, qui voluptate consequatur. Doloribus?</p>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <div class="icon" style="text-align: center">
                        <i class="fa-solid fa-newspaper fa-6x"></i>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                            illum consequatur expedita error porro et dolorum nisi voluptate architecto autem! Dolore quae
                            voluptatum odit eius incidunt, qui voluptate consequatur. Doloribus?</p>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <div class="icon" style="text-align: center">
                        <i class="fa-solid fa-newspaper fa-6x"></i>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                            illum consequatur expedita error porro et dolorum nisi voluptate architecto autem! Dolore quae
                            voluptatum odit eius incidunt, qui voluptate consequatur. Doloribus?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="lapor" class="pt-5">
        <div class="container mt-5">
            <div class="row text-center text-white mb-3">
                <div class="col">
                    <h2>Ingin Mengajukan Perizinan?</h2>
                    <h2>Ajukan Disini</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <a type="submit" class="btn btn-light fw-bold text-primary p-3 w-25"
                    href="{{ route('user_dashboard') }}">Dashboard</a>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,192C960,203,1056,181,1152,160C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <footer class="pb-3">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-md-4">
                    <img src="https://diskominfotik.lampungprov.go.id/uploads/photos/1/logo.png" style="width: 200px"
                        alt="">
                    <img src="{{ asset('assets/images/itera.png') }}" alt="ITERA" style="width: 75px">
                    <h5 style="text-align: left" class="mt-3">Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Et quasi
                        voluptate quibusdam, nam tempore totam veniam accusamus officia. Veniam, culpa!</h5>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="contact-info">
                        <h2>Contacs</h2>
                        <h5 class="text-primary">Kebun Raya ITERA</h5>
                        <div class="d-flex justify-content-between w-25 mx-auto">
                            <a href="#" class="text-decoration-none" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="text-decoration-none" target="_blank">
                                <i class="bi bi-envelope-fill"></i>
                            </a>
                            <a href="#" class="text-decoration-none" target="_blank">
                                <i class="bi bi-globe"></i>
                            </a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5 class="text-primary">ITERA</h5>
                        <div class="d-flex justify-content-between w-25 mx-auto">
                            <a href="https://www.instagram.com/iteraofficial" class="text-decoration-none" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="mailto:pusat@itera.ac.id/" class="text-decoration-none" target="_blank">
                                <i class="bi bi-envelope-fill"></i>
                            </a>
                            <a href="https://itera.ac.id/" class="text-decoration-none" target="_blank">
                                <i class="bi bi-globe"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-3 text-center fw-bold mt-5">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Kebun Raya ITERA | Sistem Perizinan Layanan 2023</span>
                </div>
                <div class="copyright text-center mt-1">
                    <span>Contact Person: 0813 2799 9679 (WhatsApp)</span>
                </div>
            </div>
        </div>
        </div>
    </footer>
@endsection
