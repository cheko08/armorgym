<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sucursal;
use App\Http\Requests\CreateSucursalRequest;

class SucursalController extends Controller
{
	 public function __construct()
	{
		$this->middleware('auth');
	}


    public function index()
    {
    	$sucursales = Sucursal::paginate(10);

    	 return view('sucursales.index', compact('sucursales'));
    }

    public function create()
	{
		return view('sucursales.create');
	}

	public function store(CreateSucursalRequest $request)
	{
		$sucursal = Sucursal::create($request->all());

		if($sucursal)
		{
			 return redirect('/sucursales')->with('global', 'La Sucursal ha sido guardada!');
		}
	}

	public function edit($id)
	{
		$sucursal = Sucursal::findOrFail($id);

		return view('sucursales.edit', compact('sucursal'));
	}

	public function update($id, CreateSucursalRequest $request)
	{
		$sucursal = Sucursal::findOrFail($id);
		$sucursal->nombre = $request->input('nombre');
		$sucursal->direccion = $request->input('direccion');
		$sucursal->telefono = $request->input('telefono');
		$sucursal->save();
		if($sucursal)
		{
			 return redirect('sucursales/edit/'.$sucursal->id)->with('global', 'La Sucursal ha sido actualizada!');
		}
	}
}
