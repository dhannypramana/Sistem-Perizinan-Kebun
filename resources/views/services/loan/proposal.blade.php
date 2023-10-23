@extends('services.layouts.index')

@section('container')
    <h2 class="mb-4">Form Perizinan Peminjaman Sarana Prasarana</h2>
    <hr class="divider rounded">
    <form id="loanForm" onsubmit="submitLoanForm(event)">
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
                    <input value="{{ $user->student_number }}" type="text" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>No. Telfon</label>
                    <input value="{{ $user->phone_number }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="category">Kategori<sup>*</sup></label>
                        <select name="category" id="category" class="form-control" onchange="yesnoCheck(this);" required>
                            <option selected>Choose...</option>
                            <option value="Ruangan">Ruangan</option>
                            <option value="Alat">Alat</option>
                            <option value="other">Lain-Lain</option>
                        </select>
                        <small class="form-text text-muted">example: Alat</small>
                    </div>

                    <div class="form-group col-md-6" id="ifYes" style="display: none">
                        <label for="other_category">Kategori Lain<sup>*</sup></label>
                        <input type="text" name="other_category" class="form-control" id="other_category"
                            placeholder="Masukkan Kategori">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Sarana<sup>*</sup></label>
                        <input type="text" name="title" class="form-control" id="title"
                            placeholder="Sarana Yang Dipinjam" required>
                        <small class="form-text text-muted">example: Paranet Persemayan</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="quantity">Jumlah<sup>*</sup></label>
                        <input type="number" name="quantity" class="form-control" id="quantity"
                            placeholder="Jumlah Peminjaman" required>
                        <span class="text-danger fst-italic fw-lighter error-text quantity_error"></span>
                        <small class="form-text text-muted">example: 1</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="activity">Nama Kegiatan<sup>*</sup></label>
                    <input type="text" name="activity" class="form-control" id="activity" placeholder="Nama Kegiatan"
                        required>
                    <small class="form-text text-muted">example: Penelitian</small>
                </div>
                <div class="form-group">
                    <label for="purpose">Tujuan Pemakaian<sup>*</sup></label>
                    <input type="text" name="purpose" class="form-control" id="purpose" placeholder="Tujuan Pemakaian"
                        required>
                    <small class="form-text text-muted">example: Menguji Sample</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_time">Waktu Mulai<sup>*</sup></label>
                        <input type="date" name="start_time" class="form-control" id="start_time"
                            placeholder="Waktu Pelaksanaan" required>
                        <small class="form-text text-muted">example: 23/10/2023</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_time">Waktu Berakhir<sup>*</sup></label>
                        <input type="date" name="end_time" class="form-control" id="end_time"
                            placeholder="Waktu Pelaksanaan" required>
                        <small class="form-text text-muted">example: 25/11/2023</small>
                        <span class="text-danger fst-italic fw-lighter error-text end_time_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="agency_license">Surat Pengantar Instansi<sup>*</sup></label>
                    <input type="file" name="agency_license" class="form-control-file mt-1" id="agency_license"
                        required>
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
                        <input class="form-check-input" type="checkbox" id="returningCheck" required>
                        <label class="form-check-label" for="returningCheck">
                            Saya bersedia mengembalikan alat yang telah saya pinjam sesuai dengan kondisi semula
                        </label>
                    </div>
                </div>
                <div class="form-group mt-2 mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changeCheck" required>
                        <label class="form-check-label" for="changeCheck">
                            Saya bersedia mengganti barang yang hilang atau rusak
                        </label>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rescheduleCheck" required>
                        <label class="form-check-label" for="rescheduleCheck">
                            Saya bersedia melakukan perubahan jadwal maksimal H-1 Minggu jika terdapat perubahan tanggal
                            pada
                            waktu peminjaman saya
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
        const submitLoanForm = (e) => {
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
                    let form = $('#loanForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "/loan",
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
                                $('#loanForm')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/loan/check';
                                });
                            }
                        },
                    });
                }
            })
        };

        const yesnoCheck = (that) => {
            if (that.value == "other") {
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>
@endsection
