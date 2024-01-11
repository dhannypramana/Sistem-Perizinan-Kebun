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
        let formCount = 1;

        $(document).ready(function() {
            $('#addSubject').click(function() {
                var form = `
                <div class="border rounded p-4 mt-3" id="form-group-${formCount}">
                    <h3>Mata Kuliah #${formCount}</h3>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi Penelitian<sup>*</sup></label>
                                <select name="location${formCount}" id="location" class="form-control" required>
                                </select>
                                <small class="form-text text-muted">example: Kebun Raya</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="personnel">Jumlah Mahasiswa<sup>*</sup></label>
                                <input type="number" name="personnel${formCount}" class="form-control" id="personnel"
                                    placeholder="Jumlah Mahasiswa" required>
                                <small class="form-text text-muted">example: 12</small>
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
                                <small class="form-text text-muted">example: Andre Febrianto, S.Kom., M.Eng.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assistant">Nama Asisten<sup>*</sup></label>
                                <input type="text" class="form-control" id="assistant" name="assistant${formCount}1"
                                    placeholder="Nama Asisten" required>
                                <small class="form-text text-muted">example: Ahmad Agung</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject">Mata Kuliah<sup>*</sup></label>
                                <input type="text" class="form-control" id="subject" name="subject${formCount}1"
                                    placeholder="Nama Mata Kuliah" required>
                                <small class="form-text text-muted">example: Biologi Dasar</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class_supervisor">Penanggung Jawab Kelas</label>
                                <input type="text" class="form-control" id="class_supervisor" name="class_supervisor${formCount}"
                                    placeholder="Nama Penanggung Jawab Kelas (Jika Ada)" required>
                                <small class="form-text text-muted">example: Agung Muhammad</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facility">Fasilitas yang Digunakan<sup>*</sup></label>
                                <input type="text" class="form-control" id="facility" name="facility${formCount}"
                                    placeholder="Fasilitas" required>
                                <small class="form-text text-muted">example: Rumah Kaca</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_time">Waktu Mulai<sup>*</sup></label>
                                    <input type="time" name="start_time${formCount}" class="form-control" id="start_time"
                                        placeholder="Waktu Pelaksanaan" required>
                                    <small class="form-text text-muted">example: 14:00</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_time">Waktu Berakhir<sup>*</sup></label>
                                    <input type="time" name="end_time${formCount}" class="form-control" id="end_time"
                                        placeholder="Waktu Pelaksanaan" required>
                                    <small class="form-text text-muted">example: 15:30</small>
                                    <span id="end_time_error" class="text-danger fst-italic fw-lighter error-text end_time${formCount}_error"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Tanggal Mulai<sup>*</sup></label>
                                    <input type="date" name="start_date${formCount}" class="form-control" id="start_date"
                                        placeholder="Tanggal Mulai" required>
                                    <small class="form-text text-muted">example: 25/12/2023</small>
                                    <span id="date_error" class="text-danger fst-italic fw-lighter error-text start_date${formCount}_error"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Tanggal Berakhir</label>
                                    <input type="date" name="end_date${formCount}" class="form-control" id="end_date"
                                        placeholder="Tanggal Berakhir">
                                    <small class="form-text text-muted text-small">Kosongkan jika pelaksanaan praktikum hanya 1x</small>
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
                        const locationElement = $('#location');

                        $.ajax({
                            url: "{{ route('getLocation') }}",
                            type: 'GET',
                            dataType: 'json',
                            success: function(res) {
                                $.each(res.locations, (index, option) => {
                                    const optionElement = $('<option></option>')
                                        .val(option.name)
                                        .text(option.name);

                                    locationElement.append(optionElement);
                                })
                            },
                            error: function(err) {
                                return Toast(
                                    err,
                                    'error'
                                );
                            }
                        });

                        formCount = $('[id^="form-group-"]').length + 1;
                        updateCount();
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

                    Toast(
                        'Berhasil Menghapus'
                    );
                } else if (result.isDenied) {
                    Toast(
                        'Perubahan Tidak Disimpan',
                        'info'
                    );
                }
            });
        };

        const updateCount = () => {
            $('[id^="form-group-"]').each(function(index) {
                $(this).attr('id', 'form-group-' + (index + 1));
                $(this).find('h3').text(`Mata Kuliah #${index+1}`);
                $(this).find('#location').attr('name', `location${index+1}`);
                $(this).find('#location').attr('id', `location${index+1}`);
                $(this).find('#personnel').attr('name', `personnel${index+1}`);
                $(this).find('#personnel_error').attr('class',
                    `text-danger fst-italic fw-lighter error-text personnel${index+1}_error`);
                $(this).find('#practicum_supervisor').attr('name', `practicum_supervisor${index+1}`);
                $(this).find('#assistant').attr('name', `assistant${index+1}`);
                $(this).find('#subject').attr('name', `subject${index+1}`);
                $(this).find('#class_supervisor').attr('name', `class_supervisor${index+1}`);
                $(this).find('#facility').attr('name', `facility${index+1}`);
                $(this).find('#start_time').attr('name', `start_time${index+1}`);
                $(this).find('#end_time').attr('name', `end_time${index+1}`);
                $(this).find('#end_time_error').attr('class',
                    `text-danger fst-italic fw-lighter error-text end_time${index+1}_error`);
                $(this).find('#count').attr('value', `${index+1}`);
                $(this).find('button').attr('onclick', 'deleteSubject(' + (index + 1) + ')');
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
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                if (data.err_type == 'no_subject') {
                                    Toast(
                                        data.errors,
                                        'error'
                                    );
                                } else {
                                    Toast(
                                        'Periksa Kembali Form Kamu!',
                                        'error'
                                    ).then(() => {
                                        console.log(data.errors)
                                        $.each(data.errors, function(prefix, val) {
                                            $('span.' + prefix + '_error').text(val[
                                                0]);
                                        });
                                    });
                                }
                            } else {
                                $('#practicumForm')[0].reset();

                                Toast(
                                    data.success
                                ).then(() => {
                                    window.location.href = '/practicum/check';
                                });
                            }
                        },
                        error: function(err) {
                            Toast(
                                err.responseJSON.message,
                                'error'
                            );
                        }
                    });
                }
            });
        };
    </script>
@endsection
