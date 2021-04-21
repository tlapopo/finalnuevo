<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['productos']=Producto::paginate(5);
        return view('productos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productos.create');
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
            'Descripcion'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'Contenido'=>'required|string|max:100',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
         
 
        $mensaje=[
           'required'=>'El :attribute es requerido',
           'foto.required'=>'La foto es requerida'
 
        ];
        
        $this->validate($request, $campos, $mensaje);
 
 
         $datosProductos= request()->except('_token');
 
      if($request->hasFile('foto')){
          $datosProductos['foto']=$request->file('foto')->store('uploads','public');
      }
 
         Producto::insert($datosProductos);
         //return response()->json($datosVendedor);
          return redirect('productos')->with('mensaje','Producto agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $productos=Producto::findOrFail($id);

        return view('productos.edit', compact('productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'Contenido'=>'required|string|max:100',
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
        $datosProductos=request()->except(['_token','_method']);
        if($request->hasFile('foto')){
            $productos=Producto::findOrFail($id);
            Storage::delete('public/'.$productos->foto);
            $datosProductos['foto']=$request->file('foto')->store('uploads','public');
        }

        
        Producto::where('id','=', $id)->update($datosProductos);
        $productos=Producto::findOrFail($id);
        //return view('vendedor.edit', compact('vendedor'));

        return redirect('productos')->with('mensaje','Producto modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productos=Producto::findOrFail($id);
        if(Storage::delete('public/'.$productos->foto)){
            Producto::destroy($id);
        }
        
        return redirect('productos')->with('mensaje','Producto Eliminado');
    }
}
