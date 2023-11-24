@extends('services.layouts.index')

@section('title')
    Managemen Pelaporan
@endsection

@section('container')
    <div class="form-group">
        <input type="checkbox" name="useDate" id="useDate">
        <label for="useDate">Range Tanggal</label>
    </div>
    <div class="form-group row d-none" id="tanggalContainer">
        <div class="col" id="dari_tanggal_input">
            <label for="start_date" class="form-label">Dari tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>
        <div class="col" id="sampai_tanggal_input">
            <label for="end_date" class="form-label">Sampai tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col" id="fakultas_input">
                <label for="faculty" class="form-label">Fakultas</label>
                <select name="faculty" id="faculty" class="form-control">
                    <option value="all_faculty" selected>Semua Fakultas</option>
                </select>
            </div>
            <div class="col" id="prodi_input">
                <label for="academic_program" class="form-label">Prodi</label>
                <select name="academic_program" id="academic_program" class="form-control">
                    <option value="all_academic_program" selected>Semua Prodi</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="service" class="form-label">Layanan</label>
        <select name="service" id="service" class="form-control" required>
            <option disabled selected>Pilih Layanan</option>
            <option value="penelitian">Penelitian</option>
            <option value="permintaanData">Permintaan Data</option>
            <option value="peminjaman">Peminjaman Sarana dan Prasarana</option>
            <option value="praktikum">Praktikum</option>
        </select>
    </div>
    {{-- Penelitian --}}
    <div class="form-group d-none" id="research">
        <label for="researchLocation" class="form-label">Lokasi Penelitian</label>
        <select name="researchLocation" id="researchLocation" class="form-control">
            <option value="all_location" selected>Semua Lokasi</option>
        </select>
    </div>
    {{-- Peminjaman --}}
    <div class="form-group d-none" id="loan">
        <label for="loanCategory" class="form-label">Kategori Peminjaman</label>
        <select name="loanCategory" id="loanCategory" class="form-control">
            <option value="all_category" selected>Semua Kategori</option>
            <option value="Ruangan">Ruangan</option>
            <option value="Alat">Alat</option>
            <option value="Lain-Lain">Lain-Lain</option>
        </select>
    </div>
    {{-- Praktikum --}}
    <div class="form-group d-none" id="practicum">
        <label for="practicumLocation" class="form-label">Lokasi Praktikum</label>
        <select name="practicumLocation" id="practicumLocation" class="form-control">
            <option value="all_location_practicum">Semua Lokasi</option>
        </select>
    </div>
    <div class="flex" id="button-group">
        <button onclick="handleSubmitFilter()" class="btn btn-primary">Filter Laporan</button>
    </div>

    <div id="dataContainer" class="mt-5"></div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            handleServiceChange()
            handleFacultyChange()
            handleAcademicProgramChange()

            $('#useDate').on('change', () => {
                if ($('#useDate').is(':checked')) {
                    $('#tanggalContainer').removeClass('d-none')
                } else {
                    $('#tanggalContainer').addClass('d-none')
                    $('#start_date').val('')
                    $('#end_date').val('')
                }
            })

            $('#dari_tanggal').on('change', () => {
                if ($('#dari_tanggal').is(':checked')) {
                    $('#dari_tanggal_input').removeClass('d-none')
                } else {
                    $('#dari_tanggal_input').addClass('d-none')
                    $('#start_date').val('')
                }
            })

            $('#sampai_tanggal').on('change', () => {
                if ($('#sampai_tanggal').is(':checked')) {
                    $('#sampai_tanggal_input').removeClass('d-none')
                } else {
                    $('#sampai_tanggal_input').addClass('d-none')
                    $('#end_date').val('')
                }
            })

            $('#fakultas').on('change', () => {
                if ($('#fakultas').is(':checked')) {
                    $('#fakultas_input').removeClass('d-none')
                } else {
                    $('#fakultas_input').addClass('d-none')
                    $('#faculty').val('')
                }
            })

            $('#prodi').on('change', () => {
                if ($('#prodi').is(':checked')) {
                    $('#prodi_input').removeClass('d-none')
                } else {
                    $('#prodi_input').addClass('d-none')
                    $('#academic_program').val('')
                }
            })
        })

        const handleSubmitFilter = () => {
            let start_date = $('#start_date').val()
            let end_date = $('#end_date').val()
            const faculty = $('#faculty').val()
            const academic_program = $('#academic_program').val()

            const service = $('#service').val()
            const researchLocation = $('#researchLocation').val()
            const loanCategory = $('#loanCategory').val()
            const practicumLocation = $('#practicumLocation').val()

            start_date = `${start_date}T00:00`
            end_date = `${end_date}T23:59`

            if ($('#useDate').is(':checked')) {
                if (start_date === 'T00:00' || end_date === 'T23:59') {
                    return Toast(
                        'Masukkan range tanggal',
                        'error'
                    )
                }
            }

            if (!service) {
                return Toast(
                    'Masukkan layanan yang ingin di filter',
                    'error'
                )
            }

            $.ajax({
                url: "{{ route('getFilters') }}",
                type: "GET",
                enctype: 'multipart/form-data',
                data: {
                    start_date,
                    end_date,
                    faculty,
                    academic_program,
                    service,
                    researchLocation,
                    loanCategory,
                    practicumLocation,
                    useDate: $('#useDate').is(':checked')
                },
                dataType: 'json',
                success: function(res) {
                    $('#buttonUnduh').remove()
                    let serviceID = ''

                    switch (service) {
                        case 'penelitian':
                            generateResearchTable(res.data)
                            serviceID = 'research'
                            break;
                        case 'permintaanData':
                            generateDataRequestTable(res.data)
                            serviceID = 'dataRequest'
                            break;
                        case 'peminjaman':
                            generateLoanTable(res.data)
                            serviceID = 'loan'
                            break;
                        case 'praktikum':
                            generatePracticumTable(res.data)
                            serviceID = 'practicum'
                            break;
                        default:
                            break;
                    }

                    const button =
                        `<button class="btn btn-info" onclick="unduhLaporan('${serviceID}')" id="buttonUnduh">Unduh Laporan</button`
                    $('#button-group').append(button)
                },
                error: function(e) {
                    Toast(
                        e.responseJSON.message,
                        'error'
                    ).then(() => {
                        window.location.reload();
                    });
                }
            });
        }

        const unduhLaporan = (serviceID) => {
            const wb = XLSX.utils.table_to_book(document.getElementById(`${serviceID}Report`), {
                sheet: 'Report'
            });
            XLSX.writeFile(wb, 'report.xlsx');
        }

        const generatePracticumTable = (data) => {
            const practicumTable = `
                <table class="table table-responsive-lg table-bordered table-hover overflow-auto" id="practicumReport">
                    <thead>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>Lokasi Praktikum</td>
                            <td>Jumlah Mahasiswa</td>
                            <td>Penanggung Jawab Praktikum</td>
                            <td>Asisten</td>
                            <td>Mata Kuliah</td>
                            <td>Penanggung Jawab Kelas</td>
                            <td>Fasilitas</td>
                            <td>Jadwal Praktikum</td>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map(v => `<tr><td>${formatDate(v.created_at)}</td> <td>${v.location}</td> <td>${v.personnel}</td> <td>${v.practicum_supervisor}</td> <td>${v.assistant}</td> <td>${v.subject}</td> <td>${v.class_supervisor}</td> <td>${v.facility}</td> <td>${v.start_date} sampai ${v.end_date}<br>${v.start_time} sampai ${v.end_time}</td></tr>`).join('')}
                    </tbody>
                </table>`

            if (data.length < 1) {
                const noData = `<p class="text-center">Tidak ada data</p>`
                $('#dataContainer').html(noData)
            } else {
                $('#dataContainer').html(practicumTable)
            }
        }

        const generateLoanTable = (data) => {
            const loanTable = `
                <table class="table table-responsive-lg table-bordered table-hover overflow-auto" id="loanReport">
                    <thead>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>Nama</td>
                            <td>NIM</td>
                            <td>Fakultas</td>
                            <td>Prodi</td>

                            <td>Kategori</td>
                            <td>Sarana</td>
                            <td>Jumlah</td>
                            <td>Nama Kegiatan</td>
                            <td>Tujuan Pemakaian</td>
                            <td>Waktu Peminjaman</td>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map(v => `<tr><td>${formatDate(v.created_at)}</td> <td>${v.user.name}</td> <td>${v.user.student_number}</td> <td>${v.user.major}</td> <td>${v.user.academic_program}</td> <td>${v.category}</td> <td>${v.title}</td> <td>${v.quantity}</td> <td>${v.activity}</td> <td>${v.purpose}</td> <td>${v.start_time} sampai ${v.end_time}</td></tr>`).join('')}
                    </tbody>
                </table>`

            if (data.length < 1) {
                const noData = `<p class="text-center">Tidak ada data</p>`
                $('#dataContainer').html(noData)
            } else {
                $('#dataContainer').html(loanTable)
            }
        }

        const generateResearchTable = (data) => {
            const researchTable = `
                <table class="table table-responsive-lg table-bordered table-hover overflow-auto" id="researchReport">
                    <thead>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>Nama</td>
                            <td>NIM</td>
                            <td>Fakultas</td>
                            <td>Prodi</td>

                            <td>Lokasi Penelitian</td>
                            <td>Jumlah Personil</td>
                            <td>Judul Penelitian</td>
                            <td>Waktu Penelitian</td>
                            <td>Fasilitas</td>
                            <td>Dosen Pembimbing Penelitian</td>
                            <td>Dosen Pembimbing Akademik</td>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map(v => `<tr><td>${formatDate(v.created_at)}</td> <td>${v.user.name}</td> <td>${v.user.student_number}</td> <td>${v.user.major}</td> <td>${v.user.academic_program}</td> <td>${v.location}</td> <td>${v.personnel}</td> <td>${v.title}</td> <td>${v.start_time} - ${v.end_time}</td> <td>${v.facility}</td> <td>${v.research_supervisor}</td> <td>${v.academic_supervisor}</td>  </tr>`).join('')}
                    </tbody>
                </table>`

            if (data.length < 1) {
                const noData = `<p class="text-center">Tidak ada data</p>`
                $('#dataContainer').html(noData)
            } else {
                $('#dataContainer').html(researchTable)
            }
        }

        const generateDataRequestTable = (data) => {
            const dataRequestTable = `
                <table class="table table-responsive-lg table-bordered table-hover overflow-auto" id="dataRequestReport">
                    <thead>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>Nama</td>
                            <td>NIM</td>
                            <td>Fakultas</td>
                            <td>Prodi</td>

                            <td>Kategori Data</td>
                            <td>Data</td>
                            <td>Keperluan Data</td>
                            <td>Asal Instansi</td>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map(v => `<tr><td>${formatDate(v.created_at)}</td> <td>${v.user.name}</td> <td>${v.user.student_number}</td> <td>${v.user.major}</td> <td>${v.user.academic_program}</td> <td>${v.category}</td> <td>${v.title}</td> <td>${v.purpose}</td> <td>${v.agency}</td> </tr>`).join('')}
                    </tbody>
                </table>`

            if (data.length < 1) {
                const noData = `<p class="text-center">Tidak ada data</p>`
                $('#dataContainer').html(noData)
            } else {
                $('#dataContainer').html(dataRequestTable)
            }
        }

        const handleFacultyChange = () => {
            const selectFaculty = $('#faculty')
            const url = "{{ route('getFaculties') }}"
            $.get(url).done(response => {
                $.each(response.data, (index, option) => {
                    const optionElement = $('<option></option')
                        .val(option.faculty)
                        .text(option.faculty)
                    selectFaculty.append(optionElement)
                })
            })
        }

        const handleAcademicProgramChange = (selectFaculty) => {
            const selectAcademicProgram = $('#academic_program')
            const url = "{{ route('getAcademicPrograms') }}"

            $.get(url).done(response => {
                $.each(response.data, (index, option) => {
                    const optionElement = $('<option></option')
                        .val(option.name)
                        .text(option.name)
                    selectAcademicProgram.append(optionElement)
                })
            })
        }

        const handleServiceChange = () => {
            const service = $('#service')
            const url = "{{ route('getLocation') }}"

            service.on('change', () => {
                $('#research').addClass('d-none')
                $('#loan').addClass('d-none')
                $('#practicum').addClass('d-none')

                switch (service.val()) {
                    case 'penelitian':
                        $('#research').removeClass('d-none')

                        const selectResearchLocation = $('#researchLocation')
                        selectResearchLocation.empty()
                        const all_research_location_option =
                            `<option value="all_location" selected>Semua Lokasi Penelitian</option`
                        selectResearchLocation.append(all_research_location_option)

                        $.get(url).done(response => {
                            $.each(response.locations, (index, option) => {
                                const optionElement = $('<option></option>')
                                    .val(option.name)
                                    .text(option.name)
                                selectResearchLocation.append(optionElement)
                            })
                        })
                        break;
                    case 'permintaanData':
                        break;
                    case 'peminjaman':
                        $('#loan').removeClass('d-none')
                        break;
                    case 'praktikum':
                        $('#practicum').removeClass('d-none')

                        const selectPracticumLocation = $('#practicumLocation')
                        selectPracticumLocation.empty()
                        const all_practicum_location_option =
                            `<option value="all_location_practicum" selected>Semua Lokasi Praktikum</option`
                        selectPracticumLocation.append(all_practicum_location_option)

                        $.get(url).done(response => {
                            $.each(response.locations, (index, option) => {
                                const optionElement = $('<option></option>')
                                    .val(option.name)
                                    .text(option.name)
                                selectPracticumLocation.append(optionElement)
                            })
                        })
                        break;

                    default:
                        break;
                }
            })
        }
    </script>
@endsection
