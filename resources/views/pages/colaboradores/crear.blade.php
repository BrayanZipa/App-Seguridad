@extends('themes.lte.layout')

@section('titulo')
    Colaboradores
@endsection

@section('css')
@endsection

@section('scripts')
    <script>
        $(function() {

            $('#inputCodigo').change(function() { 
                $.ajax({
                    url: '/colaboradores/personas',
                    type: 'GET',
                    data: {
                        tipoPersona: $('#inputCodigo option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        $.each(response.data, function(key, value){                   
                            $('#selectPersona').append("<option value='" + value.id_personas + "'> C.C. " + value.identificacion + " - " + value.nombre + " " + value.apellido + "</option>");
                        });                                                 
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos');
                    }
                }); 
            }); 

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('crearColaborador') }}" method="POST">
                    @csrf

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear nuevo colaborador</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputCodigo">Ingrese el activo</label>
                                        <select name="codigo" id="inputCodigo">
                                            <option selected="selected" value="" disabled>Seleccione el tipo de persona</option>
                                            @foreach ($array as $usuario)
                                                <option value="{{ $usuario['users_id'] }}" {{ $usuario['users_id'] == old('codigo') ? 'selected' : '' }}>{{ $usuario['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNombre">Ingrese el nombre</label>
                                        <input type="text" class="form-control" id="inputNombre" name="nombre"
                                            placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputApellido">Ingrese el apellido</label>
                                        <input type="text" class="form-control" id="inputApellido" name="apellido"
                                            placeholder="Apellido" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Ingrese la identificación</label>
                                        <input type="text" class="form-control" id="inputIdentificacion"
                                            name="identificacion" placeholder="Identificación" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputTelefono">Ingrese el teléfono</label>
                                        <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto"
                                            placeholder="Teléfono" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="selectEps">Ingrese la EPS</label>
                                        <select id="selectEps" class="form-control select2" style="width: 100%;" name="id_eps" required>
                                            <option selected="selected" value="" disabled>Seleccione EPS</option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="selectArl">Ingrese el ARL</label>
                                        <select id="selectArl" class="form-control select2" style="width: 100%;" name="id_arl" required>
                                            <option selected="selected" value="" disabled>Seleccione ARL</option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}">{{ $ar->arl }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="selectEmpresa">Ingrese la empresa de vinculación</label>
                                        <select id="selectEmpresa" class="form-control select2" style="width: 100%;" name="id_empresa"
                                            required>
                                            <option selected="selected" value="" disabled>Seleccione la empresa</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id_empresas }}">{{ $empresa->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type='submit' class="btn btn-primary">Crear colaborador</button>
                            <button type='reset' class="btn btn-secondary">Limpiar</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </form>

            </div>
        </div>
    </section>
@endsection