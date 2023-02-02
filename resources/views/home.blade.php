@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> <h2> Sistema de asignación de materias </h2> </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 iconhome">
                            <img src="/img/iconos/estudiantes.PNG" width="100" height="100" alt="Estudiantes" srcset=""> <br>
                            <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-success">Estudiantes</a>
                        </div>
                        <div class="col-md-4 iconhome">
                            <img src="/img/iconos/profesores.png" width="100" height="100" alt="Docentes" srcset=""><br>
                            <a href="{{ route('profesores.index') }}" class="btn btn-outline-success">Profesores</a>
                        </div>
                        <div class="col-md-4 iconhome">
                            <img src="/img/iconos/asignatura.png" width="100" height="100" alt="Asignaturas" srcset=""><br>
                            <a href="{{ route('materias.index') }}" class="btn btn-outline-success">Asignaturas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 

    justify-content: center;
        align-items: center;
    
--}}

{{-- @section('JavaScript')

<script>
    Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
</script>

@endsection --}}