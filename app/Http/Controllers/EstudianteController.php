<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();

        return view('estudiantes.index', ['estudiantes' => $estudiantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estudiantes.create');
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
            'ciudad' => 'required',
            'semestre' => 'required',
        ]);

        $documento = $request->documento;
        $tipo_documento = $request->tipo_documento;

        $docrep = Estudiante::where('documento', $request->documento)->get();
        $emailrep = Estudiante::where('email', $request->email)->get();


        // return response()->json($documentos);
        $mensajedoc = "El N° de documento ya esta registrado";
        $mensajeemail = "El email ya esta registrado";

        if (count($docrep) == 1 or count($emailrep) == 1) {

            Session::flash('duplicado');
            return back();
        } else {

            $estudiante = new Estudiante();

            $estudiante->tipo_documento = $request->tipo_documento;
            $estudiante->documento      = $request->documento;
            $estudiante->nombres        = $request->nombres;
            $estudiante->telefono       = $request->telefono;
            $estudiante->email          = $request->email;
            $estudiante->direccion      = $request->direccion;
            $estudiante->ciudad         = $request->ciudad;
            $estudiante->semestre       = $request->semestre;
            $estudiante->save();

            $estudiantes = Estudiante::all();
            Session::flash('guardado');
            return view('estudiantes.index', ['estudiantes' => $estudiantes]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante, $id)
    {
        $estudiante = Estudiante::where('id', $id)->first();

        $materiaAsignadas = Asignatura::whereIn('id', json_decode($estudiante->materia_id))->get();

        // return response()->json($materiaAsignadas);

        $materias = Asignatura::all();

        return view('estudiantes.show', ['estudiante' => $estudiante, 'materias' => $materias, 'materiaAsignadas' => $materiaAsignadas]);
    }

    public function AsignarMaterias(Request $request)
    {
        $materia_id = $request->materia_id;

        $ids = [];
        foreach ($materia_id as $key => $value) {
            $id = intval($value);

            array_push($ids, $id);
        }

        $estudiante = Estudiante::find($request->estudiante_id);
        $estudiante->materia_id = json_encode($ids);
        $estudiante->save();
        
        Session::flash('guardado');
        return redirect()->route('estudiantes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Estudiante $estudiante, $id)
    // {
    //     $estudiante = Estudiante::findOrfail($id);
    //     Estudiante::destroy($estudiante);
    //     Session::flash('eliminado');
    //     return redirect()->route('estudiantes.index')->with('success', 'Student Data deleted successfully');

    // }

    public function eliminarObjetivo($id)
    {
        // delete
        $estudiante = Estudiante::find($id);
        $estudiante->delete();
        return response()->json([
            'message' => 'Estudiante Eliminado'
        ]);
    }
}
