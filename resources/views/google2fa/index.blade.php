
<head>
    <link rel="stylesheet" href="{{ asset('dashassets/img/style_otp.css') }}" />

</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 90vh;">
        <div class="col-md-8 offset-md-2">
            <div class="card card-left">
                <div class="card-header text-white font-weight-bold" style="background-color: #4CAF50;">Inscription</div>
                <hr>
                @if($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                          <strong>{{$errors->first()}}</strong>
                        </div>
                    </div>
                @endif

                <div class="card-body" >
                    <form class="form-horizontal d-flex flex-column align-items-center" method="POST" action="{{ route('2fa') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <p>Veuillez entrer le <strong>OTP</strong> généré sur votre application d'authentification. <br> Assurez-vous de soumettre l'OTP actuel car il se rafraîchit toutes les 30 secondes.</p>
                            <label for="one_time_password" class="col-md-4 control-label">Mot de passe à usage unique</label>

                            <div class="col-md-6 mx-auto">
                                <input id="one_time_password" type="number" class="form-control otp-input" name="one_time_password" required autofocus>
                            </div>

                        <div class="form-group col-md-2 mx-auto ">
                            <button type="submit" class="btn btn-success mt-3">
                                Connexion
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
