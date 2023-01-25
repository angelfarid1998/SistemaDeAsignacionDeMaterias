<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Asignatura::all();

        return view('materias.index', ['materias' => $materias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profesores = Profesor::all();

        return view('materias.create', ['profesores' => $profesores]);
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
            'nombre' => 'required',
            'descripcion' => 'required',
            'creditos' => 'required',
            'area' => 'required',
            'tipo' => 'required',
            'profesor_id' => 'required'
        ]);

        $nombre = $request->nombre;

        $nombrerep = Asignatura::where('nombre', 'like', "%" . $nombre . "%")->get();

        if (count($nombrerep) == 1) {
            Session::flash('duplicado');
            return back();
        } else {

            $materia = new Asignatura();

            $materia->nombre       = $request->nombre;
            $materia->descripcion  = $request->descripcion;
            $materia->creditos     = $request->creditos;
            $materia->area         = $request->area;
            $materia->tipo         = $request->tipo;
            $materia->profesor_id  = $request->profesor_id;
            $materia->save();

            Session::flash('guardado');
            return redirect()->route('materias.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura, $id)
    {
        $profesores = Profesor::all();
        $materia = Asignatura::where('id', $id)->first();
        return view('materias.edit', ['materia' => $materia, 'profesores' => $profesores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return response()->json($request);
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'creditos' => 'required',
            'area' => 'required',
            'tipo' => 'required',
            'profesor_id' => 'required'
        ]);

        $nombre = $request->nombre;

        $nombrerep = Asignatura::where('nombre', 'like', "%" . $nombre . "%")->get();
        if (count($nombrerep) > 1) {
            Session::flash('duplicado');
            return back();
        } else {

            $datosMateria = request()->except(['_token', '_method']);

            Asignatura::where('id', '=', $id)->update($datosMateria);
            Session::flash('actualizado');
            return redirect()->route('materias.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignatura $materias)
    {
    }

    public function eliminarObjetivo($id)
    {
        // delete
        $materia = Asignatura::find($id);
        $materia->delete();
        return response()->json([
            'message' => 'Articulo Eliminado'
        ]);
    }
}
