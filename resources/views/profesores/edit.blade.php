@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de asignación de materias </h2> <br>
                    <h4> <u> Editar profesor </u> </h4> 
                </div>

                <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="">Tipo de documento</label>
                                <select name="tipo_documento" class="form-control" name="" id="" required>
                                    <option value="">Seleccione...</option>
                                    <option value="CC:Cedula de Ciudadania"  {{ $profesor->tipo_documento == 'CC:Cedula de Ciudadania' ? 'selected' : '' }}> CC:Cedula de Ciudadania </option>
                                    <option value="CE:Cedula de Extrangeria" {{ $profesor->tipo_documento == 'CE:Cedula de Extrangeria' ? 'selected' : '' }}> CE:Cedula de Extrangeria </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">N° documento</label>
                                <input name="documento" type="text" value="{{ $profesor->documento }}" class="form-control" minlength="10" maxlength="10" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre completo</label>
                                <input name="nombres" type="text" value="{{ $profesor->nombres }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Telefono</label>
                                <input name="telefono" type="text" value="{{ $profesor->telefono }}" class="form-control" minlength="7" maxlength="10" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input name="email" type="email" value="{{ $profesor->email }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Dirección</label>
                                <input name="direccion" type="text" value="{{ $profesor->direccion }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Ciudad</label>
                                <input name="ciudad" type="text" value="{{ $profesor->ciudad }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class=" offset-3 col-md-3 d-grid gap-2">
                            <a href="{{ route('profesores.index') }}" class="btn btn-outline-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
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

    @endif

@endsection