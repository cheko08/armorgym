<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMembresiaRequest;
use App\Http\Requests\UpdateMembresiaRequest;
use App\Membresia;

class MembresiaController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$membresias = Membresia::paginate(10);

		return view('membresias.index', compact('membresias'));
	}

	public function create()
	{
		return view('membresias.create');
	}

	public function store(CreateMembresiaRequest $request)
	{
		$membresia = Membresia::create($request->all());
		$membresia->status = 'A';
		$membresia->save();

		if($membresia)
		{
			 return redirect('/membresias')->with('global', 'La membresía ha sido guardada!');
		}
	}

	public function edit($id)
	{
		$membresia = Membresia::findOrFail($id);

		return view('membresias.edit', compact('membresia'));
	}

	public function update($id, UpdateMembresiaRequest $request)
	{
		$membresia = Membresia::findOrFail($id);
		$membresia->nombre = $request->input('nombre');
		$membresia->precio_mensual = $request->input('precio_mensual');
		$membresia->inscripcion = $request->input('inscripcion');
		$membresia->descripcion = $request->input('descripcion');
		$membresia->save();
		if($membresia)
		{
			 return redirect('/membresias/edit/'.$membresia->id)->with('global', 'La membresía ha sido actualziada!');
		}
	}

	public function destroy($id)
	{
		$membresia = Membresia::findOrFail($id);
		$membresia->delete();
	}
}
