@extends('services.layouts.index')

@section('container')
    <div class="px-3">
        <h2>Data Template Surat</h2>
        <hr class="divider rounded">
    </div>

    @if ($license_formats->isEmpty())
        <div class="p-3">
            <h3>Belum ada data template</h3>
        </div>
    @else
        <div class="list container-fluid mt-5 px-5">
            <table class="table table-bordered" id="licenseFormatTable">
                <thead>
                    <tr>
                        <td>Judul Format</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($license_formats as $ls)
                        <tr>
                            <td id="title-{{ $ls->id }}">{{ $ls->format_title }}</td>
                            <td>
                                <div class="dropdown">
                                    <img class="btn dropdown-toggle"data-toggle="dropdown"
                                        src="{{ asset('/assets/images/svg/gear.svg') }}">
                                    <span class="caret"></span></img>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('details_template', ['id' => $ls->id]) }}"
                                                class="dropdown-item">
                                                <img src="{{ asset('assets/images/svg/letter.svg') }}" class="mr-1">
                                                <span>Generate Template</span>
                                            </a>
                                        </li>
                                        <li onclick="editTemplateForm(event, '{{ $ls->id }}')"
                                            style="cursor: pointer !important;">
                                            <div class="dropdown-item">
                                                <img src="{{ asset('assets/images/svg/edit.svg') }}" class="mr-1">
                                                <span style="border: none; background: none; padding: 0; cursor: pointer;">
                                                    Edit Template
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <form onsubmit="submitTemplateForm(event)" class="ml-2" id="templateForm">
        @csrf
        <button type="submit" class="btn btn-sm btn-info mt-3 ml-auto d-flex">Tambah Template</button>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#licenseFormatTable').DataTable();
        });

        const editTemplateForm = (e, id) => {
            e.preventDefault();

            let format_title = $(`#title-${id}`).text();

            Swal.fire({
                title: 'Masukkan Judul Template',
                input: 'text',
                inputValue: format_title,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Submit',
                preConfirm: (title) => {
                    if (!title) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('update_template') }}",
                            type: "POST",
                            data: {
                                id: id,
                                title: title
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/admin/template';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseJSON.message,
                                    confirmButtonText: 'OK'
                                });
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        };

        const submitTemplateForm = (e) => {
            e.preventDefault();

            Swal.fire({
                title: 'Masukkan Judul Template',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Submit',
                preConfirm: (title) => {
                    if (!title) {
                        Swal.showValidationMessage(
                            'Field is required'
                        );
                    } else {
                        $.ajax({
                            url: "{{ route('store_template') }}",
                            type: "POST",
                            data: {
                                title: title
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/admin/template';
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'Error',
                                    title: 'Error!',
                                    text: xhr.responseJSON.message,
                                    confirmButtonText: 'OK'
                                });
                            },
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        };
    </script>
@endsection
