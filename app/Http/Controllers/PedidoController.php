<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['pedidos']=Pedido::paginate(5);
        return view('pedidos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('pedidos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $campos=[
            'fecha_pedido'=>'required|date|max:100',
            'estado_pedido'=>'required|string|max:100',
            'fecha_envio'=>'required|date|max:100',
            'cliente_id'=>'required|integer|max:100',
            'vendedor_id'=>'required|integer|max:10000',
        ];
         
 
        $mensaje=[
           'required'=>'El :attribute es requerido',
           
        ];
        
        $this->validate($request, $campos, $mensaje);
 
 
         $datosPedidos= request()->except('_token');
 
     
 
         Pedido::insert($datosPedidos);
         //return response()->json($datosVendedor);
          return redirect('pedidos')->with('mensaje','Pedido agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pedidos=Pedido::findOrFail($id);

        return view('pedidos.edit', compact('pedidos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'fecha_pedido'=>'required|date|max:100',
            'estado_pedido'=>'required|string|max:100',
            'fecha_envio'=>'required|date|max:100',
            'cliente_id'=>'required|integer|max:100',
            'vendedor_id'=>'required|integer|max:10000',
        ];
         
 
        $mensaje=[
           'required'=>'El :attribute es requerido',
        ];

        
        $this->validate($request, $campos, $mensaje);

        //
        $datosPedidos=request()->except(['_token','_method']);
       

        
        Pedido::where('id','=', $id)->update($datosPedidos);
        $pedidos=Pedido::findOrFail($id);
        //return view('vendedor.edit', compact('vendedor'));

        return redirect('pedidos')->with('mensaje','Pedido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pedidos=Pedido::findOrFail($id);
        Pedido::destroy($id);
        
        return redirect('pedidos')->with('mensaje','Pedido Eliminado');

    }
}
