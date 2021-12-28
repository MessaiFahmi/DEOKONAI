@extends('layouts.install')

@section('content')

    <h3 class="text-center">
        <i class="bi bi-check2 text-success"></i>
        Installation terminée
    </h3>

    <hr class="my-4">

    <div class="text-center">
        <a href="{{ route('home') }}" class="btn rounded-pill btn-success ">Commencer l'utilisation <i class="bi bi-arrow-right ms-1"></i></a>
    </div>

@endsection