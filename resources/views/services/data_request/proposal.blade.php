@extends('services.layouts.index')

@section('css')
    <link href="{{ asset('assets/css/research/proposal.css') }}" rel="stylesheet">
@endsection

@section('container')
    <h2 class="mb-4">Form Perizinan Permintaan Data</h2>
    <hr class="divider rounded">
    <form id="dataRequestForm" onsubmit="submitDataRequestForm(event)">
        @csrf
        <div class="row p-4 my-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input value="{{ $user->name }}"class="form-control" disabled>
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
                    <label>Jurusan / Fakultas</label>
                    <input value="{{ $user->major }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>NIM</label>
                    <input value="{{ $user->student_number }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input value="{{ $user->phone_number }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kategori">Kategori Data<sup>*</sup></label>
                    <input type="text" name="category" id="category" placeholder="Kategori Data" class="form-control"
                        required>
                    <small class="form-text text-muted">example: Tanaman</small>
                </div>
                <div class="form-group">
                    <label class="d-flex align-items-center" for="title">Data yang Diajukan<sup>*</sup></label>
                    <input type="text" name="title" class="form-control" id="title"
                        placeholder="Data yang Diajukan" required>
                    <small class="form-text text-muted ml-2">example: Data Persebaran Kacang Kacangan</small>
                </div>
                <div class="form-group">
                    <label for="purpose">Keperluan Data <sup>*</sup></label>
                    <input type="text" name="purpose" class="form-control" id="purpose"
                        placeholder="Keperluan Data Tersebut" required>
                    <small class="form-text text-muted">example: Penelitian</small>
                </div>
                <div class="form-group">
                    <label for="agency">Asal Instansi<sup>*</sup></label>
                    <input type="text" name="agency" class="form-control" id="agency" placeholder="Asal Instansi"
                        required>
                    <small class="form-text text-muted">example: Institut Teknologi Sumatera</small>
                </div>
                <div class="form-group">
                    <label for="agency_license">Surat Pengantar Instansi<sup>*</sup></label>
                    <input type="file" name="agency_license" class="form-control-file mt-1" id="agency_license" required>
                    <span class="text-danger fst-italic fw-lighter error-text agency_license_error"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mt-4 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="fixedCheck" required>
                        <label class="form-check-label" for="fixedCheck">
                            Data yang saya masukkan sudah benar
                        </label>
                    </div>
                </div>
                <div class="form-group mt-2 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="fixedCheck" required>
                        <label class="form-check-label" for="fixedCheck">
                            Saya bersedia menggunakan data sesuai dengan kebutuhan dan tidak menyebarluaskan data tanpa
                            seizin
                            UPA Konservasi Flora Sumatera
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
        const submitDataRequestForm = (e) => {
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
                    let form = $('#dataRequestForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "/data",
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
                                Toast(
                                    'Periksa Kembali Form Kamu!',
                                    'error'
                                ).then(() => {
                                    $.each(data.errors, function(prefix, val) {
                                        $('span.' + prefix + '_error').text(val[0]);
                                    });
                                });
                            } else {
                                $('#dataRequestForm')[0].reset();

                                Toast(
                                    data.success
                                ).then(() => {
                                    window.location.href = '/data/check';
                                });
                            }
                        },
                        error: function(data) {
                            Toast(
                                data.responseJSON.message,
                                'error'
                            );
                        }
                    });
                }
            })
        };
    </script>
@endsection
