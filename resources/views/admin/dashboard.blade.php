<!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Amen Bank</title>
    <link rel="shortcut icon" type="x-icon" href="{{ asset('dashassets/img/icons/amen_logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
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

              <h1>Admin Dashboard</h1>
              <br>
              <div class="row g-4">
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-primary">
                    <div class="card-body">
                      <h4 class="card-title text-white text-center">Nombre de client total </h4>
                      <h2 class="card-text text-white text-center">{{$count}}</h2>
                    </div>
                  </div>
                </div>
               
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-danger">
                    <div class="card-body">
                      <h4 class="card-title text-white text-center">Credit en attente </h4>
                      <h2 class="card-text text-white text-center">{{ $totCreditAtt }}</h2>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-warning">
                    <div class="card-body">
                      <h4 class="card-title text-white text-center">Compte par client </h4>
                      <h2 class="card-text text-white text-center">{{ number_format($moyCompteParUser, 2) }}</h2>
                    </div>
                  </div>
                </div>
                


                
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-dark">
                    <div class="card-body">
                      <h4 class="card-title text-white text-center">Total client activer </h4>
                      <h2 class="card-text text-white text-center">{{ number_format($pourcentageActiver, 2)}}%</h2>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-success">
                    <div class="card-body">
                      <h4 class="card-title text-white text-center">Total sicav </h4>
                      <h2 class="card-text text-white text-center">{{ $sicavs }}</h2>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card text-white bg-info">
                    <div class="card-body">
                      <h5 class="card-title text-white text-center">Total cours de la bourse </h4>
                      <h2 class="card-text text-white text-center">{{ $bbes }}</h2>
                    </div>
                  </div>
                </div>


              <br>
              <div style="display: flex; justify-content: space-around;">
                <div style="width: 50%;">
                  <canvas id="myBarChart"></canvas>
                </div>
                <div style="width: 20%; margin-top: 50px;">
                  <canvas id="myPieChart"></canvas>
                </div>
              </div>
              <div >
                <div style="width: 50%; margin-left: 80px; margin-top: 50px;">
                  <canvas id="userCountsChart"></canvas>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      let ctxPie = document.getElementById('myPieChart').getContext('2d');
      let ctxBar = document.getElementById('myBarChart').getContext('2d');
      let userCountsCtx = document.getElementById('userCountsChart').getContext('2d');

      let pieData = {
          labels: ['Crédit obtenu', 'En attente', 'Crédit non obtenu'],
          datasets: [{
              data: [<?php echo $totCreditApp; ?>, <?php echo $totCreditAtt; ?>, <?php echo $totCreditNonApp; ?>], // Les données
              backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)'], // Couleurs de fond
              borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)'], // Couleurs des bordures
              borderWidth: 1
          }]
      };

      let barData = {
          labels: @json($labels),
          datasets: [{
            label: 'Nombre d\'opérations',
            data: @json($data), // Les données de vos opérations
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
      };

      let myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: pieData,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Etat crédit', // Ajoutez votre titre ici
                font: {
                    size: 24, // Taille de la police en pixels
                },
                color: '#000000' // Couleur du titre en hexadécimal
            },
            legend: {
                display: true,
                position: 'bottom', // Positionne la légende en bas
            }
        }
    }
});


      let myBarChart = new Chart(ctxBar, {
          type: 'bar',
          data: barData,
          options: {
              plugins: {
                  title: {
                      display: true,
                      text: 'Total des opérations : ',
                      font: {
                          size: 24, // Taille de la police en pixels
                      },
                      color: '#000000' // Couleur du titre en hexadécimal
                  }
              },
           scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1, // Affiche uniquement les nombres entiers
                }
            }
        }
          }
      });
      let userCountsChart = new Chart(userCountsCtx, {
    type: 'bar',
    data: {
        labels: @json($jours),
        datasets: [{
            label: 'Nombre d\'utilisateurs',
            data: @json($userTotal),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Nombre total des utilisateurs par jour : ', // Ajoutez votre titre ici
                font: {
                    size: 24, // Taille de la police en pixels
                },
                color: '#000000' // Couleur du titre en hexadécimal
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1, // Affiche uniquement les nombres entiers
                }
            }
        }
    }
});

    </script>
    
    <script src="{{asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
  </body>

</html>