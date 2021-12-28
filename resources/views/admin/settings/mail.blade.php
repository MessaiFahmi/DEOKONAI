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
                <li class="breadcrumb-item">Paramètres</li>
                <li class="breadcrumb-item active" aria-current="page">Mail</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.settings.mail') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group mb-3 col-md-4">
                        <label for="mailerSelect">Type Mail</label>

                        <select class="form-select" id="mailerSelect" name="mailer" data-toggle-select="mail-type" aria-describedby="mailerInfo">
                            <option value="" @if(config('mail.default') === 'array') selected @endif>Aucun(e)</option>
                            @foreach($mailers as $mailer => $mailerName)
                                <option value="{{ $mailer }}" @if(config('mail.default') === $mailer) selected @endif>{{ $mailerName }}</option>
                            @endforeach
                        </select>

                        <small id="mailerInfo" class="form-text">DEOKONAI supporte le SMTP pour l'envoi des emails. Vous pouvez trouver plus d'informations sur l'envoi des mails dans notre <a href="">documentation.</a> </small>
                    </div>

                    <div class="form-group mb-3 col-md-8">
                        <label for="fromAddressInput">Adresse Email utilisée pour envoyer les emails.</label>
                        <input type="email" class="form-control @error('from-address') is-invalid @enderror" id="fromAddressInput" name="from-address" value="{{ old('from-address', config('mail.from.address')) }}" required>

                        @error('from-address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div data-mail-type="smtp">
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="smtpHostInput">Adresse de l'hôte SMTP</label>
                            <input type="text" class="form-control @error('smtp-host') is-invalid @enderror" id="smtpHostInput" name="smtp-host" value="{{ old('smtp-host', $smtpConfig['host']) }}" required>

                            @error('smtp-host')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-md-3">
                            <label for="smtpPortInput">Port de l'hôte SMTP</label>
                            <input type="number" min="1" max="65535" class="form-control @error('smtp-port') is-invalid @enderror" id="smtpPortInput" name="smtp-port" value="{{ old('smtp-port', $smtpConfig['port']) }}" required>

                            @error('smtp-port')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-md-3">
                            <label for="smtpEncryptionSelect">Protocole de chiffrement</label>

                            <select class="form-select" id="smtpEncryptionSelect" name="smtp-encryption">
                                <option value="" @if(config('mail.encryption') === null) selected @endif>Aucun(e)</option>

                                @foreach($encryptionTypes as $encryption => $encryptionName)
                                    <option value="{{ $encryption }}" @if($smtpConfig['encryption'] === $encryption) selected @endif>{{ $encryptionName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="smtpUsernameInput">Utilisateur du serveur SMTP</label>
                            <input type="text" class="form-control @error('smtp-username') is-invalid @enderror" id="smtpUsernameInput" name="smtp-username" value="{{ old('smtp-username', $smtpConfig['username']) }}">

                            @error('smtp-username')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="smtpPasswordInput">Mot de passe du serveur SMTP</label>

                            <input type="password" class="form-control @error('smtp-password') is-invalid @enderror" id="smtpPasswordInput" name="smtp-password" value="{{ old('smtp-password', $smtpConfig['password']) }}">

                            @error('smtp-password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="alert alert-warning d-none" role="alert" data-mail-type="sendmail">
                    <i class="fas fa-exclamation-triangle"></i> {{ trans('admin.settings.mail.sendmail-warn') }}
                </div>

                <div class="alert alert-warning d-none" role="alert" data-mail-type="undefined">
                    <i class="fas fa-exclamation-triangle"></i> {{ trans('admin.settings.mail.disabled-warn') }}
                </div>

                <div class="form-group mb-3" data-mail-type="smtp sendmail">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" id="verificationSwitch" name="users_email_verification" @if(setting('mail.users_email_verification')) checked @endif>
                        <label class="custom-control-label" for="verificationSwitch">Activer la vérification de l'adresse email des utilisateurs</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary disabled" >
                    <i class="bi bi-download me-1"></i>
                    Sauvegarder
                </button>

                <!-- <button type="button" class="btn btn-success" id="sendTestMail" data-mail-type="smtp sendmail">
                    <i class="fas fa-paper-plane"></i>
                    {{ trans('admin.settings.mail.send') }}
                    <span class="spinner-border spinner-border-sm btn-spinner" role="status"></span>
                </button> -->
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // const sendTestMailButton = document.getElementById('sendTestMail');

        // sendTestMailButton.addEventListener('click', function () {

        //     sendTestMailButton.setAttribute('disabled', '');

        //     axios.post('{{ route('admin.settings.mail') }}')
        //         .then(function (response) {
        //             createAlert('success', response.data.message, true)
        //         })
        //         .catch(function (error) {
        //             createAlert('danger', error.response.data.message ? error.response.data.message : error, true)
        //         })
        //         .finally(function () {
        //             sendTestMailButton.removeAttribute('disabled');
        //         });
        // });
    </script>
@endsection