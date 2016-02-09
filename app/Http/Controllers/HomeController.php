<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Miembro;
use DB;


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

     public function buscar(Request $request)
    {
        $first =DB::table('miembros')
        ->where('nombre','like',$request->input('miembro').'%')
        ->where('deleted_at', null);

        $second = DB::table('miembros')
        ->where('apellidos','like',$request->input('miembro').'%')
        ->where('deleted_at', null);

        $miembros = DB::table('miembros')
        ->where('id','like',$request->input('miembro').'%')
        ->where('deleted_at', null)
        ->union($first)
        ->union($second)->get();

       $miembros_activos = Miembro::where('status', 'A')->count();
         return view('buscar',compact('miembros','miembros_activos'));
    }
}
