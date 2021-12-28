@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between">
        <h1>
            Paramètres généraux
        </h1>
    </div>

    <div class="px-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Paramètres</li>
                <li class="breadcrumb-item active">Généraux</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.settings.index') }}" method="POST">
                @csrf

                <div class="row mb-3">

                    <div class="form-group col-md-6">
                        <label for="nameInput">Nom du site</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ old('name', site_name()) }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="urlInput">URL du site</label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" id="urlInput" name="url" value="{{ old('url', config('app.url')) }}" required>

                        @error('url')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label for="descriptionInput">Description du site</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="descriptionInput" name="description" value="{{ old('description', setting('description')) }}">
                    @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keywordsInput">Mots-clé du site</label>
                    <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywordsInput" name="keywords" placeholder="word1, word2" value="{{ old('keywords', setting('keywords', '')) }}" aria-describedby="keywordsInfo">
                    @error('keywords')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <small id="keywordsInfo" class="form-text">
                        Les mots-clés doivent être séparés par une virgule.
                    </small>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="imageSelect">Icône du site</label>
                        <div class="input-group mb-3">
                                <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-upload"></i>
                                </a>
                            <select class="form-select @error('icon') is-invalid @enderror" id="imageSelect" data-image-select="faviconPreview" name="icon">
                                <option value="" @if(!$icon) selected @endif>Aucun(e)</option>
                                @foreach($images as $image)
                                    <option value="{{ $image->file }}" @if($image->file === $icon) selected @endif>{{ $image->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 @if(!$icon) d-none @endif">
                            <img src="{{ $icon ? favicon() : '#' }}" class="img-fluid rounded img-preview-sm" alt="Favicon" id="faviconPreview">
                        </div>
                        @error('icon')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="logoSelect">Logo</label>
                        <div class="input-group mb-3">
                            <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-upload"></i>
                            </a>
                            <select class="form-select @error('logo') is-invalid @enderror" id="logoSelect" data-image-select="logoPreview" name="logo">
                                <option value="" @if(!$logo) selected @endif>Aucun(e)</option>
                                @foreach($images as $image)
                                    <option value="{{ $image->file }}" @if($image->file === $logo) selected @endif>{{ $image->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3 @if(!$logo) d-none @endif">
                            <img src="{{ $logo ? image_url($logo) : '#' }}" class="img-fluid rounded img-preview-sm" alt="Logo" id="logoPreview">
                        </div>
                        @error('logo')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="imageSelect">Arrière-plan</label>
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-upload"></i>
                        </a>
                        <select class="form-select @error('background') is-invalid @enderror" id="imageSelect" data-image-select="backgroundPreview" name="background">
                            <option value="" @if(!$background) selected @endif>aucun(e)</option>
                            @foreach($images as $image)
                                <option value="{{ $image->file }}" @if($image->file === $background) selected @endif>{{ $image->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 @if(!$background) d-none @endif">
                        <img src="{{ $background ? image_url($background) : '#' }}" class="img-fluid rounded img-preview-sm" alt="background" id="backgroundPreview">
                    </div>
                    @error('background')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="timezoneSelect">Fuseau horaire</label>
                        <select class="form-select @error('timezone') is-invalid @enderror" id="timezoneSelect" name="timezone" required>
                            @foreach($timezones as $timezone)
                                <option value="{{ $timezone }}" @if($timezone === $currentTimezone) selected @endif>{{ $timezone }}</option>
                            @endforeach
                        </select>
                        @error('timezone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
    
                    <div class="form-group col-md-6">
                        <label for="copyrightInput">Copyright</label>
                        <input type="text" class="form-control @error('copyright') is-invalid @enderror" id="copyrightInput" name="copyright" value="{{ old('copyright', $copyright) }}">
                        @error('copyright')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>
                    Sauvegarder
                </button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('[data-image-select]').on('change', function () {
                const preview = $('#' + $(this).data('image-select'));
                if ($(this).val().length === 0) {
                    preview.parent().addClass('d-none');
                } else {
                    preview.parent().removeClass('d-none');
                    preview.attr('src', '{{ image_url() }}/' + $(this).val());
                }
            });
        });
    </script>
@endsection