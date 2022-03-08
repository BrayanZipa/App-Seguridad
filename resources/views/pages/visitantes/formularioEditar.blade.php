<div class="row">
    <div class="col-md-12">
        <form id="form_editar" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualizar visitante</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        <button id="botonCerrar" type="button" class="btn btn-tool">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputNombre">Actualizar nombre</label>
                                <input type="text" class="form-control" id="inputNombre" name="nombre" value=""
                                    placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputApellido">Actualizar apellido</label>
                                <input type="text" class="form-control" id="inputApellido" name="apellido" value=""
                                    placeholder="Apellido" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputIdentificacion">Actualizar identificación</label>
                                <input type="text" class="form-control" id="inputIdentificacion" name="identificacion"
                                    value="" placeholder="Identificación" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputTelefono">Actualizar teléfono de emergencia</label>
                                <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto" value=""
                                    placeholder="Teléfono" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Actualizar EPS</label>
                                <select class="form-control select2" style="width: 100%;" id="inputEps" name="id_eps"
                                    required>
                                    <option selected="selected" value="" disabled>Seleccione EPS</option>
                                    @foreach ($eps as $ep)
                                        <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Actualizar ARL</label>
                                <select class="form-control select2" style="width: 100%;" id="inputArl" name="id_arl"
                                    required>
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
                    <button type='submit' class="btn btn-primary">Actualizar</button>
                    <button id="botonLimpiar" type='reset' class="btn btn-secondary">Limpiar</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </form>

    </div>
</div>