<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['clientes']=Cliente::paginate(5);
        return view('clientes.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('clientes.create');
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
            'Nombre'=>'required|string|max:100',
            'primer_apellido'=>'required|string|max:100',
            'segundo_apellido'=>'required|string|max:100',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
         
 
        $mensaje=[
           'required'=>'El :attribute es requerido',
           'foto.required'=>'La foto es requerida'
 
        ];
        
        $this->validate($request, $campos, $mensaje);
 
 
         $datoscliente= request()->except('_token');
 
      if($request->hasFile('foto')){
          $datoscliente['foto']=$request->file('foto')->store('uploads','public');
      }
 
         Cliente::insert($datoscliente);
         //return response()->json($datosVendedor);
          return redirect('clientes')->with('mensaje','Cliente agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $clientes=Cliente::findOrFail($id);

        return view('clientes.edit', compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'primer_apellido'=>'required|string|max:100',
            'segundo_apellido'=>'required|string|max:100',
        ];
         
 
        $mensaje=[
           'required'=>'El :attribute es requerido',
        ];

        if($request->hasFile('foto')){
            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=[ 'foto.required'=>'La foto es requerida'];
        }
        
        $this->validate($request, $campos, $mensaje);

        //
        $datoscliente=request()->except(['_token','_method']);
        if($request->hasFile('foto')){
            $clientes=Cliente::findOrFail($id);
            Storage::delete('public/'.$clientes->foto);
            $datoscliente['foto']=$request->file('foto')->store('uploads','public');
        }

        
        Cliente::where('id','=', $id)->update($datoscliente);
        $clientes=Cliente::findOrFail($id);
        //return view('vendedor.edit', compact('vendedor'));

        return redirect('clientes')->with('mensaje','Cliente modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $clientes=Cliente::findOrFail($id);
        if(Storage::delete('public/'.$clientes->foto)){
            Cliente::destroy($id);
        }
        
        return redirect('clientes')->with('mensaje','Cliente Borrado');
    }
}
