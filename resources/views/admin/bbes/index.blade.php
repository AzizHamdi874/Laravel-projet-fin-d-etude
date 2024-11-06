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
    <link rel="manifest" href="assets/img/favicons/manifest.json">
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


            @include('inc.admin.sidebar')
            @include('inc.admin.nav')




            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <div>
                            @include('inc.flash-message')
                            <h2>Liste des bourse en ligne</h2>
                            <hr />
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href=""
                                class="btn btn-primary mt-3">Ajouter BBE</a>
                        </div>





                        <div class="mt -3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Drapeau </th>
                                        <th scope="col">Désignation</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Unité</th>
                                        <th scope="col">Achat</th>
                                        <th scope="col">Vente</th>                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bbes as $index => $bbe)
                                        <tr>






                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                <img  src="{{ asset('uploads') }}/{{ $bbe->image }}" alt="" width="50">
                                            </td>
                                            <td>{{ $bbe->designation }}</td>
                                            <td>{{ $bbe->code }}</td>
                                            <td>{{ $bbe->unite }}</td>
                                            <td>{{ $bbe->achat }}</td>
                                            <td>{{ $bbe->vente }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editBbe{{ $bbe->id }}" href="" class="btn btn-success">Modifier</a>
                                                <a onclick="return confirm('Voulez-vous vraiment supprimer l\'enregistrement')"
                                                    href="/admin/bbes/{{ $bbe->id }}/delete"
                                                    class="btn btn-danger">Supprimer</a>
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

    <!-- Modal ajout -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter BBE</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                </div>
                <form action="/admin/bbes/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="adminSelect">Sélection de la désignation</label>
                            <select name="designation" class="form-control" id="designation">
                                <option value="">Sélectionnez une option...</option>
                                <option value="Riyal Saoudien">Riyal Saoudien</option>
                                <option value="Dollar Canadien">Dollar Canadien</option>
                                <option value="Couronne Danoise">Couronne Danoise</option>
                                <option value="Dirham Emirats Arabe Unis">Dirham Emirats Arabe Unis</option>
                                <option value="Dollar des Etats-Unis">Dollar des Etats-Unis</option>
                                <option value="Livre Sterling">Livre Sterling</option>
                                <option value="Yen Japonais">Yen Japonais</option>
                                <option value="Dinar Koweitien">Dinar Koweitien</option>
                                <option value="Couronne Norvégienne">Couronne Norvégienne</option>
                                <option value="Riyal Quatari">Riyal Quatari</option>
                                <option value="Couronne Suédoise">Couronne Suédoise</option>
                                <option value="Franc Suisse">Franc Suisse</option>
                                <option value="Euro">Euro</option>
                                <option value="Dinar Bahraini">Dinar Bahraini</option>
                                <option value="Yuan Chinois">Yuan Chinois</option>
                            </select>
                            @error('designation')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        
                        <div class="mb-3">
                            <label class="form-label" for="code">Sélection de code</label>
                            <select name="code" class="form-control" id="code">
                                <option value="">Sélectionnez une option...</option>
                                <option value="SAR">SAR</option>
                                <option value="CAD">CAD</option>
                                <option value="DKK">DKK</option>
                                <option value="AED">AED</option>
                                <option value="USD">USD</option>
                                <option value="GBP">GBP</option>
                                <option value="JPY">JPY</option>
                                <option value="KWD">KWD</option>
                                <option value="NOK">NOK</option>
                                <option value="QAR">QAR</option>
                                <option value="SEK">SEK</option>
                                <option value="CHF">CHF</option>
                                <option value="EUR">EUR</option>
                                <option value="BHD">BHD</option>
                                <option value="CNY">CNY</option>
                            </select>
                            @error('code')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Achat </label>
                            <input name="achat" class="form-control" id="exampleFormControlInput1"
                                type="number" step="0.001" placeholder="Achat titre ici...">
                            @error('achat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Unité </label>
                            <input name="unite" class="form-control" id="exampleFormControlInput1"
                                type="number"  placeholder="Unité ouverture titre ici...">
                            @error('unite')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Vente </label>
                            <input name="vente" class="form-control" id="exampleFormControlInput1"
                                type="number" step="0.001" placeholder="Vente ici...">
                            @error('vente')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Image </label>
                            <input name="image" class="form-control" id="exampleFormControlInput1"
                                type="file">

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Okay</button>
                        <button class="btn btn-outline-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($bbes as $index=> $bbe )
            <!-- Modal modifier -->
    <div class="modal fade" id="editBbe{{ $bbe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier BBE :<span class="text-primary"> {{  $bbe->designation    }} </span></h5><button class="btn p-1"
                    type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                        class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 352 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                        </path>
                    </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="/admin/bbes/update" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">


                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Unité </label>
                        <input name="unite" class="form-control" id="exampleFormControlInput1"
                            type="number" value="{{ $bbe->unite }}" placeholder="Unité titre ici...">
                        @error('unite')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Achat </label>
                        <input name="achat" class="form-control" id="exampleFormControlInput1"
                            type="number" step="0.001" value="{{ $bbe->achat }}" placeholder="Achat titre ici...">
                        @error('achat')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Vente </label>
                        <input name="vente" class="form-control" id="exampleFormControlInput1"
                            type="number" step="0.001" value="{{ $bbe->vente }}" placeholder="Vente titre ici...">
                        @error('vente')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">image </label>
                        <input name="image" class="form-control" id="exampleFormControlInput1"
                            type="file">
            
                    </div>




                      <input type="hidden" value="{{$bbe->id}}" name="id_bbe">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Okay</button>
                    <button class="btn btn-outline-primary" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
    @endforeach

    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>

</html>
