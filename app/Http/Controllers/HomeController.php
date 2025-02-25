<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

      public function index()
      {
          $role = Auth::user()->role;
      
          switch ($role) {
              case 'admin':
                  return redirect('/admin/dashboard');
                  break;
              case 'user':
                  return redirect('/client/dashboard');
                  break;
              default:
                  return view('home');
                  break;
          }
     
      
        return view('home');
      }
    }

