@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between">
        <h1>
            Paramètres SEO
        </h1>
    </div>

    <div class="px-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Paramètre</li>
                <li class="breadcrumb-item active" aria-current="page">SEO</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.settings.seo') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="htmlHeadArea">Code HTML à inclure dans le {{ __("<head>") }} de toutes les pages.</label>
                    <textarea class="form-control @error('html-head') is-invalid @enderror" id="htmlHeadArea" name="html-head" rows="4">{{ old('html-head', $htmlHead) }}</textarea>
                    @error('html-head')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="htmlBodyArea">Code HTML à inclure dans le {{ __("<body>") }} de toutes les pages.</label>
                    <textarea class="form-control @error('html-body') is-invalid @enderror" id="htmlBodyArea" name="html-body" aria-describedby="htmlBodyInfo" rows="4">{{ old('html-body', $htmlBody) }}</textarea>
                    @error('html-body')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <small id="htmlBodyInfo" class="form-text">Exemple: Bannière cookies, Google Analytics, etc</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>
                    Sauvegarder
                </button>
            </form>
        </div>
    </div>

@endsection