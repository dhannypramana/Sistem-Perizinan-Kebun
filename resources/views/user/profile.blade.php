@extends('services.layouts.index')

@section('title')
    {{-- Profile --}}
@endsection

@section('css')
    <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">
@endsection

@section('container')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="profile-picture" id="changeProfile">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="image-container">
                                            @if ($user->photo == null)
                                                <img src="{{ asset('assets/images/no-profile.jpeg') }}" alt="Gambar Profil"
                                                    class="image rounded-circle img-fluid" />
                                            @else
                                                <img src="{{ asset('storage/image/' . $user->photo) }}" alt="Gambar Profil"
                                                    class="image rounded-circle img-fluid" />
                                            @endif
                                            <div class="hint-box rounded-circle">
                                                <span class="hint-text">Change your avatar</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu mt-5" aria-labelledby="dropdownMenuLink">
                                        <button class="dropdown-item" id="uploadPhoto">Upload a Photo</button>
                                        <button class="dropdown-item" id="removePhoto">Remove Photo</button>
                                    </div>
                                </div>
                            </div>
                            <h5 class="my-3">{{ $user->name }}</h5>
                            <p class="text-muted mb-1">{{ $user->major }}</p>
                            <p class="text-muted mb-1">{{ $user->academic_program }}</p>
                            <p class="text-muted mb-4">{{ $user->student_number }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('edit_profile') }}" class="btn btn-outline-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Role</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ \App\Helpers\Helpers::isStudent($user->email) ? 'Mahasiswa' : 'Dosen' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Fakultas</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->major == null)
                                        <p class="text-danger mb-0">Belum ada Jurusan</p>
                                    @else
                                        <p class="text-muted mb-0">{{ $user->major }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Prodi</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->academic_program == null)
                                        <p class="text-danger mb-0">Belum ada Prodi</p>
                                    @else
                                        <p class="text-muted mb-0">{{ $user->academic_program }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ \App\Helpers\Helpers::isStudent($user->email) ? 'NIM' : 'NIP' }}</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->student_number == null)
                                        <p class="text-danger mb-0">Belum ada NIM</p>
                                    @else
                                        <p class="text-muted mb-0">{{ $user->student_number }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Whatsapp</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->phone_number == null)
                                        <p class="text-danger mb-0">Belum ada Nomor Telefon</p>
                                    @else
                                        <p class="text-muted mb-0">{{ $user->phone_number }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->address == null)
                                        <p class="text-danger mb-0">Belum ada Alamat</p>
                                    @else
                                        <p class="text-muted mb-0">{{ $user->address }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project
                                        Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%"
                                            aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%"
                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%"
                                            aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%"
                                            aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project
                                        Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%"
                                            aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%"
                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%"
                                            aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%"
                                            aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#removePhoto').click(removePhoto);
            $('#uploadPhoto').click(uploadPhoto);
        });

        const uploadPhoto = async () => {
            let files = null;

            let input = document.createElement('input');
            input.type = 'file';
            input.onchange = _ => {
                files = Array.from(input.files);

                const data = new FormData();
                data.append('file', files[0]);

                $.ajax({
                    url: "{{ route('change_photo') }}",
                    type: 'POST',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status == 1) {
                            Swal.fire({
                                title: "Error!",
                                text: data.err,
                                icon: 'error',
                            });
                        } else {
                            Swal.fire({
                                title: "Success!",
                                text: data.success,
                                icon: 'success',
                            }).then(() => {
                                window.location.href = '/profile';
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan saat mengunggah file');
                    }
                });

            };
            input.click();
        };

        const removePhoto = () => {
            let user_id = '{{ auth()->user()->id }}';

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
                        url: "{{ route('delete_user_photo') }}",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: {
                            user_id: user_id,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            onLoading();
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.err,
                                    icon: 'error',
                                });
                            } else {
                                Swal.fire({
                                    title: "Success!",
                                    text: data.success,
                                    icon: 'success',
                                }).then(() => {
                                    window.location.href = '/profile';
                                });
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        };
    </script>
@endsection
