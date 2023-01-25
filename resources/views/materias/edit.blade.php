@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Editar asignatura </u> </h4> 
                </div>

                <form action="{{ route('materias.update', $materia->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="">Nombre</label>
                                <input name="nombre" type="text" value="{{ $materia->nombre }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Descripcion</label>
                                <input name="descripcion" type="text" value="{{ $materia->descripcion }}" class="form-control" minlength="10" maxlength="10" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Creditos</label>
                                <input name="creditos" type="text" value="{{ $materia->creditos }}" class="form-control" maxlength="2" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tipo</label>
                                <select name="tipo" class="form-control" name="" id="" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Electiva"    {{ $materia->tipo == 'Electiva' ? 'selected' : '' }}> Electiva </option>
                                    <option value="Obligatoria" {{ $materia->tipo == 'Obligatoria' ? 'selected' : '' }}> Obligatoria </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Area de conocimiento</label>
                                <input name="area" type="text" value="{{ $materia->area }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Profesor</label>
                                <select name="profesor_id" class="form-control" id="" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($profesores as $profesor) 

                                        <option value="{{ $profesor->id }}" {{ $profesor->id == $materia->profesor_id ? 'selected' : '' }}>{{ $profesor->nombres }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class=" offset-3 col-md-3 d-grid gap-2">
                            <a href="{{ route('materias.index') }}" class="btn btn-outline-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
                        </div>
                        
                        <div class=" col-md-3 d-grid gap-2">
                            <button type="submit" class="btn btn-outline-success btn-lg" style="font-size: 0.8rem" > Guardar </button>
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

    @if(Session::has('duplicado')){{
        Session::get('') 
    }}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: 'Verifique la informacion, ya existe un registro con ese nombre.'
        })
    </script>    

    @endif

@endsection