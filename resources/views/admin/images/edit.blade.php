@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between">
        <h1>
            Modifier une image
        </h1>
    </div>

    <div class="px-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.images.index') }}">Images</a></li>
                <li class="breadcrumb-item active">Modifier</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $image->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4 fs-5">
        <div class="card-body p-4">
            <form action="{{ route('admin.images.edit', $image->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="nameInput">Nom</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ old('name') ?? $image->name }}" required>

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
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugInput" name="slug" value="{{ old('slug') ?? $image->getSlug() }}" required>
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
                    <br>
                    <img src="{{ asset('storage/img/' . $image->file) }}" alt="{{ $image->name }}" class="img-fluid" style="max-width: 100%;">
                    <img src="#" class="mt-2 img-fluid rounded img-preview d-none" alt="Image" id="filePreview">
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil-fill me-2"></i>
                    Modifier
                </button>
                <a href="{{ route('admin.images.delete', $image->id) }}" class="btn btn-danger">
                    <i class="bi bi-trash-fill me-2"></i>
                    Supprimer
                </a>
            </form>
        </div>
    </div>

@endsection