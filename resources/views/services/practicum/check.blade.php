@extends('services.layouts.index')

@section('container')
    <h3 class="fw-bolder text-dark">Daftar Pengajuan Praktikum</h3>
    <hr class="divider rounded">

    <div class="px-5 mt-5">
        <table class="table table-bordered table-hover" id="practicumTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Izin</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($practicum as $p)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            @if (auth()->user()->is_admin == 1)
                                <a
                                    href="{{ route('admin_practicum_details', ['license_number' => $p->license_number]) }}">{{ $p->license_number }}</a>
                            @else
                                <a
                                    href="{{ route('practicum_details', ['license_number' => $p->license_number]) }}">{{ $p->license_number }}</a>
                            @endif
                        </td>
                        <td>{{ $p->created_at->format('j F Y, H:i a') }}</td>
                        <td>
                            @if ($p->status == 0)
                                Menunggu Konfirmasi
                            @elseif ($p->status == 1)
                                Disetujui
                            @elseif ($p->status == 2)
                                Ditolak
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#practicumTable').DataTable();
        });
    </script>
@endsection
