@extends('auth.layouts.index')

@section('title')
    Register
@endsection

@section('form')
    <form id="registerForm" onsubmit="submitRegisterForm(event)" class="card bg-light text-white" style="border-radius: 1rem;">
        @csrf
        <div class="card-body p-5">
            <div class="mb-md-4 mt-md-4 pb-5">
                <h2 class="fw-bold text-dark">Register</h2>
                <hr class="sidebar-divider mb-5">

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg" autofocus
                        required />
                    <span class="text-danger fst-italic fw-lighter error-text name_error"></span>

                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                    <span class="text-danger fst-italic fw-lighter error-text email_error"></span>
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label text-dark" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                </div>

                <div class="form-outline form-white mb-5">
                    <label class="form-label text-dark" for="confirmation_password">Konfirmasi Password</label>
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        class="form-control form-control-lg" required />
                    <span class="text-danger fst-italic fw-lighter error-text confirmation_password_error"></span>
                </div>

                <button type="submit" class="btn btn-outline-dark px-5 d-grid col-12 mx-auto">Register</button>

            </div>

            <div>
                <p class="text-dark text-center">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-dark-50 fw-bold">Masuk Sekarang</a>
                </p>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const submitRegisterForm = (e) => {
            e.preventDefault();

            let form = $('#registerForm')[0];
            let data = new FormData(form);

            $.ajax({
                url: "/register",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss....',
                            html: data.err,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $.each(data.errors, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        });
                    } else {
                        $('#registerForm')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Register Sukses!',
                            text: data.success,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/login';
                        });
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terdapat Kesalahan!',
                            text: 'Periksa Kembali Form Kamu!',
                        }).then(() => {
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
    </script>
@endsection
