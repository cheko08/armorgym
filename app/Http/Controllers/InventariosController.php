<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sucursal;
use App\Producto;
use App\Inventario;
use App\Http\Requests\StoreInventarioRequest;

class InventariosController extends Controller
{
    /**
     * Constructor
     */
    function __construct() 
    {
    	$this->middleware('auth');
    }
    /**
     * Show all inventories
     * @return View 
     */
    public function index()
    {
    	$inventarios =Inventario::all();
    	return view('inventarios.index', compact('inventarios'));
    }
    /**
     * Show the form to add an inventory
     * @return [type] [description]
     */
    public function create()
    {
    	$productos = Producto::all();
    	$sucursales = Sucursal::all();
    	return view('inventarios.create', compact('sucursales','productos'));
    }
    /**
     * Store the inventory on the database and redirects to index
     * @param  StoreInventarioRequest $request [infomrmation from the form]
     * @return [Redirect]
     */
    public function store(StoreInventarioRequest $request)
    {
    	if(Inventario::where('producto_id',$request->input('producto_id'))->where('sucursal_id',$request->input('sucursal_id'))->count() > 0)
    	{
    		$inventario = Inventario::where('producto_id',$request->input('producto_id'))->where('sucursal_id',$request->input('sucursal_id'))->first();
    		$inventario->cantidad =$inventario->cantidad + $request->input('cantidad');
    		$inventario->save();
    	}
    	else
    	{
    		$inventario = Inventario::create($request->all());
    	}

    	return redirect('inventarios/index')->with('global', 'Inventario Agregado');
    }
}
