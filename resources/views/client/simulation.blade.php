


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
                        <div>

                            <h1 class="mt-4">Simulation de prêt</h1>

                            <!-- Simulation Form -->
                            <form action="{{ route('simulate') }}" method="post" class="mt-4">
                                @csrf
                    
                                <div class="form-group">
                                    <label for="montant_credit">Montant du crédit (en dinar):</label>
                                    <input type="number" id="montant_credit" name="montant_credit" class="form-control" value="{{ old('montant_credit', $montantCredit ?? '') }}" step="0.001" required min="1500" max="100000"> 
                                </div>
                    
                                <div class="form-group">
                                    <label for="durre_rembourssement">Durée de remboursement (en ans):</label>
                                    <select id="durre_rembourssement" name="durre_rembourssement" class="form-control"  required>
                                        <option value="">Sélectionner l'année</option>
                                        @for ($i = 1; $i <= 24; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                    
                                <div class="form-group">
                                    <label for="salaire_mensuel">Revenu mensuel Brut (en dinar):</label>
                                    <input type="number" id="salaire_mensuel" name="salaire_mensuel" class="form-control" value="{{ old('salaire_mensuel', $salaireMensuel ?? '') }}" step="0.001" required min="550" max="3300">
                                </div>
                                <br>
                    
                                <button type="submit" class="btn btn-success">Simuler</button>
                            </form>
                    
                            <!-- Simulation Results -->
                            @if(isset($results))
                                <h2 class="mt-4">Résultats de la simulation</h2>
                    
                                <div class="form-group">
                                    <label for="payment_mensuel">Vous paierez par mois:</label>
                                    <input type="number" id="payment_mensuel" class="form-control" value="{{ $results['payment_mensuel'] }}" readonly>
                                </div>
                    
                                <div class="form-group">
                                    <label for="max_montant_credit">Montant maximum du crédit:</label>
                                    <input type="number" id="max_montant_credit" class="form-control" value="{{ $results['max_montant_credit'] }}" readonly>
                                </div>
                    
                                <div class="form-group">
                                    <label for="payment_mensuel_par_dinar">Mensualité par dinar:</label>
                                    <input type="number" id="payment_mensuel_par_dinar" class="form-control" value="{{ $results['payment_mensuel_par_dinar'] }}" readonly>
                                </div>
                            @endif


                

 









                                    </div>

                              </div>

                        </div>


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