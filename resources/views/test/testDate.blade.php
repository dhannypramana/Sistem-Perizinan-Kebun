@extends('services.layouts.index')

@section('container')
    <div class="form-group" id="loan">
        <label for="loanCategory" class="form-label">Kategori Peminjaman</label>
        <select name="loanCategory" id="loanCategory" class="form-control">
            <option value="all_category" selected>Semua Kategori</option>
            <option value="Ruangan">Ruangan</option>
            <option value="Alat">Alat</option>
            <option value="Lain-Lain">Lain-Lain</option>
        </select>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {

        })
    </script>
@endsection
