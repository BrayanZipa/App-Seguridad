<div class="row">
    <div class="col-md-12">
        <form id="form_EditarConductor" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualizar conductor</h3>
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
                                <input type="text" id="inputId" name="id_personas" value="{{ old('id_personas') }}" style="display: none">

                                <label for="inputFoto">Fotografía</label>
                                <input type="text" id="inputFoto" name="foto" value="{{ old('foto') }}" style="display: none">
                                <img id="fotoConductor" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto conductor">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputNombre">Actualizar nombre</label>
                                        <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{ old('nombre') }}" autocomplete="off"
                                            placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputApellido">Actualizar apellido</label>
                                        <input type="text" class="form-control" id="inputApellido" name="apellido" value="{{ old('apellido') }}" autocomplete="off"
                                            placeholder="Apellido" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Actualizar identificación</label>
                                        <input type="text" class="form-control" id="inputIdentificacion" name="identificacion" autocomplete="off"
                                        value="{{ old('identificacion') }}" placeholder="Identificación" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputTelefono">Actualizar teléfono de emergencia</label>
                                        <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto" value="{{ old('tel_contacto') }}" autocomplete="off"
                                            placeholder="Teléfono" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Actualizar EPS</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="inputEps" name="id_eps"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}"
                                                    {{ $ep->id_eps == old('id_eps') ? 'selected' : '' }}>{{ $ep->eps }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Actualizar ARL</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="inputArl" name="id_arl"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}"
                                                    {{ $ar->id_arl == old('id_arl') ? 'selected' : '' }}>{{ $ar->arl }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Actualizar tipo de persona</label>
                                        <select class="form-control" style="width: 100%;" id="inputTipoPersona" name="id_tipo_persona"
                                            required>
                                            <option selected="selected" value="" disabled>Seleccione el tipo de persona</option>
                                            @foreach ($tipoPersonas as $persona)
                                                <option value="{{ $persona->id_tipo_personas }}"
                                                    {{ $persona->id_tipo_personas == old('id_tipo_persona') ? 'selected' : '' }}>{{ $persona->tipo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type='submit' class="btn btn-primary">Actualizar</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </form>

    </div>
</div>