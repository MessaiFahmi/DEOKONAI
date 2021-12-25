@extends('layouts.default')

@section('content')

    @include('includes.navbar')

    <section class="top-content position-relative bg-dark text-white" style="height:50vh;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center">

                <h1 class="text-center my-5 py-5 fw-bold" style="font-size: 5rem;">
                    Blog
                </h1>

            </div>
        </div>
    </section>

    <section class="px-5 py-3 bg-secondary bg-opacity-25 fs-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                
            </ol>
        </nav>
    </section>

    <section class="p-5">
        <div class="container py-5 position-relative">

            <div class="btn-group position-absolute top-0 end-0">
                @if(Route::has('posts.create'))
                    @can('posts-create')
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endcan
                @endif
            </div>

            <div class="card-columns">
                @foreach($posts as $post)
                    <div class="card my-2">
                        <div class="card-header">
                            <h2 class="card-title">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $post->body }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <small class="text-muted">
                                <i class="bi mx-1 bi-calendar-fill"></i>
                                {{ $post->created_at->format('d/m/Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="bi mx-1 bi-chat-fill"></i> 
                                {{ $post->comments->count() }}
                            </small>
                            <small class="text-muted">
                                <i class="bi mx-1 bi-person-fill"></i>
                                {{ $post->user->name }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#title').focus();
        });
    </script>
@endsection

@section('styles')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection