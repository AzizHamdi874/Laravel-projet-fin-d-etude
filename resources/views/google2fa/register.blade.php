@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card card-default">
                <h4 class="card-heading text-center mt-4">Configurer Google Authenticator</h4>
   
                <div class="card-body" style="text-align: center;">
                    <p>Configurez votre authentification à deux facteurs en scannant le code-barres ci-dessous. Alternativement, vous pouvez utiliser le code.<strong>{{ $secret }}</strong></p>
                    <div>
                        {!! $QR_Image !!}
                    </div>
                    <p>Et ça Vous devez configurer votre application Google Authenticator avant de continuer. Sinon, vous ne pourrez pas vous connecter.</p>
                    <div>
                        <a href="{{ route('complete.registration') }}" class="btn btn-primary">Complete Registration</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
