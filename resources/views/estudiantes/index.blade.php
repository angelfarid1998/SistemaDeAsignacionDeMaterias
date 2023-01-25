@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Estudiantes </u> </h4> 
                </div>

                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo doc</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            @php 
                                $tipodoc = $estudiante->tipo_documento;
                                $separador = ":";
                                $tipo_doc = explode($separador, $tipodoc);
                            @endphp                            
                            <td> {{  $tipo_doc[0] }} </td>
                            <td> {{ $estudiante->documento }} </td>
                            <td> {{ $estudiante->nombres }} </td>
                            <td> {{ $estudiante->telefono }} </td>
                            <td> {{ $estudiante->email }} </td>
                            <td> {{ $estudiante->direccion }} </td>
                            <td> {{ $estudiante->ciudad }} </td>
                            <td> {{ $estudiante->semestre }} </td>
                            <td>
                                <a href="{{ url('estudiantes/show/'.$estudiante->id) }}" class="btn btn-info btn-sm">
                                    Ver 
                                </a>
                                | 
                                <a href="{{ url('estudiantes/'.$estudiante->id.'/edit') }}" class="btn btn-primary btn-sm">
                                    Editar 
                                </a>
                                |
                                 
                                {{-- <form action="{{ url('estudiantes/'.$estudiante->id) }}" class="d-inline" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" onclick="return confirm('quieres borrar?')" class="btn btn-danger btn-sm" value="borrar"> 
                                </form> --}}
                                {{-- <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$estudiante->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEstudiante">Eliminar</a> --}}
                                <button id="eliminarObjetivo" onclick="eliminarObjetivo({{$estudiante->id}})" class="btn btn-danger btn-sm">Eliminar</button>

                            </td>
                        </tr>
                        @endforeach
                  </table>
                  
                </div>
                <br>
                <div class="row">
                    <div class=" offset-3 col-md-3 d-grid gap-2">
                        <a href="{{ route('home') }}" class="btn btn-danger" style="font-size: 0.8rem" > Volver </a>
                    </div>
                    
                    <div class=" col-md-3 d-grid gap-2">
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-info " style="font-size: 0.8rem" > Agregar estudiante</a>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('JavaScript')

    <script>
        function eliminarObjetivo(id) {
            $.ajax({
                url: '/eliminarEstudiante/' + id,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Perfecto, se eliminó correctamente',
                        showConfirmButton: false,
                        timer: 3000,
                    }),
                    
                    $(document).ready(function () {
                    setTimeout(function () {
                        // alert('Reloading Page');
                        location.reload(true);
                    }, 3000);
                    });
                    

                }
            });
        }
    </script>


    @if(Session::has('eliminado')){{
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
        title: 'Registro eliminado exitosamente'
        })
    </script>    

    @endif

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

@endsection