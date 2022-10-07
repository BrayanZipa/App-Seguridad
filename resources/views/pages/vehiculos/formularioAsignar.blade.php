<div class="row mb-n2">
    <div class="col-12">
        <form id="form_AsignarVehiculo" action="{{ route('asignarVehiculo') }}" method="POST" novalidate>
            @csrf
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title">Asignar vehículo</h3>
                    <div class="card-tools">
                        <button id="btnComprimirAsignacion" type="button" class="btn btn-tool" data-card-widget="collapse"><i id="btnComprimir" class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                <div class="card-body mb-n4">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="selectAsignarTipoPersona">Seleccione el tipo de persona</label>
                                <select id="selectAsignarTipoPersona" class="asignarVehiculo form-control" name="tipo_persona" style="width: 100%;" required>
                                    <option selected="selected" value="" disabled>Tipo de persona</option>
                                    @foreach ($tipoPersonas as $tipo)
                                        <option value="{{ $tipo->id_tipo_personas }}" {{ $tipo->id_tipo_personas == old('tipo_persona') ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div id="columnaAsignarPersona" class="col-md-6 col-sm-12" style="display: none">
                            <div class="form-group">
                                <label for="selectAsignarPersona">Seleccione a la persona</label>
                                <select id="selectAsignarPersona" class="asignarVehiculo form-control {{ $errors->has('persona_id') ? 'is-invalid' : '' }}" style="width: 100%;" name="persona_id" required>
                                    <option selected="selected" value="" disabled></option>
                                </select>
                                @if ($errors->has('persona_id')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('persona_id') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="selectAsignarVehiculo">Seleccione el vehículo</label>
                                <select id="selectAsignarVehiculo" class="asignarVehiculo form-control {{ $errors->has('vehiculo_id') ? 'is-invalid' : '' }}" style="width: 100%;" name="vehiculo_id" required>
                                    <option selected="selected" value="" disabled></option>
                                        @foreach ($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id_vehiculos }}"
                                                {{ $vehiculo->id_vehiculos == old('vehiculo_id') ? 'selected' : '' }}>
                                                {{ $vehiculo->tipo.' '.($vehiculo->marca =! null ? $vehiculo->marca : '').' '.$vehiculo->identificador }}
                                            </option>
                                        @endforeach
                                </select>
                                @if ($errors->has('vehiculo_id')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('vehiculo_id') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type='submit' class="btn" style="background-color: rgb(255, 115, 0)">Asignar</button>
                </div> 

            </div>
        </form>
    </div>
</div>
