@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#modal-crear').modal("show");
            $('#botonContinuar').click(function(){
                $(location).attr('href','http://app-seguridad.test/visitantes');
            });
        }); 
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>
    
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('crearVisitante') }}" method="POST">
                    @csrf

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear nuevo visitante</h3>
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
                                        <label for="inputNombre">Ingrese el nombre</label>
                                        <input type="text" class="form-control" id="inputNombre" name="nombre"
                                            placeholder="Nombre" autofocus required>
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
                                        <label for="inputTelefono">Ingrese un teléfono en caso de emergencia</label>
                                        <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto"
                                            placeholder="Teléfono" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Ingrese la EPS</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_eps" required>
                                            <option selected="selected" value="" disabled>Seleccione EPS</option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Ingrese el ARL</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_arl" required>
                                            <option selected="selected" value="" disabled>Seleccione ARL</option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}">{{ $ar->arl }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type='submit' class="btn btn-primary">Crear visitante</button>
                            <button type='reset' class="btn btn-secondary">Limpiar</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </form> 
                @include('pages.formCrearVehiculo')
            </div>
            
        </div>     

        @include('pages.visitantes.modales')

    </section>
@endsection

