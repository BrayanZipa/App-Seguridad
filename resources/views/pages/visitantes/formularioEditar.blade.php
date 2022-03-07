<div class="row">
    <div class="col-md-12">
        <form action="{{ route('editarVisitante', ['id' => $visitante->id_personas]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualizar visitante</h3>
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
                                <label for="inputNombre">Actualizar nombre</label>
                                <input type="text" class="form-control" id="inputNombre" name="nombre"
                                    value="{{ $visitante->nombre }}" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputApellido">Actualizar apellido</label>
                                <input type="text" class="form-control" id="inputApellido" name="apellido"
                                    value="{{ $visitante->apellido }}" placeholder="Apellido" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputIdentificacion">Actualizar identificación</label>
                                <input type="text" class="form-control" id="inputIdentificacion"
                                    name="identificacion" value="{{ $visitante->identificacion }}"
                                    placeholder="Identificación" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputTelefono">Actualizar teléfono de emergencia</label>
                                <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto"
                                    value="{{ $visitante->tel_contacto }}" placeholder="Teléfono" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Actualizar EPS</label>
                                <select class="form-control select2" style="width: 100%;" name="id_eps" required>
                                    <option selected="selected" value="{{ $datoIndividual[0]->id_eps }}"">{{ $datoIndividual[0]->eps }}</option>
                                              @foreach ($eps as $ep)
                                    <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Actualizar ARL</label>
                                <select class="form-control select2" style="width: 100%;" name="id_arl" required>
                                    <option selected="selected" value="{{ $datoIndividual[1]->id_arl }}">
                                        {{ $datoIndividual[1]->arl }}</option>
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
                    <button type='submit' class="btn btn-primary">Actualizar visitante</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </form>

    </div>
</div>