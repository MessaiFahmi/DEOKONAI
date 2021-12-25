@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h1>
            Images
        </h1>
        <a href="{{ route('admin.images.create') }}" class="btn btn-primary fs-4">
            <i class="bi bi-cloud-arrow-up-fill me-2"></i>
            Ajouter une image
        </a>
    </div>

    @include('includes.flash')

    <div class="shadow p-3 rounded ">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Fichier</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($images->count() > 0)
                    @foreach($images as $image)
                        <tr>
                            <th scope="row">{{ $image->id }}</th>
                            <td>
                                <img src="{{ asset('storage/img/' . $image->file) }}" alt="{{ $image->name }}" class="img-fluid" style="max-width: 100px;">
                            </td>
                            <td>{{ $image->name }}</td>
                            <td>
                                <a href="{{ asset('storage/img/' . $image->file) }}" target="_blank" class="text-decoration-none">
                                    {{ $image->file }}
                                </a>    
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.images.edit', $image->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="{{ route('admin.images.delete', $image->id) }}" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            <h3 class="mt-2">
                                Aucune image
                            </h3>
                        </td>
                    </tr>   
                @endif
                <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr> -->
            </tbody>
        </table>
    </div>

@endsection