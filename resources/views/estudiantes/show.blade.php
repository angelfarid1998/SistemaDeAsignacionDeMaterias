@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Ver estudiante </u> </h4> 
                </div>

                <div class="card-body">
                    <h4> <u> Datos personales </u> </h4>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="">Tipo de documento</label>
                            <select name="tipo_documento" class="form-control" name="" id="" disabled>
                                <option value="">Seleccione...</option>
                                <option {{ $estudiante->tipo_documento == $estudiante->tipo_documento ? 'selected' : '' }}> {{ $estudiante->tipo_documento }} </option>
                                <option {{ $estudiante->tipo_documento == $estudiante->tipo_documento ? 'selected' : '' }}> {{ $estudiante->tipo_documento }} </option>
                                <option {{ $estudiante->tipo_documento == $estudiante->tipo_documento ? 'selected' : '' }}> {{ $estudiante->tipo_documento }} </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">N° documento</label>
                            <input value="{{ $estudiante->documento }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Nombre completo</label>
                            <input value="{{ $estudiante->nombres }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Telefono</label>
                            <input value="{{ $estudiante->telefono }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Email</label>
                            <input value="{{ $estudiante->email }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Dirección</label>
                            <input value="{{ $estudiante->direccion }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Ciudad</label>
                            <input value="{{ $estudiante->ciudad }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Semestre</label>
                            <input value="{{ $estudiante->semestre }}" class="form-control" disabled>
                        </div>
                    </div>
                    <br>
                    <h4> <u> Materias asignadas </u> </h4>
                    <table id="" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Creditos</th>
                            <th scope="col">Area</th>
                            <th scope="col">Tipo</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($materiaAsignadas as $materiaAsignada)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>                           
                                    <td> {{ $materiaAsignada->nombre}} </td>
                                    <td> {{ $materiaAsignada->descripcion}} </td>
                                    <td> {{ $materiaAsignada->creditos}} </td>
                                    <td> {{ $materiaAsignada->area}} </td>
                                    <td> {{ $materiaAsignada->tipo}} </td>
                                </tr>
                            @endforeach 
                        </tbody>
                            
                    </table>
                    
                    <br>

                    <h4> <u> Materias totales </u> </h4>
                    <form action="{{ route('estudiantes.AsignarMaterias') }}" class="d-inline" method="post">
                        @csrf
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Creditos</th>
                                <th scope="col">Area</th>
                                <th scope="col">Tipo</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>

                                <tbody>
                                    @foreach($materias as $materia)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>                           
                                            <td> {{ $materia->nombre }} </td>
                                            <td> {{ $materia->descripcion }} </td>
                                            <td> {{ $materia->creditos }} </td>
                                            <td> {{ $materia->area }} </td>
                                            <td> {{ $materia->tipo }} </td>
                                            <td>
                                                <input type="hidden" value="{{ $estudiante->id }}" name="estudiante_id" id="estudiante_id">
                                                <input type="checkbox" name="materia_id[]" id="asignada" value="{{ $materia->id }}">                                        
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                        </table> 
                        <div class="row">
                            <div class=" offset-3 col-md-3 d-grid gap-2">
                                <a href="{{ route('estudiantes.index') }}" class="btn btn-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
                            </div>
                            
                            <div class=" col-md-3 d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg" style="font-size: 0.8rem" > Guardar </button>
                        </div>
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('JavaScript')
<script type="text/javascript">
    function valideKey(evt){
        
        // code is the decimal ASCII representation of the pressed key.
        var code = (evt.which) ? evt.which : evt.keyCode;
        
        if(code==8) { // backspace.
          return true;
        } else if(code>=48 && code<=57) { // is a number.
          return true;
        } else{ // other keys.
          return false;
        }
    }
    </script> 

    {{-- <script>
        var selected = new Array();
        
        $(document).ready(function() {
        
        $("input:checkbox:checked").each(function() {
            alert($(this).val());
        });
        
        });
    </script> --}}

    @if(Session::has('guardado')){{
        Session::get('') 
    }}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Registro guardado exitosamente'
        })
    </script>    

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    @endif

    @if(Session::has('duplicado')){{
        Session::get('') 
    }}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: 'Verifique la informacion, hay datos duplicados'
        })
    </script>    

    <script>
        $(document).ready( function () {
            $('#myTable1').DataTable();
        } );
    </script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    @endif


@endsection