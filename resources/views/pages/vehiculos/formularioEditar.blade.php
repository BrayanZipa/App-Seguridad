<div class="row mb-n2">
    <div class="col-md-12">
        <form id="form_EditarVehiculo" action="" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title">Actualizar vehículo</h3>
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

                <div class="card-body mb-n4">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="hidden" id="inputIdVehiculo" name="id_vehiculos" value="{{ old('id_vehiculos') }}">

                                <label for="inputFotoVehiculo">Fotografía</label>
                                <input type="hidden" id="inputFotoVehiculo" class="{{ $errors->has('foto_vehiculo') ? 'is-invalid' : '' }}" name="foto_vehiculo"
                                    value="{{ old('foto_vehiculo') }}">
                                <img id="fotoVehiculo" class="img-fluid rounded" style="border: 1px solid #fd7e14" src="" alt="Foto vehículo">  
                                @if ($errors->has('foto_vehiculo')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto_vehiculo') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputNumeroIdentificador">Actualizar número identificador del vehículo</label>
                                        <input type="text" class="vehiculo form-control {{ $errors->has('identificador') ? 'is-invalid' : '' }}" id="inputNumeroIdentificador"
                                            name="identificador" value="{{ old('identificador') }}" autocomplete="off"
                                            placeholder="Número indetificador" required>
                                            @if ($errors->has('identificador')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('identificador') }}
                                                </div>          
                                            @endif  
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="selectTipoVehiculo">Actualizar tipo de vehículo</label>
                                        <select id="selectTipoVehiculo" class="vehiculo  select2bs4 form-control {{ $errors->has('id_tipo_vehiculo') ? 'is-invalid' : '' }}"
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="selectMarcaVehiculo">Actualizar marca del vehículo</label>
                                        <select id="selectMarcaVehiculo" class="form-control select2bs4" style="width: 100%;"
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="selectTipoPersona">Actualizar propietario del vehículo</label>
                                        <select id="selectTipoPersona" class="vehiculo select2bs4 form-control" name="tipoPersona" style="width: 100%;" required>
                                            <option selected="selected" value="" disabled>Seleccione el tipo de persona</option>
                                            @foreach ($tipoPersonas as $tipo)
                                                <option value="{{ $tipo->id_tipo_personas }}" {{ $tipo->id_tipo_personas == old('tipoPersona') ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>  
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-6">
                                    <input type="hidden" id="personaAnterior" name="personaAnterior" value="{{ old('personaAnterior') }}">
                                    <input type="hidden" id="retornoPersona" name="retornoPersona" value="{{ old('retornoPersona') }}">
                                    <div class="form-group">
                                        <label for="selectPersona">Actualizar propietario</label>
                                        <select id="selectPersona" class="vehiculo form-control {{ $errors->has('id_persona') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_persona" required>
                                            <option selected="selected" value="" disabled></option>
                                        </select>
                                        @if ($errors->has('id_persona')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_persona') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type='submit' class="btn" style="background-color: rgb(255, 115, 0)">Actualizar</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </form>
    </div>
</div>