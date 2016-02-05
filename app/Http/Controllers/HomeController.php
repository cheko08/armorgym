<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Miembro;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function panelDeControl()
    {
       $miembros_activos = Miembro::where('status', 'A')->count();
       $miembros = Miembro::paginate(20);
        return view('home',compact('miembros','miembros_activos'));
    }
}
