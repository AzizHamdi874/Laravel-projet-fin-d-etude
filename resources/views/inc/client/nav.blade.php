@php
    use Illuminate\Support\Facades\Auth;
@endphp



<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo" style="background-color: green;"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false"
            aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3"
            href="index.html">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center"> <a href="/client/dashboard"><img
                        src="{{ asset('dashassets/img/icons/amen_logo.png') }}" alt="phoenix" width="95"></a>
                </div>
            </div>
        </a></div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">
            <li class="nav-item dropdown"><a class="nav-link lh-1 px-0 ms-5" id="navbarDropdownUser"
                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-l"><img class="rounded-circle" src="{{ asset('uploads') }}/{{ auth()->user()->image }}"
                            alt=""></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0 dropdown-profile shadow border border-300"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card bg-white position-relative border-0">
                        <div class="card-body p-0 overflow-auto scrollbar" style="height: 10rem;">
                            @auth
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl"><img class="rounded-circle" src="{{ asset('uploads') }}/{{ auth()->user()->image }}" alt=""></div>
                                <h6 class="mt-2">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</h6>
                            </div>
                            @endauth
                            
                           
                            <ul class="nav d-flex flex-column mb-2 pb-1">

                                <li class="nav-item"><a class="nav-link px-3" href="/client/compte"><span
                                            class="me-2 text-900" data-feather="user"></span>Espace compte</a>
                                </li>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top">

                            
                            <div class="px-3"><a onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                                    class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                    href="#!"><span class="me-2"
                                        data-feather="log-out"></span>Déconnexion</a>
                                      
                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                  @csrf
                                               </form>
                                      </div>
                            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                    href="#!">Privacy policy</a>&bull;<a class="text-600 mx-1"
                                    href="#!">Terms</a>&bull;<a class="text-600 ms-1"
                                    href="#!">Cookies</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>