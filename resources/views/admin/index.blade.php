@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-primary border-3 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fs-1 text-black text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-warning border-3 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Articles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-newspaper fs-1 text-black text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-secondary border-3 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Pages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-text-fill fs-1 text-black text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-secondary border-3 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Images</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-card-image fs-1 text-black text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script></script>
@endsection

@section('styles')
    <style></style>
@endsection