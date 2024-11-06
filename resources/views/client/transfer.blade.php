<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Amen Bank</title>
    <link rel="shortcut icon" type="x-icon" href="{{ asset('dashassets/img/icons/amen_logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <div class="container-fluid px-0">


            @include('inc.client.sidebar')
            @include('inc.client.nav')

            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">

                        <h1 class="text-center mb-4">Transfer</h1>

                        <form action="/client/transfer" method="POST" class="bg-light p-5 rounded">
                             <!-- Afficher les messages de succès -->
                             @include('inc.flash-message')

                            <!-- Afficher les erreurs de validation -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @csrf
                            <!-- ... -->



                            <div class="form-group">
                                <label for="de_num_compte">Numéro de compte (de)</label>
                                <select class="form-control" id="de_num_compte" name="de_num_compte" >
                                    <option value="">Sélectionner un compte</option>
                                    @foreach (auth()->user()->comptes as $compte)
                                        @if($compte->status == 'approuvé')
                                            <option value="{{ $compte->num_compte }}">{{ $compte->num_compte }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="a_num_compte">Numéro de compte (à)</label>
                                <input type="number" class="form-control" id="a_num_compte" name="a_num_compte" >
                            </div>
                        
                            <div class="form-group">
                                <label for="solde">Montant</label>
                                <input type="number" class="form-control" id="solde" name="solde" step="0.001" min="0" >
                            </div>
                        


                            <div class="form-group">
                                <label for="otp">Entrez votre code OTP :</label>
                                <input type="password" class="form-control" id="otp" name="otp" >
                            </div>
                        <br>
                            <button type="submit" class="btn btn-success">Transférer</button>
                        </form>
                        
</div>
<footer class="footer">
<div class="row g-0 justify-content-between align-items-center h-100 mb-3">
    <div class="col-12 col-sm-auto text-center">
        <p class="mb-0 text-900">Thank you for creating with phoenix<span
                class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
    </div>
    <div class="col-12 col-sm-auto text-center">
        <p class="mb-0 text-600">v1.1.0</p>
    </div>
</div>
</footer>
</div>
</div>
</main>



        <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
        <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
    </body>
    
    </html>
    
