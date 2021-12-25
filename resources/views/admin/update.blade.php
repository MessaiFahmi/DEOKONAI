@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h1>
            Mettre à jour
        </h1>
    </div>

    <div class="card shadow mb-4 fs-5">
        <div class="card-body p-4">

            @if($hasUpdate)

                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="ml-2">
                        Une mise à jour est disponible.
                    </span>
                </div>
                La version <code>{{ $lastVersion }}</code> de Deokonai est disponible et vous avez actuellement la version <code>{{ Deokonai::version() }}</code>.

                {!! Form::open(['route' => 'admin.update.update', 'method' => 'POST']) !!}
                    <button type="submit" class="btn btn-primary mt-3">
                        Télécharger la mise à jour
                    </button>
                {!! Form::close() !!}

            @else

                <p>
                    Vous êtes à jour. Vous utilisez la dernière version de Deokonai : <code>{{ Deokonai::version() }}</code>. <br>
                    Les notes de mises à jours sont disponibles sur <a href="#" target="_blank">Deokonai</a>.
                </p>

            @endif
        </div>
    </div>

@endsection