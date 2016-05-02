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
    /**
     * Show members
     * @return view count for active and all members
     */
    public function panelDeControl()
    {
        $miembros_activos = Miembro::where('status', 'A')->count();
        $miembros = Miembro::orderBy('updated_at', 'desc')->paginate(20);
        return view('home',compact('miembros','miembros_activos'));
    }
    /**
     * Show search results
     * @param  Request $request 
     * @return View Results of the search
     */
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
