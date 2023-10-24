@extends('services.layouts.index')

@section('container')
    <div class="px-3 d-flex justify-content-between">
        <div>
            <h2>Manajemen Berita</h2>
        </div>
        <button class="btn" id="createNews">
            <img src="{{ asset('assets/images/svg/plus.svg') }}" alt="plus" style="width: 50px; height: 50px">
        </button>
    </div>
    @if ($news->isNotEmpty())
        <div class="container-fluid mt-3">
            <table class="table table-responsive-lg table-bordered table-hover" id="newsTable">
                <thead>
                    <tr>
                        <th>Judul Berita</th>
                        <th>Tanggal Berita</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $n)
                        <tr>
                            <td>
                                <a href="{{ route('details_news', ['id' => $n->id]) }}">{{ $n->title }}</a>
                            </td>
                            <td>{{ $n->created_at->format('j F Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <img class="btn dropdown-toggle"data-toggle="dropdown"
                                        src="{{ asset('/assets/images/svg/gear.svg') }}">
                                    <span class="caret"></span></img>
                                    <ul class="dropdown-menu">
                                        <li onclick="handleEditNews('{{ $n->id }}')" style="cursor: pointer">
                                            <a class="dropdown-item">
                                                <span>Edit</span>
                                            </a>
                                        </li>
                                        <li onclick="handleDeleteNews('{{ $n->id }}')" style="cursor: pointer">
                                            <a class="dropdown-item">
                                                <span>Hapus</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center mt-3">
            <h4>Belum ada Data Berita</h4>
        </div>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#createNews').click(createNewsHandle);
            $('#newsTable').DataTable();
        });

        const handleEditNews = (id) => {
            const news = @json($news);
            const editedNews = news.find((v) => v.id === id);

            Swal.fire({
                    title: 'Edit Berita',
                    width: '800px',
                    showConfirmButton: true,
                    confirmButtonText: 'Edit!',
                    html: `
                <form class="text-left">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Judul Berita</label>
                        <input type="text" class="form-control" id="title" value="${editedNews.title}"></input>
                    </div>
                    <div class="form-group">
                        <label for="body" class="font-weight-bold">Isi Berita</label>
                        <textarea class="form-control" id="body" rows="10">${editedNews.body}</textarea>
                    </div>
                </form>
                `,
                    preConfirm() {
                        const title = document.querySelector('#title').value.trim()
                        const body = document.querySelector('#body').value.trim()

                        if (!title || !body) {
                            return Swal.showValidationMessage('Field is Required')
                        }

                        return {
                            title,
                            body
                        }
                    }
                })
                .then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: "{{ route('update_news') }}",
                            type: "PUT",
                            data: {
                                id: editedNews.id,
                                title: res.value.title,
                                body: res.value.body,
                            },
                            dataType: 'json',
                            success: function(res) {
                                if (res.status === 1) {
                                    return Toast(
                                        res.errors.title[0],
                                        'error'
                                    );
                                }

                                Toast(
                                    res.message
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                        });
                    }
                });
        }

        const handleDeleteNews = (id) => {
            Swal.fire({
                title: 'Hapus berita? ',
                text: 'Aksi ini tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete_news') }}",
                        type: "DELETE",
                        data: {
                            id,
                        },
                        dataType: 'json',
                        success: function(res) {
                            Toast(
                                res.success
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                    });
                }
            })
        }

        const createNewsHandle = () => {
            Swal.fire({
                    title: 'Tambah Berita Baru',
                    width: '800px',
                    showConfirmButton: true,
                    confirmButtonText: 'Submit!',
                    html: `
                <form class="text-left">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Judul Berita</label>
                        <input type="text" class="form-control" id="title"></input>
                    </div>
                    <div class="form-group">
                        <label for="body" class="font-weight-bold">Isi Berita</label>
                        <textarea class="form-control" id="body" rows="10"></textarea>
                    </div>
                </form>
                `,
                    preConfirm() {
                        const title = document.querySelector('#title').value.trim()
                        const body = document.querySelector('#body').value.trim()

                        if (!title || !body) {
                            return Swal.showValidationMessage('Field is Required')
                        }

                        return {
                            title,
                            body
                        }
                    }
                })
                .then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: "{{ route('store_news') }}",
                            type: "POST",
                            data: {
                                title: res.value.title,
                                body: res.value.body,
                            },
                            dataType: 'json',
                            success: function(res) {
                                if (res.status === 1) {
                                    return Toast(
                                        res.errors.title[0],
                                        'error'
                                    );
                                }

                                Toast(
                                    res.message
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                        });
                    }
                })
        }
    </script>
@endsection
