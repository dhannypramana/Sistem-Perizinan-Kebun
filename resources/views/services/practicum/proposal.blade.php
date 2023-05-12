@extends('services.layouts.index')

@section('container')
    <h2 class="mb-4">Form Perizinan Praktikum</h2>
    <hr class="divider rounded">
    <form id="practicumForm" onsubmit="submitPracticumForm(event)">
        @csrf
        <div class="p-4">
            <div class="form-group">
                <label for="agency_license">Surat Pengantar Instansi<sup>*</sup></label>
                <input type="file" name="agency_license" class="form-control-file mt-1" id="agency_license">
                <span class="text-danger fst-italic fw-lighter error-text agency_license_error"></span>
            </div>

            <div id="form-container"></div>

            <button type="button" class="btn btn-sm btn-info mt-3 ml-auto d-flex" id="addSubject">Tambah Mata
                Kuliah</button>

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

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let formCount = 0;

            $('#addSubject').click(function() {
                var form = `
                <div class="border rounded p-4 mt-3" id="form-group-${formCount}">
                    <h3>Mata Kuliah #${formCount}</h3>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi Penelitian<sup>*</sup></label>
                                <select name="location${formCount}" id="location" class="form-control" required>
                                    <option value="" selected>Choose...</option>
                                    <option value="Kebun Raya">Kebun Raya</option>
                                    <option value="Arboretrum">Arboretrum</option>
                                    <option value="Hutan Serba Guna">Hutan Serba Guna</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="personnel">Jumlah Mahasiswa<sup>*</sup></label>
                                <input type="number" name="personnel${formCount}" class="form-control" id="personnel"
                                    placeholder="Jumlah Mahasiswa" required>
                                <span id="personnel_error" class="text-danger fst-italic fw-lighter error-text personnel${formCount}_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="practicum_supervisor">Dosen Penanggung Jawab Praktikum<sup>*</sup></label>
                                <input type="text" class="form-control" id="practicum_supervisor"
                                    name="practicum_supervisor${formCount}" placeholder="Dosen Penanggung Jawab Praktikum" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assistant">Nama Asisten<sup>*</sup></label>
                                <input type="text" class="form-control" id="assistant" name="assistant${formCount}1"
                                    placeholder="Nama Asisten" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject">Mata Kuliah<sup>*</sup></label>
                                <input type="text" class="form-control" id="subject" name="subject${formCount}1"
                                    placeholder="Nama Mata Kuliah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class_supervisor">Penanggung Jawab Kelas</label>
                                <input type="text" class="form-control" id="class_supervisor" name="class_supervisor${formCount}"
                                    placeholder="Nama Penanggung Jawab Kelas (Jika Ada)" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facility">Fasilitas yang Digunakan<sup>*</sup></label>
                                <input type="text" class="form-control" id="facility" name="facility${formCount}"
                                    placeholder="Fasilitas" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_time">Waktu Mulai<sup>*</sup></label>
                                    <input type="date" name="start_time${formCount}" class="form-control" id="start_time"
                                        placeholder="Waktu Pelaksanaan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_time">Waktu Berakhir<sup>*</sup></label>
                                    <input type="date" name="end_time${formCount}" class="form-control" id="end_time"
                                        placeholder="Waktu Pelaksanaan" required>
                                    <span id="end_time_error" class="text-danger fst-italic fw-lighter error-text end_time${formCount}_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input id="count" type="text" name="count" class="form-control" value="${formCount}" style="display:none;">

                    <button type="button" class="btn btn-sm btn-danger mt-3 ml-auto d-flex" onclick="deleteSubject(${formCount})">Hapus</button>
                </div>
            `;

                Swal.fire({
                    title: 'Tambah Mata Kuliah?',
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonColor: '#3085d6',
                    denyButtonColor: '#d33',
                    confirmButtonText: 'Yes, Tambah Sekarang!',
                    denyButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-container').append(form);
                        updateCount();

                        Swal.fire('Saved!', '', 'success')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });
            });
        });

        const deleteSubject = (formNumber) => {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                DenyButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus Sekarang!',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(formNumber);
                    $('#form-group-' + formNumber).remove();
                    updateCount()

                    Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        };

        const updateCount = () => {
            let formCount = 1;

            $('[id^="form-group-"]').each(function() {
                $(this).attr('id', 'form-group-' + formCount);
                $(this).find('h3').text(`Mata Kuliah #${formCount}`);
                $(this).find('#location').attr('name', `location${formCount}`);
                $(this).find('#personnel').attr('name', `personnel${formCount}`);
                $(this).find('#personnel_error').attr('class',
                    `text-danger fst-italic fw-lighter error-text personnel${formCount}_error`);
                $(this).find('#practicum_supervisor').attr('name', `practicum_supervisor${formCount}`);
                $(this).find('#assistant').attr('name', `assistant${formCount}`);
                $(this).find('#subject').attr('name', `subject${formCount}`);
                $(this).find('#class_supervisor').attr('name', `class_supervisor${formCount}`);
                $(this).find('#facility').attr('name', `facility${formCount}`);
                $(this).find('#start_time').attr('name', `start_time${formCount}`);
                $(this).find('#end_time').attr('name', `end_time${formCount}`);
                $(this).find('#end_time_error').attr('class',
                    `text-danger fst-italic fw-lighter error-text end_time${formCount}_error`);
                $(this).find('#count').attr('value', `${formCount}`);
                $(this).find('button').attr('onclick', 'deleteSubject(' + formCount + ')');
                formCount++;
            });
        };

        const submitPracticumForm = (e) => {
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
                    let form = $('#practicumForm')[0];
                    let data = new FormData(form);

                    $.ajax({
                        url: "/practicum",
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
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                if (data.err_type == 'no_subject') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terdapat Kesalahan!',
                                        text: data.errors,
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terdapat Kesalahan!',
                                        text: 'Periksa Kembali Form Kamu!',
                                    }).then(() => {
                                        $.each(data.errors, function(prefix, val) {
                                            $('span.' + prefix + '_error').text(val[
                                                0]);
                                        });
                                    });
                                }
                            } else {
                                $('#practicumForm')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/practicum/check';
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err.responseJSON.message);
                        }
                    });
                }
            });
        };
    </script>
@endsection
