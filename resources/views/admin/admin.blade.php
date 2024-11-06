
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">


        @include('inc.admin.sidebar')
        @include('inc.admin.nav')

        <div class="content">
          <div class="pb-5">
            @include('inc.flash-message')
            <h1 class="text-center mb-4">Espace demande crédit : Accés Administrateur</h1>


            <form action="{{ route('admin.chercherStatus') }}" method="get" class="row">
              <div class="col">
                  <select name="status" class="form-select">
                      <option value="">Tous les statuts</option>
                      <option value="en attente">En attente</option>
                      <option value="credit obtenu">Credit obtenu</option>
                      <option value="credit non obtenu">Credit non obtenu</option>
                  </select>
              </div>
              <div class="col-auto">
           <button type="submit" class="btn btn-primary">Chercher</button>
              </div>
          </form>
          
          
            <br>
            <hr>

            <div class="container">
              <table class="table-custom">
                <thead class="table-dark">
                    <tr>
                        <th>Numero de compte</th>
                        <th>Montant du crédit en (DT)</th>
                        <th>Durée de remboursement en (ans)</th>
                        <th>Revenu mensuel Brut en (DT)</th>
                        <th>Status</th>
                        <th>L'utilisateur va payer par mois en (DT)</th>
                        <th>Mensualité par dinar en (DT)</th>
                        <th>Date de demande</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($creditDemandes as $creditDemande)
                        <form action="{{ route('admin.approve', $creditDemande->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <tr>
                              <td>{{ $creditDemande->compte->num_compte }}</td>
                              <td>{{ $creditDemande->solde }}</td>
                                <td>{{ $creditDemande->duree_remboursement }}ans</td>
                                <td>{{ $creditDemande->revenu_mensuel }}</td>
                                <td>
                                    <select name="status" class="form-select">
                                        <option value="en attente" {{ $creditDemande->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="credit obtenu" {{ $creditDemande->status == 'credit obtenu' ? 'selected' : '' }}>Credit obtenu</option>
                                        <option value="credit non obtenu" {{ $creditDemande->status == 'credit non obtenu' ? 'selected' : '' }}>Credit non obtenu</option>
                                    </select>
                                </td>
                                @php
                                $duree = $creditDemande->duree_remboursement;
                            
                                if ($duree >= 1 && $duree <= 7) {
                                    $interet = 0.05;
                                } elseif ($duree >= 8 && $duree <= 14) {
                                    $interet = 0.06;
                                } elseif ($duree >= 15 && $duree <= 24) {
                                    $interet = 0.07;
                                } else {
                                    // Gérer les cas où la durée n'est pas dans les plages spécifiées
                                }
                            
                                $creditSolde = ($creditDemande->solde * ($interet / 12)) / (1 - pow(1 + ($interet / 12), - ($duree * 12)));
                            @endphp
                            
                            <td>{{ number_format($creditSolde, 3, '.', '') }} </td>                            
                                <td>{{ number_format($creditDemande->revenu_mensuel *0.4, 3, '.', ''); }} </td>
                                <td>{{ $creditDemande->created_at }}</td>
                                <td>
                                  <button type="submit" class="btn btn-primary" {{ $creditDemande->status != 'en attente' ? 'disabled' : '' }}>Sélectionner </button>                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
            
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.update-status-button').on('click', function(e) {
            var status = $(this).closest('form').find('select[name="status"]').val();
            if (status == 'en attente') {
                e.preventDefault();
                alert('Please choose a status other than "en attente".');
            } else {
                $(this).prop('disabled', true);
            }
        });
    });
    </script>
    
      


  </body>

</html>