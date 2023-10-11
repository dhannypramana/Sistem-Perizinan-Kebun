@extends('services.layouts.index')

@section('container')
    <h3 class="fw-bolder text-dark">Daftar Pengajuan Permintaan Data</h3>
    <hr class="divider rounded">

    @if ($data_request->isNotEmpty())
        <div class="px-5 mt-5">
            <table class="table table-bordered table-hover" id="dataRequestTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Izin</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_request as $d)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @if (auth()->user()->is_admin == 1)
                                    <a
                                        href="{{ route('admin_data_request_details', ['license_number' => $d->license_number]) }}">{{ $d->license_number }}</a>
                                @else
                                    <a
                                        href="{{ route('data_request_details', ['license_number' => $d->license_number]) }}">{{ $d->license_number }}</a>
                                @endif
                            </td>
                            <td>{{ $d->created_at->format('j F Y, H:i a') }}</td>
                            <td>
                                @if ($d->status == 0)
                                    Menunggu Konfirmasi
                                @elseif ($d->status == 1)
                                    Disetujui
                                @elseif ($d->status == 2)
                                    Ditolak
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center mt-5">
            <h5>Belum ada Data Permintaan Data</h5>
        </div>
    @endif

@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#dataRequestTable').DataTable();
        });
    </script>
@endsection
