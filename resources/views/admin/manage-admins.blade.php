@extends('services.layouts.index')

@section('container')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2>Manajemen Admin</h2>
            <hr class="divider rounded">
        </div>
        <form onsubmit="submitAdmin(event)" class="ml-2" id="adminForm">
            @csrf
            <button type="submit" class="btn">
                <img src="{{ asset('assets/images/svg/plus.svg') }}" alt="Plus" style="width: 50px; height: 50px">
            </button>
        </form>
    </div>

    <table id="admins_table" class="table table-responsive-lg table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td class="text-capitalize">{{ $admin->role }}</td>
                    <td>
                        <div class="dropdown">
                            <img class="btn dropdown-toggle"data-toggle="dropdown"
                                src="{{ asset('/assets/images/svg/gear.svg') }}">
                            <span class="caret"></span></img>
                            <ul class="dropdown-menu">
                                <li onclick="handleEditAdmin('{{ $admin }}')" style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Edit Admin</span>
                                    </div>
                                </li>
                                <li onclick="handleDeleteAdmin('{{ $admin->id }}')" style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Delete Admin</span>
                                    </div>
                                </li>
                                <li onclick="handleChangePassword('{{ $admin->id }}')"
                                    style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Change Password</span>
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
            $('#admins_table').DataTable();
        });

        const handleChangePassword = (id) => {
            Swal.fire({
                title: 'Masukkan Password Baru',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Submit',
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('changePassword') }}",
                            type: "POST",
                            data: {
                                id,
                                password
                            },
                            success: function(response) {
                                Toast(
                                    response.message
                                ).then(() => {
                                    window.location.reload()
                                });
                            },
                            error: function(xhr) {
                                Toast(
                                    xhr.responseJSON.message,
                                    'error'
                                ).then(() => {
                                    window.location.reload()
                                });
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        const handleEditAdmin = (data) => {
            const admin = JSON.parse(data);

            Swal.fire({
                title: 'Edit Admin',
                width: '800px',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                html: `
                    <div class="form-group text-left">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" value="${admin.name}" />
                    </div>
                    <div class="form-group text-left">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="${admin.email}" disabled />
                    </div>
                    <div class="form-group text-left">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="superadmin" ${admin.role === 'superadmin' && 'selected'}>Super Admin</option>
                        </select>
                    </div>
                `,
                preConfirm: () => {
                    const name = $('#name').val()
                    const email = $('#email').val()
                    const role = $('#role').val()
                    const id = admin.id

                    if (
                        name == '' ||
                        email == '' ||
                        role == ''
                    ) {
                        return Swal.showValidationMessage('Field is Required')
                    }

                    return {
                        name,
                        email,
                        role,
                        id
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const {
                        name,
                        email,
                        role,
                        id
                    } = result.value;

                    $.ajax({
                        url: "{{ route('editAdmin') }}",
                        type: "PUT",
                        data: {
                            name,
                            email,
                            role,
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
                            console.log(e.responseJSON.message);
                        }
                    });
                }
            });
        }

        const handleDeleteAdmin = (id) => {
            Confirm(
                'Hapus Admin?',
                'Aksi tidak dapat dikembalikan!'
            ).then(res => {
                $.ajax({
                    url: "{{ route('deleteAdmin') }}",
                    type: "DELETE",
                    data: {
                        id
                    },
                    success: function(res) {
                        if (res.status) {
                            return Toast(res.message, 'error');
                        }

                        Toast(
                            res.message
                        ).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(e) {
                        Toast(
                            e.responseJSON.message,
                            'error'
                        );
                    }
                });
            });
        }

        const submitAdmin = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Tambah Admin',
                width: '800px',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                html: `
                    <div class="form-group text-left">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" />
                    </div>
                    <div class="form-group text-left">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" />
                    </div>
                    <div class="form-group text-left">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" />
                    </div>
                    <div class="form-group text-left">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>
                `,
                preConfirm: () => {
                    const name = $('#name').val()
                    const email = $('#email').val()
                    const password = $('#password').val()
                    const role = $('#role').val()

                    if (!name || !email || !password || !role) {
                        return Swal.showValidationMessage('Field is Required')
                    }

                    return {
                        name,
                        email,
                        password,
                        role
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const {
                        name,
                        email,
                        password,
                        role
                    } = result.value;

                    $.ajax({
                        url: "{{ route('createAdmin') }}",
                        type: "POST",
                        data: {
                            name,
                            email,
                            password,
                            role
                        },
                        success: function(res) {
                            if (res.status) {
                                return Toast(
                                    res.errors.email[0],
                                    'error'
                                );
                            }

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
    </script>
@endsection
