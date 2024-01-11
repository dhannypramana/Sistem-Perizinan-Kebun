@extends('services.layouts.index')

@section('css')
    <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">
@endsection

@section('container')
    <div class="container">
        <div class="row mt-5 justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card mb-4">
                    <div class="card-header p-3 mb-4 text-center">
                        Profile
                    </div>

                    <div class="card-body">
                        <form id="profileForm" onsubmit="submitProfileForm(event)">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="name">Nama</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="form-control" placeholder="Masukkan Nama" required>
                                    <span class="text-danger fst-italic fw-lighter error-text name_error"></span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-lg-6">
                                    @if ($user->email_verified_at == null)
                                        <input type="text" name="email" id="email" value="{{ $user->email }}"
                                            class="form-control" required>
                                        <span class="text-danger fst-italic fw-lighter error-text email_error"></span>
                                    @else
                                        <input type="text" name="email" value="{{ $user->email }}"
                                            class="form-control read_only_input" placeholder="Masukkan Email">
                                        <span class="small text-success"><sup>*</sup>Email kamu sudah terverifikasi!</span>
                                    @endif
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="address">Alamat</label>
                                </div>
                                <div class="col-lg-6">
                                    <textarea rows="3" type="text" name="address" id="address" class="form-control "
                                        placeholder="Masukkan Alamat" required>{{ $user->address }}</textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="major">Fakultas</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="major" id="major" class="form-control"></select>
                                    <span class="text-danger fst-italic fw-lighter error-text major_error"></span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="academic_program">Program Studi</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="academic_program" id="academic_program" class="form-control"></select>
                                    <span
                                        class="text-danger fst-italic fw-lighter error-text academic_program_error"></span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="student_number">NIM</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" name="student_number" id="student_number"
                                        value="{{ $user->student_number }}" class="form-control" placeholder="Masukkan NIM"
                                        required>
                                    <span class="text-danger fst-italic fw-lighter error-text student_number_error"></span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="phone_number">Whatsapp</label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" name="phone_number" id="phone_number"
                                            value="{{ $user->phone_number }}" class="form-control"
                                            placeholder="Masukkan No Whatsapp" required>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <button class="btn btn-primary mt-2" type="submit">
                                Edit Profile
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $("#major").select2();
            $("#academic_program").select2();
            handleUserFaculty()
            handleUserAcademicProgram()
        })

        const handleUserFaculty = () => {
            const selectFaculty = $('#major')
            const url = "{{ route('getFaculties') }}"
            $.get(url).done(response => {
                $.each(response.data, (index, option) => {
                    const optionElement = $('<option></option')
                        .val(option.faculty)
                        .text(option.faculty)
                    if (option.faculty == '{{ $user->major }}') {
                        optionElement.attr('selected', 'selected');
                    }
                    selectFaculty.append(optionElement)
                })
            })
        }

        const handleUserAcademicProgram = (selectFaculty) => {
            const selectAcademicProgram = $('#academic_program')
            const url = "{{ route('getAcademicPrograms') }}"

            $.get(url).done(response => {
                $.each(response.data, (index, option) => {
                    const optionElement = $('<option></option')
                        .val(option.name)
                        .text(option.name)
                    if (option.name == '{{ $user->academic_program }}') {
                        optionElement.attr('selected', 'selected');
                    }
                    selectAcademicProgram.append(optionElement)
                })
            })
        }

        const submitProfileForm = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Pastikan Data Yang Kamu Masukkan Sudah Benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit Sekarang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('#profileForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "/profile/edit",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $(document).find('span.error-text').text('');
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Toast(
                                    'Periksa Kembali Form Kamu!',
                                    'error'
                                ).then(() => {
                                    $.each(data.errors, function(prefix, val) {
                                        $('span.' + prefix + '_error').text(val[0]);
                                    });
                                });
                            } else {
                                $('#profileForm')[0].reset();

                                Toast(
                                    data.success
                                ).then(() => {
                                    window.location.href = '/profile';
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
                                        'users_email_unique') {
                                        $('.email_error').text(data.responseJSON.errors)
                                    } else if (data.responseJSON.unique_field[2] ==
                                        'users_student_number_unique') {
                                        $('.student_number_error').text(data.responseJSON
                                            .errors)
                                    } else if (data.responseJSON.unique_field[2] ==
                                        'users_name_unique') {
                                        $('.name_error').text(data.responseJSON.errors)
                                    }
                                });
                            }
                        }
                    });
                }
            })
        };
    </script>
@endsection
