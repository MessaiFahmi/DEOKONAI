@extends('layouts.install')

@section('content')

    <form method="POST" action="{{ route('install.database') }}">
        <h2>Configuration de la base de données</h2>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="custom-select" id="type" name="type" data-toggle-select="database">
                @foreach($databaseDrivers as $dbId => $dbName)
                    <option value="{{ $dbId }}" @if($dbId === old('type')) selected @endif>{{ $dbName }}</option>
                @endforeach
            </select>
        </div>

        <div id="databaseForm" data-database="mysql pgsql sqlsrv">
            <div class="form-row mb-3">
                <div class="form-group col-md-9">
                    <label for="host">Adresse</label>
                    <input name="host" type="text" class="form-control @error('host') is-invalid @enderror" id="host" placeholder="127.0.0.1" value="{{ old('host', '') }}">
                    @error('host')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="port">Port</label>
                    <input name="port" type="number" class="form-control @error('port') is-invalid @enderror" id="port" placeholder="3306" value="{{ old('port', '') }}">

                    @error('port')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group  mb-3">
                <label for="database">Base de données</label>
                <input name="database" type="text" class="form-control @error('database') is-invalid @enderror" id="database" placeholder="deokonai" value="{{ old('database', '') }}">

                @error('database')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group  mb-3">
                <label for="user">Utilisateur</label>
                <input name="user" type="text" class="form-control @error('user') is-invalid @enderror" id="user" placeholder="root" value="{{ old('user', '') }}">

                @error('user')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group  mb-3">
                <label for="password">Mot de passe</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="123456">
            </div>
        </div>

        <p class="text-danger" data-database="sqlite sqlsrv">
            Ce type de base de données n\'est pas recommandé et ne devrait être utilisé que lorsqu\'il n\'est pas possible de faire autrement.
        </p>

        <hr class="my-4">

        <div class="d-flex justify-content-between">
            <a href="{{ route('install.index') }}" class="btn btn-primary">
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