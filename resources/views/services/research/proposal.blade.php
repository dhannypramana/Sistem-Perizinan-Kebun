@extends('services.layouts.index')

@section('css')
    <link href="{{ asset('assets/css/research/proposal.css') }}" rel="stylesheet">
@endsection

@section('container')
    <h2 class="mb-4">Form Ajuan Penelitian</h2>
    <hr class="divider rounded">

    <form id="researchForm" onsubmit="submitResearchForm(event)">
        @csrf
        <div class="row p-4 my-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input value="{{ $user->name }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input value="{{ $user->address }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Prodi</label>
                    <input value="{{ $user->academic_program }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>NIM</label>
                    <input value="{{ $user->student_number }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>No. Telfon</label>
                    <input value="{{ $user->phone_number }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location">Lokasi Penelitian<sup>*</sup></label>
                    <select name="location" id="location" class="form-control" required>
                        <option value="" selected>Choose...</option>
                        <option value="Kebun Raya">Kebun Raya</option>
                        <option value="Arboretrum">Arboretrum</option>
                        <option value="Hutan Serba Guna">Hutan Serba Guna</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="personnel">Jumlah Personil<sup>*</sup></label>
                    <input type="number" name="personnel" class="form-control" id="personnel" placeholder="Jumlah Personil"
                        required>
                    <span class="text-danger fst-italic fw-lighter error-text personnel_error"></span>
                </div>

                <div class="form-group">
                    <label for="title">Judul Penelitian<sup>*</sup></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Judul Penelitian"
                        required>
                    <span class="text-danger fst-italic fw-lighter error-text title_error"></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_time">Waktu Mulai<sup>*</sup></label>
                        <input type="date" name="start_time" class="form-control" id="start_time" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_time">Waktu Berakhir<sup>*</sup></label>
                        <input type="date" name="end_time" class="form-control" id="end_time" required>
                        <span class="text-danger fst-italic fw-lighter error-text end_time_error"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="facility">Fasilitas Yang Digunakan<sup>*</sup></label>
                    <input type="text" name="facility" class="form-control" id="facility"
                        placeholder="Fasilitas yang Digunakan" required>
                </div>

                <div class="form-group">
                    <label for="research_supervisor">Nama Dosen Pembimbing Penelitian<sup>*</sup></label>
                    <input type="text" name="research_supervisor" class="form-control" id="research_supervisor"
                        placeholder="Nama Dosen Pembimbing Penelitian" required>
                </div>

                <div class="form-group">
                    <label for="academic_supervisor">Nama Dosen Pembimbing Akademik<sup>*</sup></label>
                    <input type="text" name="academic_supervisor" class="form-control" id="academic_supervisor"
                        placeholder="Nama Dosen Pembimbing Akademik" required>
                </div>

                <div class="form-group">
                    <label for="agency_license">Surat Pengantar Instansi<sup>*</sup></label>
                    <input type="file" name="agency_license" class="form-control-file mt-1" id="agency_license" required>
                </div>
                <span class="text-danger fst-italic fw-lighter error-text agency_license_error"></span>
            </div>

            {{-- <div id="loading-spinner"></div> --}}

            <div class="col-md-12">
                <div class="form-group mt-5 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="fixedCheck" required>
                        <label class="form-check-label" for="fixedCheck">
                            Data yang saya masukkan sudah benar
                        </label>
                    </div>
                </div>

                <div class="form-group mt-2 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="uploadCheck" required>
                        <label class="form-check-label" for="uploadCheck">
                            Saya bersedia mengunggah hasil penelitian saya ke website ini jika penelitian telah selesai
                            dilaksanakan
                        </label>
                    </div>
                </div>

                <div class="form-group mt-2 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cleaningCheck" required>
                        <label class="form-check-label" for="cleaningCheck">
                            Saya bersedia membersihkan kembali area penelitian yang telah saya gunakan
                        </label>
                    </div>
                </div>

                <div class="form-group mt-2 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="returningCheck" required>
                        <label class="form-check-label" for="returningCheck">
                            Saya bersedia mengembalikan alat yang telah saya pinjam sesuai dengan kondisi semula
                        </label>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rescheduleCheck" required>
                        <label class="form-check-label" for="rescheduleCheck">
                            Saya bersedia melakukan perubahan jadwal maksimal H-2 Minggu jika terdapat perubahan tanggal
                            pada
                            waktu penelitian saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const submitResearchForm = (e) => {
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
                    let form = $('#researchForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "/research",
                        type: "POST",
                        enctype: 'multipart/form-data',
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
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terdapat Kesalahan!',
                                    text: 'Periksa Kembali Form Kamu!',
                                }).then(() => {
                                    $.each(data.errors, function(prefix, val) {
                                        $('span.' + prefix + '_error').text(val[0]);
                                    });
                                });
                            } else {
                                $('#researchForm')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/research/check';
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err.responseJSON.message);
                        },
                    });
                }
            })
        };
    </script>
@endsection
