@extends('layouts.default')

@section('content')

    @include('includes.navbar')

    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="pt-2">
                            Vérifier l'adresse email
                        </h2>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Un nouveau lien de vérification vous a été envoyé à votre adresse email.
                            </div>
                        @endif

                        Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.
                        Si vous n'avez pas reçu l'e-mail
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Cliquez ici pour recevoir un nouveau lien</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
