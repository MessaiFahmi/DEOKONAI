@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between">
        <h1>
            Upload une image
        </h1>
    </div>

    <div class="px-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.images.index') }}">Images</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4 fs-5">
        <div class="card-body p-4">
            <form action="{{ route('admin.images.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="nameInput">Nom</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ old('name') }}" required>

                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="slugInput">Lien</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{ image_url() }}/</div>
                        </div>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugInput" name="slug" value="{{ old('slug') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">.(jpg|png|gif|svg|webp)</div>
                        </div>

                        @error('slug')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="imageInput">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="imageInput" name="image" accept=".jpg,.jpeg,.jpe,.png,.gif,.bmp,.svg,.webp" data-image-preview="filePreview" required>
                        <label class="custom-file-label" for="customFile" data-browse="{{ trans('messages.actions.browse') }}">Choisir le fichier</label>

                        @error('image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <img src="#" class="mt-2 img-fluid rounded img-preview d-none" alt="Image" id="filePreview">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                    Sauvegarder
                </button>
            </form>
        </div>
    </div>

@endsection