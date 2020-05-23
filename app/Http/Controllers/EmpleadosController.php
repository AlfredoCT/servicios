<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleados::paginate(5);
        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        //$datosEmpleado=request()->all();

        $datosEmpleado=request()->except('_token');

        if($request->hasFile('foto')){
             $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }

        Empleados::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        return redirect('empleados')->with('Mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        $datosEmpleado=request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $empleado = Empleados::findOrFail($id);
            Storage::delete(['public/'.$empleado->foto]);
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');
        }

        Empleados::where('id','=',$id)->update($datosEmpleado);

        //$empleado = Empleados::findOrFail($id);
        //return view('empleados.edit', compact('empleado'));

        return redirect('empleados')->with('Mensaje','Empleado actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleados::findOrFail($id);
        if (Storage::delete(['public/'.$empleado->foto])){
            Empleados::destroy($id);
        }

        return redirect('empleados')->with('Mensaje','Empleado eliminado con exito');
    }
}
