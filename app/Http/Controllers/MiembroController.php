<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMiembrosRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Membresia;
use App\Sucursal;
use App\Miembro;
use Auth;


class MiembroController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create()
	{
		$sucursales = Sucursal::all();
		$membresias = Membresia::all();
		return view('miembros.create',compact('sucursales','membresias'));
	}

	public function store(RegistrarMiembrosRequest $request)
	{
		$foto_miembro='avatar.jpg';

		if($request->hasFile('foto'))
		{
			if($request->file('foto')->isValid())
			{
				$foto = $request->file('foto')->getClientOriginalName();
				$destinationPath = public_path('fotos');
				$request->file('foto')->move($destinationPath,$foto);
				$foto_miembro= $foto;
			}
		}


		$miembro = Miembro::create([
			'nombre' => $request->input('nombre'),
			'apellidos' => $request->input('apellidos'),
			'email' => $request->input('email'),
			'telefono' => $request->input('telefono'),
			'sucursal_id' => $request->input('sucursal'),
			'membresia_id' => $request->input('membresia'),
			'comentarios' => $request->input('comentarios'),
			'user_id'=> Auth::user()->id,
			'status' => 'A',
			'foto' => $foto_miembro,
			]);
		if($miembro)
		{
			 return redirect('/home')->with('global', 'El Miembro ha sido registrado!');
		}
	}

	public function edit($id)
	{
		$miembro = Miembro::findOrFail($id);
		$sucursales = Sucursal::all();
		$membresias = Membresia::all();

		return view('miembros.edit',compact('miembro','sucursales','membresias'));
	}

	public function update($id, RegistrarMiembrosRequest $request)
	{
		$miembro = Miembro::findOrFail($id);

		$foto_miembro=$miembro->foto;

		if($request->hasFile('foto'))
		{
			if($request->file('foto')->isValid())
			{
				$foto = $request->file('foto')->getClientOriginalName();
				$destinationPath = public_path('fotos');
				$request->file('foto')->move($destinationPath,$foto);
				$foto_miembro= $foto;
			}
		}
		
		$miembro->nombre=$request->input('nombre');
		$miembro->apellidos=$request->input('apellidos');
		$miembro->email=$request->input('email');
		$miembro->telefono=$request->input('telefono');
		$miembro->sucursal_id=$request->input('sucursal');
		$miembro->membresia_id=$request->input('membresia');
		$miembro->comentarios=$request->input('comentarios');
		$miembro->user_id=Auth::user()->id;
		$miembro->foto=$foto_miembro;
		$miembro->save();
		if($miembro)
		{
			 return redirect('miembros/edit/'.$miembro->id)->with('global', 'El Miembro ha sido actualizado!');
		}
	}


}
