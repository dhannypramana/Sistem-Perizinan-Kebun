@extends('services.layouts.index')

@section('container')
    <h3 class="fw-bolder text-dark">Daftar Pengajuan Penelitian</h3>
    <hr class="divider rounded">

    @if ($research->isNotEmpty())
        <div class="px-5 mt-5">
            <table class="table table-bordered table-hover" id="researchTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Izin</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($research as $r)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @if (auth()->user()->is_admin == 1)
                                    <a
                                        href="{{ route('admin_research_details', ['license_number' => $r->license_number]) }}">{{ $r->license_number }}</a>
                                @else
                                    <a
                                        href="{{ route('research_details', ['license_number' => $r->license_number]) }}">{{ $r->license_number }}</a>
                                @endif
                            </td>
                            <td>{{ $r->created_at->format('j F Y, H:i a') }}</td>
                            <td>
                                @if ($r->status == 0)
                                    Menunggu Konfirmasi
                                @elseif ($r->status == 1)
                                    Disetujui
                                @elseif ($r->status == 2)
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
            <h5>Belum ada Data Penelitian</h5>
        </div>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#researchTable').DataTable();
        });
    </script>
@endsection
