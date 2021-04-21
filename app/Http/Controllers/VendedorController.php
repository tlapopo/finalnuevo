<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['vendedor']=Vendedor::paginate(5);
        return view('vendedor.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vendedor.create');
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
        //$datosVendedor= request()->all();

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


        $datosVendedor= request()->except('_token');

     if($request->hasFile('foto')){
         $datosVendedor['foto']=$request->file('foto')->store('uploads','public');
     }

        Vendedor::insert($datosVendedor);
        //return response()->json($datosVendedor);
         return redirect('vendedor')->with('mensaje','Vendedor agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        //
        $vendedor=Vendedor::findOrFail($id);

        return view('vendedor.edit', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
        $datosVendedor=request()->except(['_token','_method']);
        if($request->hasFile('foto')){
            $vendedor=Vendedor::findOrFail($id);
            Storage::delete('public/'.$vendedor->foto);
            $datosVendedor['foto']=$request->file('foto')->store('uploads','public');
        }

        
        Vendedor::where('id','=', $id)->update($datosVendedor);
        $vendedor=Vendedor::findOrFail($id);
        //return view('vendedor.edit', compact('vendedor'));

        return redirect('vendedor')->with('mensaje','Vendedor modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vendedor=Vendedor::findOrFail($id);
        if(Storage::delete('public/'.$vendedor->foto)){
            Vendedor::destroy($id);
        }
        
        return redirect('vendedor')->with('mensaje','Vendedor Borrado');
    }
}
