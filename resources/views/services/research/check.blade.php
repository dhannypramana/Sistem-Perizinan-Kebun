@extends('services.layouts.index')

@section('container')
    <div class="container search-box">
        <div class="border rounded p-4">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12">
                    <div class="form">
                        <i class="fa fa-search"></i>
                        <form action="#">
                            <input type="text" name="search" class="form-control form-input" placeholder="No Izin ....">
                            {{-- <button type="submit" class="btn btn-outline-secondary mt-2">Search</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5">
        <h3 class="fw-bolder text-dark">Daftar Pengajuan Penelitian</h3>
        <hr class="divider rounded">
        <div class="list container-fluid mt-4">
            <?php
            $num = 1;
            ?>
            @foreach ($research as $r)
                <div class="item bg-white border rounded row d-flex justify-content-between align-items-center p-2 mb-3">
                    <div class="increment p-3">
                        <div class="value p-1 text-dark">{{ $num++ }}.</div>
                    </div>
                    <div class="num p-3">
                        <div class="sub-title p-1 text-dark fw-bolder">No. Izin</div>
                        <div class="value p-1">{{ $r->license_number }}</div>
                    </div>
                    <div class="date p-3">
                        <div class="sub_title p-1 text-dark fw-bolder">Tanggal Pengajuan</div>
                        <div class="value p-1">{{ $r->created_at }}</div>
                    </div>
                    <div class="status p-3">
                        <div class="sub_title p-1 text-dark fw-bolder">Status Pengajuan</div>
                        <div class="value p-1 width-status">{{ $r->status }}</div>
                    </div>
                    <div class="details p-3">
                        @if (auth()->user()->is_admin == 1)
                            <a href="{{ route('admin_research_details', ['license_number' => $r->license_number]) }}"
                                class="btn btn-primary">Details</a>
                        @else
                            <a href="{{ route('research_details', ['license_number' => $r->license_number]) }}"
                                class="btn btn-primary">Details</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            {{ $research->links() }}
        </div>
    </div>
@endsection
