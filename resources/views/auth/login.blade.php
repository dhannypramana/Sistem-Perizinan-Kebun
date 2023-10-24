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
                    <a class="text-dark-50" style="cursor: pointer" onclick="handleForgotPassword()">Forgot password?</a>
                </p>

                <button type="submit" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto">Login</button>

                <div onclick="handleLoginSSO()" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto mt-3">
                    Login
                    Menggunakan SSO</div>
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
                beforeSend: function() {
                    onLoading();
                },
                success: function(data) {
                    if (data.status == 1) {
                        Toast(
                            data.error,
                            'error'
                        )
                    } else {
                        $('#loginForm')[0].reset();
                        Toast(
                            data.success
                        ).then(() => {
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

        const handleLoginSSO = () => {
            Toast(
                'Login SSO!'
            )
        }

        const handleForgotPassword = () => {
            Toast(
                'Forget Password'
            )
        }
    </script>
@endsection
