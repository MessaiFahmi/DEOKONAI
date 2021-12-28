@extends('layouts.install')

@section('content')

    <form method="POST" action="{{ route('install.admin_user') }}">
        <h2>Compte administrateur</h2>

        @csrf

        <div class="mb-3 form-group">
            <label for="name">Nom d'utilisateur</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label for="email">Adresse mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label for="password-confirm">Confirmer le mot de passe</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between">
            <a href="{{ route('install.database') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left me-1"></i>
                Retour
            </a>
            <button type="submit" class="btn btn-primary">
                Continuer 
                <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </div>
    </form>

@endsection