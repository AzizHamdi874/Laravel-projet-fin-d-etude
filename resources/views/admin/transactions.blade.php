<!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="x-icon" href="{{ asset('dashassets/img/icons/amen_logo.png') }}">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
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


        @include('inc.admin.sidebar')
        @include('inc.admin.nav')
        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
                <div>
                  @include('inc.flash-message')

        <h1>Liste des transactions : Accès Administrateur</h1>
<br>
<form method="GET" action="{{ route('chercher_transactions') }}"class="row">
    <div class="form-group col-md-3">
      <label for="from_num_compte">Numero compte de l'expéditeur</label>
      <input type="number" class="form-control" id="from_num_compte" name="from_num_compte" placeholder="Numero compte de l'expéditeur">
    </div>
    <div class="form-group col-md-3">
      <label for="to_num_compte">Numero compte du destinataire</label>
      <input type="number" class="form-control" id="to_num_compte" name="to_num_compte" placeholder="Numero compte du destinataire">
    </div>
    <div class="form-group col-md-3">
      <label for="montant">Montant</label>
      <input type="number" class="form-control" id="montant" name="montant" placeholder="Montant">
    </div>
    <div class="col-md-3 d-flex align-items-end">
      <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
  
</form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">De user</th>
                <th scope="col">À user</th>
                <th scope="col">Montant</th>
                <th scope="col">De compte</th>
                <th scope="col">À compte</th>
                <th scope="col">Date de Transactions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->fromCompte->user->name }} {{ $transaction->fromCompte->user->prenom }}</td>
                    <td>{{ $transaction->toCompte->user->name }} {{ $transaction->fromCompte->user->prenom }}</td>
                    <td>{{ $transaction->solde }}</td>
                    <td>{{ $transaction->fromCompte->num_compte }}</td>
                    <td>{{ $transaction->toCompte->num_compte }}</td>
                    <td>{{ $transaction->updated_at }}</td>
                </tr>
            @endforeach
              </tbody>
    </table>

          </div>


        </div>

      </div>


    </div>
          <footer class="footer">
            <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-900">Thank you for creating with phoenix<span class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v1.1.0</p>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </main>
    <script src="{{asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js') }}"></script>



  </body>

</html>