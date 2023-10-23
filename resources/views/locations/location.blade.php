@extends('services.layouts.index')

@section('container')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2>Manajemen Lokasi</h2>
            <hr class="divider rounded">
        </div>
        <div onclick="handleAddLocation()" class="ml-2" id="locationForm">
            @csrf
            <button type="submit" class="btn">
                <img src="{{ asset('assets/images/svg/plus.svg') }}" alt="Plus" style="width: 50px; height: 50px">
            </button>
        </div>
    </div>

    <table id="locations_table" class="table table-responsive-lg table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>
                        <div class="dropdown">
                            <img class="btn dropdown-toggle"data-toggle="dropdown"
                                src="{{ asset('/assets/images/svg/gear.svg') }}">
                            <span class="caret"></span></img>
                            <ul class="dropdown-menu">
                                <li onclick="handleEditlocation('{{ $location }}')" style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Edit location</span>
                                    </div>
                                </li>
                                <li onclick="handleDeletelocation('{{ $location->id }}')"
                                    style="cursor: pointer !important">
                                    <div class="dropdown-item">
                                        <span>Delete location</span>
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
            $('#locations_table').DataTable();
        });

        const handleAddLocation = () => {
            Swal.fire({
                title: 'Masukkan Nama Lokasi',
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
                            url: "{{ route('addLocation') }}",
                            type: "POST",
                            data: {
                                name,
                            },
                            success: function(res) {
                                return DialogBox(
                                    'Sukses!',
                                    res.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                return DialogBox(
                                    'Error!',
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

        const handleDeletelocation = (id) => {
            Confirm(
                'Hapus Lokasi?',
                'Aksi tidak dapat dikembalikan!'
            ).then(res => {
                $.ajax({
                    url: "{{ route('deleteLocation') }}",
                    type: "DELETE",
                    data: {
                        id
                    },
                    success: function(res) {
                        if (res.status) {
                            return Toast(res.message, 'error');
                        }

                        DialogBox(
                            'Sukses!',
                            res.message,
                        ).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(e) {
                        console.log(e.responseJSON.message);
                    }
                });
            });
        }

        const handleEditlocation = (data) => {
            const location = JSON.parse(data);

            Swal.fire({
                title: 'Update Nama Lokasi',
                input: 'text',
                inputValue: location.name,
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
                            url: "{{ route('updateLocation') }}",
                            type: "PUT",
                            data: {
                                id: location.id,
                                name,
                            },
                            success: function(res) {
                                return DialogBox(
                                    'Sukses!',
                                    res.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                return DialogBox(
                                    'Error!',
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
    </script>
@endsection
