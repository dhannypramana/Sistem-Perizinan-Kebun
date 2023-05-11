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
        <h3 class="fw-bolder text-dark">Daftar Pengajuan Permintaan Data</h3>
        <hr class="divider rounded">
        <div class="list container-fluid mt-4">
            <?php
            $num = 1;
            ?>
            @foreach ($practicum as $p)
                <div class="item bg-white border rounded row d-flex justify-content-between align-items-center p-2 mb-3">
                    <div class="increment p-3">
                        <div class="value p-1 text-dark">{{ $num++ }}.</div>
                    </div>
                    <div class="num p-3">
                        <div class="sub-title p-1 text-dark fw-bolder">No. Izin</div>
                        <div class="value p-1">{{ $p->license_number }}</div>
                    </div>
                    <div class="details p-3">
                        <a href="{{ route('practicum_details', ['license_number' => $p->license_number]) }}"
                            class="btn btn-primary">Details</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            {{ $practicum->links() }}
        </div>
    </div>
@endsection
