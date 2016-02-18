<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMiembrosRequest;
use App\Http\Requests\ValidarMiembroRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Membresia;
use App\Asistencia;
use App\Sucursal;
use App\Miembro;
use App\Pago;
use DateTime;
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
		
		$fecha_proximo_pago = date('Y/m/d', strtotime($request->input('fecha_inscripcion')));

	$fecha_inscripcion = date('Y/m/d', strtotime($request->input('fecha_inscripcion')));


		$miembro = Miembro::create([
			'nombre' => $request->input('nombre'),
			'apellidos' => $request->input('apellidos'),
			'email' => $request->input('email'),
			'telefono' => $request->input('telefono'),
			'fecha_inscripcion' => $fecha_inscripcion,
			'fecha_proximo_pago' => $fecha_proximo_pago,
			'sucursal_id' => $request->input('sucursal'),
			'membresia_id' => $request->input('membresia'),
			'comentarios' => $request->input('comentarios'),
			'user_id'=> Auth::user()->id,
			'status' => 'I',
			'foto' => $foto_miembro,
			]);
		if($miembro)
		{
			return redirect('miembros/edit/'.$miembro->id)->with('global', 'El Miembro ha sido registrado!');
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

		$fecha_inscripcion = date('Y/m/d', strtotime($request->input('fecha_inscripcion')));
		
		$miembro->nombre=$request->input('nombre');
		$miembro->apellidos=$request->input('apellidos');
		$miembro->email=$request->input('email');
		$miembro->telefono=$request->input('telefono');
		$miembro->fecha_inscripcion=$fecha_inscripcion;
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

	public function updateFoto($id, Request $request)
	{
		$miembro = Miembro::findOrFail($id);
		$rawData = $request->input('foto');
		$filteredData = explode(',', $rawData);
		$unencoded = base64_decode($filteredData[1]);
		$datime = date("Y-m-d-H.i.s", time() ) ;
		$destinationPath = public_path('fotos'); 

		
		$fp = fopen($destinationPath.'/'.$datime.'-'.$id.'.jpg', 'w');
		fwrite($fp, $unencoded);
		fclose($fp);

		$miembro->foto=$datime.'-'.$id.'.jpg';
		$miembro->save();
		if($miembro)
		{
			return redirect('miembros/edit/'.$miembro->id)->with('global', 'El Miembro ha sido actualizado!');
		}
	}


	public function acceso()
	{
		return view('miembros.acceso');
	}

	public function validarAcceso(ValidarMiembroRequest $request)
	{
		$miembro = Miembro::withTrashed()->where('id',$request->input('id'))->first();
		$ultimo_pago = Pago::where('miembro_id', $miembro->id)->first();

		if($ultimo_pago)
		{
			$ultimo_pago = $ultimo_pago->fecha_pago;
		}
		else
		{
			$ultimo_pago =  $miembro->fecha_inscripcion;
		}

		if($miembro->status == 'A' && $miembro->fecha_proximo_pago >= Date('Y-m-d'))
		{	
			$acceso ='Permitido';
			$color ='success';

			$fecha_hoy =  Date('Y-m-d');

			$asistencia = Asistencia::create([
				'miembro_id'=> $miembro->id,
				'fecha_asistencia' => $fecha_hoy,
				]);
		}
		else
		{
			$acceso ='Denegado';
			$color ='danger';
		}

		return view('miembros.perfil', compact('miembro','acceso','color','ultimo_pago'));
	}


	public function destroy($id)
	{
		$miembro = Miembro::findOrFail($id);
		$miembro->status ='I';
		$miembro->save();
		$miembro->delete();
	}



}
