
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
     
.button-aa {
    display: inline-block;
    padding: 10px 15px;
    font-size: 15px;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    text-decoration: none;
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

                  <h2>Affectation compte : Accées Administrateur</h2>

<br>
  <table class="table-custom">   
      <thead>
          <tr>
            <th>Numero utilisateur</th>
            <th>Libellé</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($comptes as $compte)
              <tr>
                  
                <td>{{ $compte->user->numero_user }}</td>
                <td>{{ $compte->libelle }}</td>
                <td>{{ $compte->type }}</td>
                
                @if ($compte->status == 'en attente')
               <td> <span class="badge bg-warning">{{ $compte->status }}</span></td>
            @elseif ($compte->status == 'approuvé')
                <td><span class="badge bg-success">{{ $compte->status }}</span></td>
            @endif
                <td>
                    @if ($compte->status == 'en attente')
                        <a class="button-aa" href="{{ route('admin.approver_compte', $compte->id) }}">Approuver</a>
                    @endif
                </td>
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










