@extends('services.layouts.index')

@section('container')
    <h2>Data Hasil Pemeriksaan</h2>

    <button type="button" class="btn btn-sm btn-info my-3 ml-auto d-flex" onclick="addFormat(event, 0)">Tambah Format</button>

    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
            $count = 1;
        @endphp
        @foreach ($formats as $format)
            <tr>
                <td>{{ $count++ }}</td>
                <td id="formatTitle">{{ $format->format_title }}</td>
                <td>
                    <div class="dropdown">
                        <img class="btn dropdown-toggle"data-toggle="dropdown"
                            src="{{ asset('/assets/images/svg/gear.svg') }}">
                        <span class="caret"></span></img>
                        <ul class="dropdown-menu">
                            <button type="button" class="dropdown-item" onclick="addFormat(event, '{{ $format->id }}')">
                                <img src="{{ asset('assets/images/svg/edit.svg') }}" class="mr-1">
                                <span>Edit</span>
                            </button>
                            @csrf
                            <button type="button" class="dropdown-item"
                                onclick="deleteFormat(event, '{{ $format->id }}')">
                                <img src="{{ asset('assets/images/svg/delete.svg') }}" class="mr-1">
                                <span>Delete</span>
                            </button>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('script')
    <script>
        const deleteFormat = (e, id) => {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Hapus Sekarang!',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete_format') }}",
                        type: "POST",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.success,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "{{ route('template') }}";
                            });
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                }
            });
        };

        const addFormat = (e, id) => {
            e.preventDefault();

            let title = '';
            let url = '';
            let oldFormatTitle = '';

            if (id) {
                title = 'Ubah Nama Format';
                url = '{{ route('update_format') }}';
                oldFormatTitle = $('#formatTitle').text();
            } else {
                title = 'Tambah Format';
                url = '{{ route('create_format') }}';
            }

            Swal.fire({
                title: title,
                input: 'text',
                inputValue: oldFormatTitle,
                inputAttributes: {
                    autocapitalize: 'off',
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Simpan',
                preConfirm: (format_title) => {
                    if (format_title.trim() === '') {
                        Swal.showValidationMessage('Field tidak boleh kosong');
                        return false;
                    }

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            id: id,
                            format_title: format_title
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "{{ route('template') }}";
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: xhr.responseJSON.message,
                                confirmButtonText: 'OK'
                            });
                        },
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        };
    </script>
@endsection
