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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $researchCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataRequestCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $loanCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $practicumCount }}</div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Reviewed Proposal</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Penelitian
                            <span class="float-right">
                                {{ $reviewedResearchPercentage == 100 ? 'Complete!' : $reviewedResearchPercentage . '%' }}
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $reviewedResearchPercentage }}%">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Permintaan Data
                            <span class="float-right">
                                {{ $reviewedDataRequestPercentage == 100 ? 'Complete!' : $reviewedDataRequestPercentage . '%' }}
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $reviewedDataRequestPercentage }}%">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Peminjaman
                            <span class="float-right">
                                {{ $reviewedLoanPercentage == 100 ? 'Complete!' : $reviewedLoanPercentage . '%' }}
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: {{ $reviewedLoanPercentage }}%">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">Praktikum
                            <span class="float-right">
                                {{ $reviewedPracticumPercentage == 100 ? 'Complete!' : $reviewedPracticumPercentage . '%' }}
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ $reviewedPracticumPercentage }}%">
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
