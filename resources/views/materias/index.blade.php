@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Materias </u> </h4> 
                </div>
                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Creditos</th>
                        <th scope="col">Area</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Acciones</th>
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
                                <a href="{{ route('materias.edit', $materia->id) }}" title="Editar" class="btn btn-outline-primary btn-sm">
                                    <img src="/img/iconos/edit.png" alt="Editar" width="15" > 
                                </a>
                                <button id="eliminarObjetivo" onclick="eliminarObjetivo({{$materia->id}})" title="Eliminar" class="btn btn-outline-danger btn-sm">
                                    <img src="/img/iconos/delete.png" alt="Eliminar" width="15">
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
            <br>
            <div class="row">
                <div class=" offset-3 col-md-3 d-grid gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger" style="font-size: 0.8rem" > Volver </a>
                </div>                
                <div class=" col-md-3 d-grid gap-2">
                    <a href="{{ route('materias.create') }}" class="btn btn-outline-info font" style="font-size: 0.8rem" > Agregar materia</a>
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
                url: '/eliminarMateria/' + id,
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
                        window.location.reload(true);
                    }, 3000);
                    });
                    // $("#table_refresh").load(" #table_refresh");
                }
            });
        }
    </script>

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

    @endif

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


@endsection