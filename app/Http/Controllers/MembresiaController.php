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
	/**
	 * Constructor
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Show all membresias
	 * @return [type] [description]
	 */
	public function index()
	{
		$membresias = Membresia::paginate(10);

		return view('membresias.index', compact('membresias'));
	}
	/**
	 * Show the form to create a membresia
	 * @return [type] [description]
	 */
	public function create()
	{
		return view('membresias.create');
	}
	/**
	 * Store the membresia
	 * @param  CreateMembresiaRequest $request [Information from the form]
	 * @return [Redirect to index]               
	 */
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
	/**
	 * Show the form to edit a membresia
	 * @param  Integer $id [ID of the membresia]
	 * @return View 
	 */
	public function edit($id)
	{
		$membresia = Membresia::findOrFail($id);

		return view('membresias.edit', compact('membresia'));
	}
	/**
	 * Update the membresia in the Database
	 * @param  Integer                 $id      Membresia ID
	 * @param  UpdateMembresiaRequest $request 
	 * @return Reditect to edit
	 */
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
	/**
	 * Delete membrsia
	 * @param  Integer $id Membresia ID
	 * @return Null     
	 */
	public function destroy($id)
	{
		$membresia = Membresia::findOrFail($id);
		$membresia->delete();
	}
}
