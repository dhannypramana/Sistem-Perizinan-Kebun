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
                    <span class="text-danger fst-italic fw-lighter error-text email_error"></span>
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="password">Password</label>
                    <input name="password" type="password" id="password" class="form-control form-control-lg" required />
                </div>

                {{-- <p class="small mb-5 pb-lg-2 text-left">
                    <a class="text-dark-50" style="cursor: pointer" onclick="handleForgotPassword()">Forgot password?</a>
                </p> --}}

                <button type="submit" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto mt-5">Login</button>

                {{-- <div onclick="handleLoginSSO()" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto mt-3">
                    Login
                    Menggunakan SSO</div> --}}
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
                    $(document).find('span.error-text').text('');
                    onLoading();
                },
                success: function(data) {
                    if (data.status == 1) {
                        Toast(
                            data.err,
                            'error'
                        ).then(() => {
                            $.each(data.errors, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        });
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
                error: function(data) {
                    if (data.status == 422) {
                        Toast(
                            'Periksa Kembali Form Kamu!',
                            'error'
                        ).then(() => {
                            if (data.responseJSON.unique_field[2] ==
                                'users_name_unique') {
                                $('.name_error').text(data.responseJSON.errors)
                            } else if (data.responseJSON.unique_field[2] ==
                                'users_email_unique') {
                                $('.email_error').text(data.responseJSON.errors)
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
