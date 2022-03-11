<form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST">
    @csrf

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear nuevo visitante</h3>
            <div class="card-tools">
                <button id="botonComprimirVisitante" type="button" class="btn btn-tool"
                    data-card-widget="collapse"><i class="fas fa-minus"></i>
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
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <label for="checkVehiculo">
                                ¿El visitante ingresa vehículo?
                            </label>
                            <input type="checkbox" id="checkVehiculo">
                        </div><br>
                        <div class="icheck-primary d-inline">
                            <label for="checkActivo">
                                ¿El visitante ingresa portátil?
                            </label>
                            <input type="checkbox" id="checkActivo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button id="botonCrear" type='submit' class="btn btn-primary">Crear visitante</button>
            <button type='reset' class="btn btn-secondary">Limpiar</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</form>