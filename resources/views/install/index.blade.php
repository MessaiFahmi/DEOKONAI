@extends('layouts.install')

@section('content')

@if($compatible)
        <div class="text-center">
            <p class="text-success">
                <i class="fas fa-check"></i> DEOKONAI est prêt a être configuré !
            </p>

            <hr class="my-4">

            <a href="{{ route('install.database') }}" class="btn btn-primary rounded-pill mx-1">
                Continuer <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @else
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> Veuillez installer les prérequis manquant
        </div>

        <div class="list-group mb-3 requirements">
            @foreach($requirements as $requirement => $requirementStatus)
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-10">
                            @if(Str::startsWith($requirement, 'extension-'))
                                Extension : <b>{{ Str::after($requirement, '-') }}</b>
                            @elseif(Str::startsWith($requirement, 'function-'))
                                Fonction : <b>{{ Str::after($requirement, '-') }}</b>
                            @else
                                {{ Str::title($requirement) }}</b>
                            @endif
                        </div>  
                        <div class="col-2">
                            @if($requirement === 'php')
                                <span class="float-right text-{{ $requirementStatus ? 'success' : 'danger' }}"
                                      title="{{ PHP_VERSION }}">
                                    {{ $phpVersion }}
                                </span>
                            @elseif($requirementStatus)
                                <i class="bi bi-check2 text-success float-right"></i>
                            @else
                                <i class="bi bi-x-circle-fill text-danger float-right"></i>
                            @endif
                        </div>
                        @if($requirementStatus)
                            <div class="col-md-12 px-4 mt-2">
                                <i class="fas fa-info-circle text-primary mr-1"></i>
                                @if(Str::startsWith($requirement, 'extension-'))
                                    {{ "apt install curl php${minPhpVersion}-mysql php${minPhpVersion}-pgsql php${minPhpVersion}-sqlite php${minPhpVersion}-bcmath php${minPhpVersion}-mbstring php${minPhpVersion}-xml php${minPhpVersion}-curl php${minPhpVersion}-zip php${minPhpVersion}-gd" }}
                                @elseif(Str::startsWith($requirement, 'function-'))
                                    Vous devez activer cette fonction dans le fichier php.ini de PHP en modifiant la valeur de <b>disable_functions</b>.
                                @elseif($requirement === 'writable')
                                    Vous pouvez essayer de faire cette commande pour autoriser l\'écriture : {{ "chmod -R 755 " . base_path() . " && chown -R www-data:www-data " . base_path() }}
                                @else
                                    <!-- @lang('install.requirements.help.'.$requirement) -->
                                @endif
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

@endsection