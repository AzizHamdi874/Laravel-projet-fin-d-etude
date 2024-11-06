<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Amen Bank</title>
    <link rel="stylesheet" href="{{ asset('dashassets/img/style1.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="x-icon" href="{{ asset('dashassets/img/icons/amen_logo.png') }}">
    <style>
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-success navbar-light py-3 fixed-top">
        <div class="container">
          <a href="{{route('/')}}" class="navbar-brand"><img
            src="{{ asset('dashassets/img/icons/amen_logo.png') }}" alt="phoenix" width="95"></a>
  
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navmenu"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
               <a href="{{route('login')}}" class="nav-link"><span class="text-white">Connexion</span></a> 
              </li>
              <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link"><span class="text-white">Inscription</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <!-- Image -->
                <img src="{{ asset('dashassets/img/icons/amen_logo.png') }}" alt="">
                <div class="text">
                    <p>Amen Bank login<i>- Amen Bank</i></p>
                </div>
            </div>

            <div class="col-md-6 right">
                <div class="input-box">
                    <header>Login</header>
                    <form method="POST" action="{{ route('login') }}" class="p-4">
                        @csrf
                        <div class="input-field">
                            <input type="email" class="input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Email</label>
                            @error('email')
                                <span class="error-message" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div> 
                        <div class="input-field">
                            <input type="password" class="input @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            <label for="password">Mot de passe</label>
                            @error('password')
                                <span class="error-message" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div> 
                        <div class="input-field">
                            <input type="submit" class="submit" value="Login">
                        </div> 
                    </form>

                </div>  
            </div>
        </div>
    </div>
</div>

</body>
</html>
