@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> <h2> Sistema de asignación de materias </h2> </div>

                <div class="card-body">
                    <div class="row d-flex justify-content-center" style="">
                        <div class="col-md-4 " {{--  style="border-style: solid; border-color: red;" --}}>
                            <img src="/img/iconos/estudiantes.PNG" width="100" height="100" alt="Estudiantes" srcset=""> <br>
                            <a href="{{ route('estudiantes.index') }}" class="btn btn-success">Estudiantes</a>
                        </div>
                        <div class="col-md-4 " {{--  style="border-style: solid; border-color: red;" --}}>
                            <img src="/img/iconos/profesores.png" width="100" height="100" alt="Docentes" srcset=""><br>
                            <a href="" class="btn btn-success">Profesores</a>
                        </div>
                        <div class="col-md-4 " {{--  style="border-style: solid; border-color: red;" --}}>
                            <img src="/img/iconos/asignatura.png" width="100" height="100" alt="Asignaturas" srcset=""><br>
                            <a href="{{ route('materias.index') }}" class="btn btn-success">Asignaturas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('JavaScript')

<script>
    Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
</script>

@endsection --}}