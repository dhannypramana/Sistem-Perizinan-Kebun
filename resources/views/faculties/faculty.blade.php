@extends('services.layouts.index')

@section('container')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2>Manajemen Fakultas</h2>
            <hr class="divider rounded">
        </div>
        <form onsubmit="handleSubmitFaculty(event)" class="ml-2">
            @csrf
            <button type="submit" class="btn">
                <img src="{{ asset('assets/images/svg/plus.svg') }}" alt="Plus" style="width: 50px; height: 50px">
            </button>
        </form>
    </div>

    <table id="faculty_table" class="table table-responsive-lg table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->faculty }}</td>
                    <td>
                        <div class="dropdown">
                            <img class="btn dropdown-toggle"data-toggle="dropdown"
                                src="{{ asset('/assets/images/svg/gear.svg') }}">
                            <span class="caret"></span></img>
                            <ul class="dropdown-menu">
                                <li onclick="handleEditFaculty('{{ $faculty }}')" style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Edit fakultas</span>
                                    </div>
                                </li>
                                <li onclick="handleDeleteFaculty('{{ $faculty->id }}')" style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Delete fakultas</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-5 mb-3">
        <div>
            <h2>Manajemen Prodi</h2>
            <hr class="divider rounded">
        </div>
        <form onsubmit="handleSubmitAcademicProgram(event)" class="ml-2">
            @csrf
            <button type="submit" class="btn">
                <img src="{{ asset('assets/images/svg/plus.svg') }}" alt="Plus" style="width: 50px; height: 50px">
            </button>
        </form>
    </div>
    <table id="academicProgram_table" class="table table-responsive-lg table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($academic_programs as $ap)
                <tr>
                    <td>{{ $ap->name }}</td>
                    <td>{{ $ap->faculty->faculty }}</td>
                    <td>
                        <div class="dropdown">
                            <img class="btn dropdown-toggle"data-toggle="dropdown"
                                src="{{ asset('/assets/images/svg/gear.svg') }}">
                            <span class="caret"></span></img>
                            <ul class="dropdown-menu">
                                <li onclick="handleEditAcademicProgram('{{ $ap }}')"
                                    style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Edit Program Studi</span>
                                    </div>
                                </li>
                                <li onclick="handleDeleteAcademicProgram('{{ $ap->id }}')"
                                    style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Delete Program Studi</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#faculty_table').DataTable()
            $('#academicProgram_table').dataTable()
        })

        const handleDeleteAcademicProgram = (academicProgramID) => {
            Confirm(
                'Hapus Program Studi?',
                'Aksi tidak dapat dikembalikan!'
            ).then(() => {
                $.ajax({
                    url: "{{ route('deleteAcademicProgram') }}",
                    type: "DELETE",
                    data: {
                        id: academicProgramID
                    },
                    success: function(res) {
                        if (res.status) {
                            return Toast(res.message, 'error');
                        }

                        Toast(
                            res.message,
                        ).then(() => {
                            window.location.reload();
                        });
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
            })
        }

        const handleEditAcademicProgram = (data) => {
            const APObject = JSON.parse(data)

            Swal.fire({
                title: 'Edit Program Studi',
                width: '800px',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                html: `
                    <div class="form-group text-left">
                        <label for="name" class="form-label">Name</label>
                        <select class="form-control" name="select-faculty" id="select-faculty">
                        </select>
                    </div>
                    <div class="form-group text-left">
                        <label for="academic_program" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" id="academic_program" value="${APObject.name}" />
                    </div>
                `,
                didOpen: () => {
                    let selectFaculty = $('#select-faculty')
                    const url = "{{ route('getFaculties') }}"

                    $.get(url).done(response => {
                        $.each(response.data, (index, option) => {
                            const optionElement = $('<option></option')
                                .val(option.id)
                                .text(option.faculty)
                            if (option.id === APObject.faculty_id) {
                                optionElement.attr('selected', 'selected');
                            }
                            selectFaculty.append(optionElement)
                        })
                    })
                },
                preConfirm: () => {
                    const facultyID = $('#select-faculty option:selected').val()
                    const academicProgram = $('#academic_program').val()

                    if (!facultyID || !academicProgram) {
                        return Swal.showValidationMessage('Field is Required')
                    }

                    return {
                        facultyID,
                        academicProgram,
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const {
                        academicProgram,
                        facultyID,
                        academicProgramID
                    } = result.value;

                    $.ajax({
                        url: "{{ route('editAcademicProgram') }}",
                        type: "PUT",
                        data: {
                            academicProgram,
                            facultyID,
                            academicProgramID: APObject.id
                        },
                        success: function(res) {
                            Toast(
                                res.message
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(e) {
                            Toast(
                                e.responseJSON.errors,
                                'error'
                            );
                        }
                    });
                }
            });
        }

        const handleSubmitAcademicProgram = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Tambah Program Studi',
                width: '800px',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                html: `
                    <div class="form-group text-left">
                        <label for="name" class="form-label">Name</label>
                        <select class="form-control" name="select-faculty" id="select-faculty">
                        </select>
                    </div>
                    <div class="form-group text-left">
                        <label for="academic_program" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" id="academic_program" />
                    </div>
                `,
                didOpen: () => {
                    let selectFaculty = $('#select-faculty')
                    const url = "{{ route('getFaculties') }}"

                    $.get(url).done(response => {
                        $.each(response.data, (index, option) => {
                            const optionElement = $('<option></option')
                                .val(option.id)
                                .text(option.faculty)
                            selectFaculty.append(optionElement)
                        })
                    })
                },
                preConfirm: () => {
                    const facultyID = $('#select-faculty option:selected').val()
                    const academicProgram = $('#academic_program').val()

                    if (!facultyID || !academicProgram) {
                        return Swal.showValidationMessage('Field is Required')
                    }

                    return {
                        facultyID,
                        academicProgram
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const {
                        facultyID,
                        academicProgram
                    } = result.value;

                    $.ajax({
                        url: "{{ route('addAcademicProgram') }}",
                        type: "POST",
                        data: {
                            facultyID,
                            academicProgram
                        },
                        success: function(res) {
                            Toast(
                                res.message
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(e) {
                            Toast(
                                e.responseJSON.errors,
                                'error'
                            );
                        }
                    });
                }
            });
        }

        const handleSubmitFaculty = (e) => {
            e.preventDefault()

            Swal.fire({
                title: 'Masukkan Nama Fakultas',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Submit',
                preConfirm: (name) => {
                    if (!name) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('addFaculty') }}",
                            type: "POST",
                            data: {
                                name,
                            },
                            success: function(res) {
                                Toast(
                                    res.message
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                return Toast(
                                    xhr.responseJSON.message,
                                    'error'
                                )
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        const handleEditFaculty = (data) => {
            const faculty = JSON.parse(data)

            Swal.fire({
                title: 'Edit Fakultas',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                inputValue: faculty.faculty,
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Submit',
                preConfirm: (name) => {
                    if (!name) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('editFaculty') }}",
                            type: "PUT",
                            data: {
                                id: faculty.id,
                                name,
                            },
                            success: function(res) {
                                Toast(
                                    res.message
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                return Toast(
                                    xhr.responseJSON.message,
                                    'error'
                                )
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        const handleDeleteFaculty = (id) => {
            Confirm(
                'Hapus Fakultas?',
                'Aksi tidak dapat dikembalikan!'
            ).then(() => {
                $.ajax({
                    url: "{{ route('deleteFaculty') }}",
                    type: "DELETE",
                    data: {
                        id
                    },
                    success: function(res) {
                        if (res.status) {
                            return Toast(res.message, 'error');
                        }

                        Toast(
                            res.message,
                        ).then(() => {
                            window.location.reload();
                        });
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
            })
        }
    </script>
@endsection
