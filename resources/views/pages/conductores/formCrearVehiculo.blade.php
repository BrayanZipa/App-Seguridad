<div class="card card-orange">
    <div class="card-header">
        <h3 class="card-title">Crear nuevo vehículo</h3>
        <div class="card-tools">
            <button id="botonComprimirVehiculo" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <!-- checkbox -->
                <div class="form-group clearfix mb-1">
                    <div class="icheck-primary d-inline">
                        <label for="checkVehiculo">
                            ¿El vehículo ya esta ingresado en el sistema?
                        </label>
                        <input type="checkbox" id="checkVehiculo">
                    </div><br>
                </div>
            </div>
        </div>
        <div class="row" id="filaVehiculoExistente" style="display: none">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="selectVehiculo">Ingrese el vehículo</label>
                    <select id="selectVehiculo" class="conductor form-control {{ $errors->has('id_vehiculo') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_vehiculo">
                        <option selected="selected" value="" disabled></option>
                        @foreach ($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id_vehiculos }}"
                                {{ $vehiculo->id_vehiculos == old('id_vehiculo') ? 'selected' : '' }}>
                                {{ $vehiculo->tipo.' '.($vehiculo->marca =! null ? $vehiculo->marca : '').' '.$vehiculo->identificador }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_vehiculo')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('id_vehiculo') }}
                        </div>            
                    @endif
                </div>
            </div>
        </div>

        <div class="row" id="filaVehiculoNuevo">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="inputFotoVehiculo">Fotografía</label>

                    <input type="hidden" id="inputFotoVehiculo" class="conductor vehiculo {{ $errors->has('foto_vehiculo') ? 'is-invalid' : '' }}" name="foto_vehiculo" value="{{ old('foto_vehiculo') }}">

                    <video src="" id="video2" class="img-fluid rounded" style="display: none"></video>
                    <canvas id="canvas2" class="img-fluid rounded" style="display: none"></canvas>

                    @if ($errors->has('foto_vehiculo')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('foto_vehiculo') }}
                        </div>            
                    @endif

                    <div class="mt-2">
                        <button id="botonActivar2" type="button" class="btn btn-sm" style="background-color: rgb(255, 115, 0); display: none">Activar</button>
                        <button id="botonCapturar2" type="button" class="btn btn-sm" style="display: none">Capturar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="inputNumeroIdentificador">Ingrese el número identificador del vehículo</label>
                            <input type="text" class="conductor vehiculo form-control {{ $errors->has('identificador') ? 'is-invalid' : '' }}" id="inputNumeroIdentificador"
                                name="identificador" value="{{ old('identificador') }}" autocomplete="off"
                                placeholder="Número identificador" required>
                                @if ($errors->has('identificador')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('identificador') }}
                                    </div>          
                                @endif  
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="selectTipoVehiculo">Ingrese el tipo de vehículo</label>
                            <select id="selectTipoVehiculo" class="conductor vehiculo form-control {{ $errors->has('id_tipo_vehiculo') ? 'is-invalid' : '' }}"
                                style="width: 100%;" name="id_tipo_vehiculo" required>
                                <option selected="selected" value="" disabled></option>
                                @foreach ($tipoVehiculos as $tipoVehiculo)
                                    <option value="{{ $tipoVehiculo->id_tipo_vehiculos }}"
                                        {{ $tipoVehiculo->id_tipo_vehiculos == old('id_tipo_vehiculo') ? 'selected' : '' }}>
                                        {{ $tipoVehiculo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_tipo_vehiculo')) 
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_tipo_vehiculo') }}
                                </div>            
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="selectMarcaVehiculo">Ingrese la marca del vehículo</label>
                            <select id="selectMarcaVehiculo" class="conductor form-control" style="width: 100%;"
                                name="id_marca_vehiculo">
                                <option selected="selected" value="" disabled></option>
                                @foreach ($marcaVehiculos as $marcaVehiculo)
                                    <option value="{{ $marcaVehiculo->id_marca_vehiculos }}"
                                        {{ $marcaVehiculo->id_marca_vehiculos == old('id_marca_vehiculo') ? 'selected' : '' }}>
                                        {{ $marcaVehiculo->marca }}
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
    @can('crearConductor')
        <div class="card-footer mt-n4">
            <button id="botonCrear" type='submit' class="btn" style="background-color: rgb(255, 115, 0)">Crear</button>
            <button id="botonLimpiar" type='button' class="btn btn-secondary">Limpiar</button>
        </div>
    @endcan
    <!-- /.card-footer-->
</div>
<!-- /.card -->