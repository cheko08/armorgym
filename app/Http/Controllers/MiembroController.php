<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMiembrosRequest;
use App\Http\Requests\ValidarMiembroRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Membresia;
use App\Sucursal;
use App\Miembro;
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


		$monthToAdd = 1;

		$d1 = DateTime::createFromFormat('Y-m-d', $request->input('fecha_inscripcion'));

		$year = $d1->format('Y');
		$month = $d1->format('n');
		$day = $d1->format('d');

		$year += floor($monthToAdd/12);
		$monthToAdd = $monthToAdd%12;
		$month += $monthToAdd;
		if($month > 12) {
			$year ++;
			$month = $month % 12;
			if($month === 0)
				$month = 12;
		}

		if(!checkdate($month, $day, $year)) {
			$d2 = DateTime::createFromFormat('Y-n-j', $year.'-'.$month.'-1');
			$d2->modify('last day of');
		}else {
			$d2 = DateTime::createFromFormat('Y-n-d', $year.'-'.$month.'-'.$day);
		}
		
		$fecha_proximo_pago = $d2->format('Y-m-d');
	

		$miembro = Miembro::create([
			'nombre' => $request->input('nombre'),
			'apellidos' => $request->input('apellidos'),
			'email' => $request->input('email'),
			'telefono' => $request->input('telefono'),
			'fecha_inscripcion' => $request->input('fecha_inscripcion'),
			'fecha_proximo_pago' => $fecha_proximo_pago,
			'sucursal_id' => $request->input('sucursal'),
			'membresia_id' => $request->input('membresia'),
			'comentarios' => $request->input('comentarios'),
			'user_id'=> Auth::user()->id,
			'status' => 'A',
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

		if($miembro->status == 'A')
		{	
			$acceso ='Permitido';
			$color ='success';
		}
		else
		{
			$acceso ='Denegado';
			$color ='danger';
		}

		return view('miembros.perfil', compact('miembro','acceso','color'));
	}


	public function destroy($id)
	{
		$miembro = Miembro::findOrFail($id);
		$miembro->status ='I';
		$miembro->save();
		$miembro->delete();
	}



}
