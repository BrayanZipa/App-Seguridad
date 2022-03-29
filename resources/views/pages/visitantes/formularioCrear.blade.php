<form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST">
    @csrf

    <input id="casoIngreso" type="hidden" name="casoIngreso">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear nuevo visitante</h3>
            <div class="card-tools">
                <button id="botonComprimirVisitante" type="button" class="btn btn-tool" data-card-widget="collapse"><i
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
                        <label for="inputFoto">Fotografía</label>
                
                        <input type="text" class="visitante" id="inputFoto" name="foto" value="{{ old('foto') }}"
                            style="display: none">

                        <video src="" id="video" class="img-fluid rounded" style="display: none"></video>
                        <canvas id="canvas" class="img-fluid rounded"  style="display: none"></canvas>

                        <div class="mt-2">
                            <button id="botonActivar" type="button" class="btn btn-primary btn-sm">Activar</button>
                            <button id="botonCapturar" type="button" class="btn btn-primary btn-sm" style="display: none">Capturar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputNombre">Ingrese el nombre</label>
                                <input type="text" class="visitante form-control" id="inputNombre" name="nombre"
                                    value="{{ old('nombre') }}" placeholder="Nombre" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputApellido">Ingrese el apellido</label>
                                <input type="text" class="visitante form-control" id="inputApellido" name="apellido"
                                    value="{{ old('apellido') }}" placeholder="Apellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputIdentificacion">Ingrese la identificación</label>
                                <input type="text" class="visitante form-control" id="inputIdentificacion"
                                    name="identificacion" value="{{ old('identificacion') }}"
                                    placeholder="Identificación" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputTelefono">Ingrese un teléfono en caso de emergencia</label>
                                <input type="tel" class="visitante form-control" id="inputTelefono" name="tel_contacto"
                                    value="{{ old('tel_contacto') }}" placeholder="Teléfono" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ingrese la EPS</label>
                                <select id="selectEps" class="visitante form-control select2bs4" style="width: 100%;"
                                    name="id_eps" required>
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
                                <label>Ingrese el ARL</label>
                                <select id="selectArl" class="visitante form-control select2bs4" style="width: 100%;" name="id_arl"
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
                    <div class="row mt-2">
                        <div class="col-sm-12">
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
                                        ¿El visitante ingresa computador?
                                    </label>
                                    <input type="checkbox" id="checkActivo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button id="botonCrear" type='submit' class="btn btn-primary">Crear visitante</button>
            <button id="botonLimpiar" type='button' class="btn btn-secondary">Limpiar</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    {{-- </form> --}}