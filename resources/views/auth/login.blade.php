@extends('auth.layouts.index')

@section('title')
    Login
@endsection

@section('form')
    <form id="loginForm" onsubmit="submitLoginForm(event)" class="card bg-light text-white" style="border-radius: 1rem">
        @csrf
        <div class="card-body p-5">
            <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold text-dark">Login</h2>
                <hr class="sidebar-divider mb-5">

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="email">Email</label>
                    <input name="email" type="email" id="email" class="form-control form-control-lg" autofocus
                        required />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="password">Password</label>
                    <input name="password" type="password" id="password" class="form-control form-control-lg" required />
                </div>

                <p class="small mb-5 pb-lg-2 text-left">
                    <a class="text-dark-50" href="#!">Forgot password?</a>
                </p>

                <button type="submit" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto">Login</button>

                <a href="#!" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto mt-3" type="submit">Login
                    Menggunakan SSO</a>
            </div>

            <div>
                <p class="mb-0 text-dark text-center">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-dark-50 fw-bold">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const submitLoginForm = (e) => {
            e.preventDefault();

            let form = $('#loginForm')[0];
            let data = new FormData(form);

            $.ajax({
                url: "/login",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error,
                            confirmButtonText: 'OK'
                        })
                    } else {
                        $('#loginForm')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Sukses!',
                            text: data.success,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            if (data.user == 1) {
                                window.location.href = '/admin/dashboard';
                            } else {
                                window.location.href = '/dashboard';
                            }
                        });
                    }
                },
            });
        }
    </script>
@endsection
