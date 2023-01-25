<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::all();

        return view('profesores.index', ['profesores' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('profesores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required',
            'tipo_documento' => 'required',
            'nombres' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required'
        ]);

        $documento = $request->documento;
        $tipo_documento = $request->tipo_documento;

        $docrep = Profesor::where('documento', $request->documento)->get();
        $emailrep = Profesor::where('email', $request->email)->get();

        $mensajedoc = "El N° de documento ya esta registrado";
        $mensajeemail = "El email ya esta registrado";

        if (count($docrep) == 1 or count($emailrep) == 1) {

            Session::flash('duplicado');
            return back();
        } else {

            $profesor = new Profesor();

            $profesor->tipo_documento = $request->tipo_documento;
            $profesor->documento      = $request->documento;
            $profesor->nombres        = $request->nombres;
            $profesor->telefono       = $request->telefono;
            $profesor->email          = $request->email;
            $profesor->direccion      = $request->direccion;
            $profesor->ciudad         = $request->ciudad;
            $profesor->save();

            // $profesores = Profesor::all();
            Session::flash('guardado');
            return redirect()->route('profesores.index');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor, $id)
    {
        $profesor = Profesor::where('id', $id)->first();

        $materiaAsignadas = Asignatura::where('profesor_id', $id)->get();
        // return response()->json(gettype($materiaAsignadas->nombre));



        $materias = Asignatura::all();

        return view('profesores.show', ['profesor' => $profesor, 'materias' => $materias, 'materiaAsignadas'=>$materiaAsignadas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor, $id)
    {
        $profesor = Profesor::where('id', $id)->first();
        return view('profesores.edit',['profesor'=>$profesor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'documento' => 'required',
            'tipo_documento' => 'required',
            'nombres' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        $datosEstudiante = request()->except(['_token', '_method']);

        $docrep = Profesor::where('documento', $request->documento)->get();
        $emailrep = Profesor::where('email', $request->email)->get();

        if (count($docrep) > 1 or count($emailrep) > 1) {

            Session::flash('duplicado');
            return back();
        } else {
            $datosEstudiante = request()->except(['_token', '_method']);

            Profesor::where('id', '=', $id)->update($datosEstudiante);

            Session::flash('actualizado');
            return redirect()->route('profesores.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor)
    {
        //
    }

    public function eliminarObjetivo($id)
    {
        // delete
        $profesor = Profesor::find($id);
        $profesor->delete();
        return response()->json([
            'message' => 'Profesor Eliminado'
        ]);
    }

}
