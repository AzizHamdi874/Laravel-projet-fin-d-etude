





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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <div class="container">
                            <h1>Transfert de masse</h1>
                        
                            <form action="{{ route('transferMasse') }}" method="POST">
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
                        
                                <div class="form-group">
                                    <label for="de_num_compte">Numéro de compte (de)</label>
                                    <select class="form-control" id="de_num_compte" name="de_num_compte" required>
                                        <option value="">Sélectionner un compte</option>
                                        @foreach (auth()->user()->comptes as $compte)
                                            <option value="{{ $compte->num_compte }}">{{ $compte->num_compte }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div id="transfers">
                                    <div class="form-group transfer">
                                        <label for="a_num_compte">Numéro de compte (à)</label>
                                        <input type="text" class="form-control" id="a_num_compte" name="transfers[0][a_num_compte]" required>
                        
                                        <label for="solde">Montant</label>
                                        <input type="number" class="form-control" id="solde" name="transfers[0][solde]" step="0.01" min="0" required>
                        
                                        <button type="button" class="removeTransfer btn btn-danger"><i class="fa-solid fa-circle-xmark"></i></button>
                                    </div>
                                </div>
                                <br>
                                <button type="button" id="addTransfer" class="btn btn-success" ><i class="fa-solid fa-circle-plus"></i></button>
                        
                                <div class="form-group">
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Transférer</button>
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
        <script>
            document.getElementById('addTransfer').addEventListener('click', function() {
                var transfers = document.getElementById('transfers');
                var index = transfers.children.length;
                var div = document.createElement('div');
                div.className = 'form-group transfer';
                div.innerHTML = `
                    <div class="form-group">
                        <label for="a_num_compte">Numéro de compte (à)</label>
                        <input type="text" class="form-control" id="a_num_compte" name="transfers[${index}][a_num_compte]" required>
            
                        <label for="solde">Montant</label>
                        <input type="number" class="form-control" id="solde" name="transfers[${index}][solde]" step="0.01" min="0" required>
                            <br>
                        <button type="button" class="removeTransfer btn btn-danger"><i class="fa-solid fa-circle-xmark"></i></button>
                        <br>
                    </div>
                `;
                transfers.appendChild(div);
            });
            
            document.getElementById('transfers').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('removeTransfer')) {
                    e.target.parentNode.remove();
                }
            });
            </script>
    </body>
    
    </html>
    
