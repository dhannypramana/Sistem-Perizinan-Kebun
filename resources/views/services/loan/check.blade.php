@extends('services.layouts.index')

@section('container')
    <h3 class="fw-bolder text-dark">Daftar Pengajuan Permintaan Data</h3>
    <hr class="divider rounded">

    @if ($loan->isNotEmpty())
        <div class="px-5 mt-5">
            <table class="table table-bordered table-hover" id="loanTable">
                <thead>
                    <tr>
                        <th>No. Izin</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loan as $l)
                        <tr>
                            <td>
                                @if (auth()->user()->is_admin == 1)
                                    <a
                                        href="{{ route('admin_loan_details', ['license_number' => $l->license_number]) }}">{{ $l->license_number }}</a>
                                @else
                                    <a
                                        href="{{ route('loan_details', ['license_number' => $l->license_number]) }}">{{ $l->license_number }}</a>
                                @endif
                            </td>
                            <td>{{ $l->created_at->format('j F Y, H:i a') }}</td>
                            <td>
                                @if ($l->status == 0)
                                    Menunggu Konfirmasi
                                @elseif ($l->status == 1)
                                    Disetujui
                                @elseif ($l->status == 2)
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
            <h5>Belum ada Data Peminjaman</h5>
        </div>
    @endif

@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#loanTable').DataTable();
        });
    </script>
@endsection
