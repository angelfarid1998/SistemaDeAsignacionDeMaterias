@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Profesores </u> </h4> 
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
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($profesores as $profesor)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            @php 
                                $tipodoc = $profesor->tipo_documento;
                                $separador = ":";
                                $tipo_doc = explode($separador, $tipodoc);
                            @endphp                            
                            <td> {{  $tipo_doc[0] }} </td>
                            <td> {{ $profesor->documento }} </td>
                            <td> {{ $profesor->nombres }} </td>
                            <td> {{ $profesor->telefono }} </td>
                            <td> {{ $profesor->email }} </td>
                            <td> {{ $profesor->direccion }} </td>
                            <td> {{ $profesor->ciudad }} </td>
                            <td>
                                <a href="{{ url('profesores/show/'.$profesor->id) }}" title="Ver Estudiante" class="btn btn-outline-info btn-sm">
                                    <img src="/img/iconos/show.png" alt="Ver" width="15" >
                                </a>
                                <a href="{{ route('profesores.edit',$profesor->id) }}" title="Editar" class="btn btn-outline-primary btn-sm">
                                    <img src="/img/iconos/edit.png" alt="Editar" width="15" > 
                                </a>
                                <button id="eliminarObjetivo" onclick="eliminarObjetivo({{$profesor->id}})" title="Eliminar" class="btn btn-outline-danger btn-sm">
                                    <img src="/img/iconos/delete.png" alt="Eliminar" width="15">
                                </button>

                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <br>
            <div class="row">
                <div class=" offset-3 col-md-3 d-grid gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger" style="font-size: 0.8rem" > Volver </a>
                </div>
                
                <div class=" col-md-3 d-grid gap-2">
                    <a href="{{ route('profesores.create') }}" class="btn btn-outline-info " style="font-size: 0.8rem" > Agregar profesor</a>
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
                url: '/eliminarProfesor/' + id,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
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

    @if(Session::has('actualizado')){{
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
            title: 'Registro actualizado exitosamente'
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