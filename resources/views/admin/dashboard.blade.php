@extends('services.layouts.index')

@section('title')
    Admin Dashboard
@endsection

@section('container')
    <div class="helper-desk">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pengajuan Penelitian
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('assets/images/svg/undraw_comment.svg') }}" class="mr-1"
                                    width="25">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pengajuan Permintaan Data
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">7</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('assets/images/svg/undraw_comment.svg') }}" class="mr-1"
                                    width="25">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pengajuan Peminjaman
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">9</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('assets/images/svg/undraw_comment.svg') }}" class="mr-1"
                                    width="25">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pengajuan Praktikum
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">9</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('assets/images/svg/undraw_comment.svg') }}" class="mr-1"
                                    width="25">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>

                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis reprehenderit aut consequatur cum
                            iste optio maiores, eveniet, consectetur provident vel reiciendis tenetur asperiores, recusandae
                            repellendus harum nemo dolore eligendi? Facere, a rerum natus, eius cumque facilis
                            exercitationem aperiam minima quasi neque sit odio asperiores repudiandae nostrum numquam est
                            excepturi accusamus.</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Find Details on Here &rarr;</a>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                    </div>

                    <div class="card-body">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam eius inventore nostrum, dolore
                            laboriosam labore asperiores culpa deserunt rerum velit ex nihil dignissimos eos incidunt
                            reprehenderit laudantium adipisci nulla illum.</p>
                        <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et quas nulla vel,
                            consectetur quo rem?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
