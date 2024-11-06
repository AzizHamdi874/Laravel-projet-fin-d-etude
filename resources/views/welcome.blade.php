<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="x-icon" href="{{ asset('dashassets/img/icons/amen_logo.png') }}">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('dashassets/img/style.css') }}" />
    <title>Amen Banque</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-success navbar-light py-3 fixed-top">
      <div class="container">
        <a href="#" class="navbar-brand"><img
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

    <!-- Présentation -->
    <section
      class="bg-white text-light p-4 p-lg-0 pt-lg-5 text-center text-sm-start"
    >
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div class="p-4">
            <h1><span class="text-dark">Bienvenue à</span> <span class="text-success">Amen Banque</span></h1>
            <p class="lead my-4 text-dark">
            <b>
            Nous nous concentrons sur l'enseignement à nos clients les fondamentaux des technologies les plus récentes et les plus performantes pour les préparer à leur premier rôle de développeur.
          </b></p>

          </div>
          <img
            class="img-fluid w-50 d-none d-sm-block"
            src="{{ asset('images/carte2.svg') }}"
            alt=""
          />
        </div>
      </div>
    </section>

<br>
<br>
<br>
<br>
<br>

    <!-- Contact & Carte -->
    <section class="p-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-md">
            <h2 class="text-center mb-4">Informations de Contact</h2>
            <ul class="list-group list-group-flush lead">
              <li class="list-group-item">
                <span class="fw-bold">Adresse Principale :</span> Avenue Mohamed V - 1002 Tunis
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Téléphone d'Enrôlement :</span> (+216)-71-148-000 / (+216)-39-148-000
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Centre de Relation Clients: </span> (+216)-71-148-888
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Email des Clients :</span>
                crc@amenbank.com.tn
              </li>
            </ul>
          </div>
          <div class="col-md">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Droits d'auteur &copy; 2024 Amen Banque</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
          <i class="bi bi-arrow-up-circle h1"></i>
        </a>
      </div>
    </footer>

    <!-- Modal -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
