<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Perizinan Kebun Raya ITERA</title>

    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="block_logo">
                <a class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="{{ route('user_dashboard') }}">
                    <div class="sidebar-brand-text mx-3">
                        <img class="nav_img" src="{{ asset('assets/images/itera.png') }}" alt="logo_itera">
                    </div>
                </a>
            </div>

            <div class="dashboard">
                <li class="nav-item @if ($active == 'dashboard') active @endif">
                    <a class="nav-link" href="{{ route('user_dashboard') }}">
                        <img src="{{ asset('assets/images/svg/undraw_dashboard.svg') }}">
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
            </div>

            <div class="layanan_penelitian">
                <p class="text-white text-bold mx-3 my-2">Penelitian</p>
                <hr class="sidebar-divider">

                @if (auth()->user()->is_admin == 0)
                    <li class="nav-item
                    @if ($active == 'research_proposal') active @endif">
                        <a class="nav-link" href="{{ route('research_proposal') }}">
                            <img src="{{ asset('assets/images/svg/undraw_research.svg') }}">
                            <span class="ml-2">Ajuan Penelitian</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item @if ($active == 'research_check') active @endif">
                    @if (auth()->user()->is_admin == 1)
                        <a class="nav-link" href="{{ route('admin_research_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_research.svg') }}">
                            <span class="ml-2">Cek Penelitian</span>
                        </a>
                    @else
                        <a class="nav-link" href="{{ route('research_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_research.svg') }}">
                            <span class="ml-2">Cek Penelitian</span>
                        </a>
                    @endif
                </li>
            </div>

            <div class="layanan_permintaan_data">
                <p class="nav-item text-white text-bold mx-3 my-2">Permintaan Data</p>
                <hr class="sidebar-divider">

                @if (auth()->user()->is_admin == 0)
                    <li class="nav-item @if ($active == 'data_request_proposal') active @endif">
                        <a class="nav-link" href="{{ route('data_request_proposal') }}">
                            <img src="{{ asset('assets/images/svg/undraw_data.svg') }}">
                            <span class="ml-2">Ajuan Data</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item @if ($active == 'data_request_check') active @endif">
                    @if (auth()->user()->is_admin == 1)
                        <a class="nav-link" href="{{ route('admin_data_request_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_data.svg') }}">
                            <span class="ml-2">Cek Ajuan Data</span>
                        </a>
                    @else
                        <a class="nav-link" href="{{ route('data_request_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_data.svg') }}">
                            <span class="ml-2">Cek Ajuan Data</span>
                        </a>
                    @endif
                </li>
            </div>

            <div class="layanan_Peminjaman">
                <p class="nav-item text-white text-bold mx-3 my-2">Peminjaman</p>
                <hr class="sidebar-divider">

                @if (auth()->user()->is_admin == 0)
                    <li class="nav-item @if ($active == 'loan_proposal') active @endif">
                        <a class="nav-link" href={{ route('loan_proposal') }}>
                            <img src="{{ asset('assets/images/svg/undraw_loan.svg') }}">
                            <span class="ml-2">Ajuan Peminjaman</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item @if ($active == 'loan_check') active @endif">
                    @if (auth()->user()->is_admin == 1)
                        <a class="nav-link" href={{ route('admin_loan_check') }}>
                            <img src="{{ asset('assets/images/svg/undraw_loan.svg') }}">
                            <span class="ml-2">Cek Ajuan Peminjaman</span>
                        </a>
                    @else
                        <a class="nav-link" href={{ route('loan_check') }}>
                            <img src="{{ asset('assets/images/svg/undraw_loan.svg') }}">
                            <span class="ml-2">Cek Ajuan Peminjaman</span>
                        </a>
                    @endif
                </li>
            </div>

            <div class="layanan_praktikum">
                <p class="nav-item text-white text-bold mx-3 my-2">Praktikum</p>
                <hr class="sidebar-divider">

                @if (auth()->user()->is_admin == 0)
                    <li class="nav-item @if ($active == 'practicum_proposal') active @endif">
                        <a class="nav-link" href="{{ route('practicum_proposal') }}">
                            <img src="{{ asset('assets/images/svg/undraw_practicum.svg') }}">
                            <span class="ml-1">Ajuan Praktikum</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item @if ($active == 'practicum_check') active @endif">
                    @if (auth()->user()->is_admin == 1)
                        <a class="nav-link" href="{{ route('admin_practicum_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_practicum.svg') }}">
                            <span class="ml-1">Cek Ajuan Praktikum</span>
                        </a>
                    @else
                        <a class="nav-link" href="{{ route('practicum_check') }}">
                            <img src="{{ asset('assets/images/svg/undraw_practicum.svg') }}">
                            <span class="ml-1">Cek Ajuan Praktikum</span>
                        </a>
                    @endif
                </li>
            </div>

            @if (auth()->user()->is_admin == 1)
                <div class="license_generator">
                    <p class="nav-item text-white text-bold mx-3 my-2">Surat</p>
                    <hr class="sidebar-divider">

                    <li class="nav-item @if ($active == 'template') active @endif">
                        <a class="nav-link" href="{{ route('template') }}">
                            <img src="{{ asset('assets/images/svg/letter.svg') }}">
                            <span class="ml-1">Buat Template Surat</span>
                        </a>
                    </li>
                </div>
            @endif
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->name }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/images/svg/undraw_profile.svg') }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <img src="{{ asset('assets/images/svg/undraw_account.svg') }}" class="mr-1">
                                    <span>Account</span>
                                </a>
                                <form onsubmit="submitLogoutForm(event)">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <img src="{{ asset('assets/images/svg/undraw_logout.svg') }}" class="mr-1">
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>
                    @yield('container')
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kebun Raya ITERA | Sistem Perizinan Layanan 2023</span>
                    </div>
                    <div class="copyright text-center mt-1">
                        <span>Contact Person: 0813 2799 9679 (WhatsApp)</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>


    @include('sweetalert::alert')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const submitLogoutForm = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Kamu tidak akan dapat mengembalikannya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar sekarang'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/logout",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Logout',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/';
                            });
                        },
                        error: function(err) {
                            console.log(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: err,
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                }
            })
        };
    </script>

    @yield('script')
</body>

</html>
