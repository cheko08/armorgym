<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddProductoRequest;
use App\Http\Requests\StoreDetallesRequest;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Sucursal;

class ProductoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$productos = Producto::all();
		return view('productos.index', compact('productos'));
	}

	public function scanProducto()
	{
		return view('productos.add-producto');
	}

	

	public function storeCodigo(AddProductoRequest $request)
	{
		
			return redirect('productos/store-producto/'.$request->input('codigo'));

	}

	public function storeProducto($id)
	{
		$producto = $id;
		$sucursales = Sucursal::all();
		return view('productos.add-producto-detalles', compact('producto','sucursales'));
	}

	public function storeProductoDetalles(StoreDetallesRequest $request)
	{
		$producto = Producto::create([
			'codigo' =>  $request->input('codigo')
			]);

		$producto->descripcion = $request->input('descripcion');
		$producto->precio = $request->input('precio');
		$producto->costo = 	$request->input('costo');
		$producto->save();
		return redirect('productos/scan-producto')->with('global', 'El producto ha sido registrado!');
	}

	public function edit($id)
	{
		$producto = Producto::findOrFail($id);
		$sucursales = Sucursal::all();
		return view('productos.edit', compact('producto','sucursales'));
	}

	public function update(StoreDetallesRequest $request,$id)
	{
		$producto = Producto::findOrFail($id);

		$producto->descripcion = $request->input('descripcion');
		$producto->precio = $request->input('precio');
		$producto->costo = 	$request->input('costo');
		$producto->save();
		return redirect('productos/edit/'.$producto->id)->with('global', 'El producto ha sido actualizado!');
	}
}
