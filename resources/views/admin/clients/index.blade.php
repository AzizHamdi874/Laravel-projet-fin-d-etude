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


            @include('inc.admin.sidebar')
            @include('inc.admin.nav')




            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <div>
                            
                            <h2>Liste des utilisateurs</h2>
                                <div class="mt-2">
                                    <form action="/admin/client" method="POST" class="bg-light p-5 rounded">
                                                        <!-- Afficher les messages de succès -->
                             @if (session('success'))
                             <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                                 <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                                 <p class="mb-0 flex-1">{{ session('success') }}</p>
                                 <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                         @endif

                            <!-- Afficher les messages d'erreur -->
                            @if (session('error'))
                            <div class="alert alert-outline-danger d-flex align-items-center" role="alert">
                                <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
                                <p class="mb-0 flex-1">{{ session('error') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

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
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="name">

                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-success" type="submit">Chercher</button>
                                            </div>
                                        </div>





                                    </form>
                                </div>


                            <hr />
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="/admin/client/store"
                                class="btn btn-primary mt-3">Ajouter user</a>
                        </div>





                        <div class="mt -3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">N de compte</th>
                                        <th scope="col">Nom client </th>
                                        <th scope="col">Prenom client </th>
                                        <th scope="col">Email client</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Etat</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $index => $client)
                                        <tr>






                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $client->numero_user }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->prenom }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>
                                                <img class="rounded-circle" src="{{ asset('uploads') }}/{{ $client->image }}" alt="" width="150">
                                            </td>
                                            <td>
                                                @if ($client->is_active)

                                                <span class="badge bg-primary">Active</span>
                                                    
                                                @else
                                                <span class="badge bg-success">Bloquer</span>
                                                @endif
                                            </td>
                                            
                                            
                                             
                                              {{--  <a data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}" href="/admin/users/update" class="btn btn-success">Modifier</a>
                                                --}}
                                                    <td >
                                                        @if ($client->is_active)

                                                        <a href="/admin/client/{{ $client->id }}/bloquer" class="btn btn-danger"> bloquer</a> 
                                                            
                                                        @else
                                                        <a href="/admin/client/{{ $client->id }}/activer" class="btn btn-success"> Activer</a> 
                                                        @endif


                                                        <a onclick="return confirm('Voulez-vous vraiment supprimer l\'enregistrement')"
                                                                 href="/admin/client/{{ $client->id }}/delete"
                                                                    class="btn btn-danger">Supprimer</a>

                                                         <a data-bs-toggle="modal" data-bs-target="#editClient{{$client->id}}" href="/admin/client/update" class="btn btn-success">Modifier</a>
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
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter user</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                </div>
                <form action="/admin/users/store" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">name </label>
                            <input name="name" class="form-control" id="exampleFormControlInput1"
                                type="text" placeholder="Code titre ici...">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">email </label>
                            <input name="email" class="form-control" id="exampleFormControlInput1"
                                type="email" placeholder="Plh cours titre ici...">
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">password </label>
                            <input name="password" class="form-control" id="exampleFormControlInput1"
                                type="password" placeholder="Plh cours titre ici...">
                            @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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




    @foreach ($clients as $index=> $client )
            <!-- Modal modifier -->
    <div class="modal fade" id="editClient{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier user :<span class="text-primary"> {{  $user->name    }} </span></h5><button class="btn p-1"
                    type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                        class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 352 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                        </path>
                    </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="/admin/users/update" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Code Titre </label>
                        <input name="name" class="form-control" id="exampleFormControlInput1"
                            type="text" value="{{ $user->name }}" placeholder="Code titre ici...">
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Plh cours </label>
                        <input name="email" class="form-control" id="exampleFormControlInput1"
                            type="email" value="{{ $user->email }}" placeholder="Plh cours titre ici...">
                        @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Plh cours </label>
                        <input name="password" class="form-control" id="exampleFormControlInput1"
                            type="password" value="{{ $user->password }}" placeholder="Plh cours titre ici...">
                        @error('password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   


                      <input type="hidden" value="{{$user->id}}" name="id_user">

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
--}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter user</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                </div>
                <form action="/admin/client/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nom  </label>
                            <input name="name" class="form-control" id="exampleFormControlInput1"
                                type="text" placeholder="Nom  ici...">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Prenom </label>
                            <input name="prenom" class="form-control" id="exampleFormControlInput1"
                                type="text" placeholder="Prenom complet ici...">
                            @error('prenom')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email </label>
                            <input name="email" class="form-control" id="exampleFormControlInput1"
                                type="email" placeholder="Email ici...">
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Mot de passe </label>
                            <input name="password" class="form-control" id="exampleFormControlInput1"
                                type="password" placeholder="Mot de passe ici...">
                            @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="role">Rôle</label>
                            <select name="role" class="form-control" id="role">
                                <option value="user" {{ $client->role == 'user' ? 'selected' : '' }}>User</option> <!-- Si cette condition est vraie (c’est-à-dire que le rôle du client est “user”), alors l’expression retourne la chaîne 'selected'. Sinon (si la condition est fausse), elle retourne une chaîne vide (''). -->
                                <option value="admin" {{ $client->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Image </label>
                            <input name="image" class="form-control" id="exampleFormControlInput1"
                                type="file">

                        </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                        <button class="btn btn-outline-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>














    
@foreach ($clients as $index=> $client )
<!-- Modal modifier -->
<div class="modal fade" id="editClient{{$client->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Modifier user :<span class="text-primary"> {{  $client->name    }} </span></h5><button class="btn p-1"
        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 352 512" data-fa-i2svg="">
            <path fill="currentColor"
                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
            </path>
        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
</div>
<form action="/admin/client/update" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">

        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Nom  </label>
            <input name="name" class="form-control" id="exampleFormControlInput1"
                type="text" value="{{ $client->name }}" placeholder="Nom  ici...">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Prenom </label>
            <input name="prenom" class="form-control" id="exampleFormControlInput1"
                type="text"  value="{{ $client->prenom }}" placeholder="Prenom complet ici...">
            @error('prenom')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Mot de passe </label>
            <input name="password" class="form-control" id="exampleFormControlInput1"
                type="password" placeholder="Mot de passe ici...">
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="role">Rôle</label>
            <select name="role" class="form-control" id="role">
                <option value="user" {{ $client->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $client->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">image </label>
            <input name="image" class="form-control" id="exampleFormControlInput1"
                type="file">

        </div>
       


          <input type="hidden" value="{{$client->id}}" name="id_client">

    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Modifier</button>
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
