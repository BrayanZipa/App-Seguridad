<div class="row mb-n2">
    <div class="col-md-12">
        {{-- <form id="form_registroSalida" action="" method="POST" >
            @csrf
            @method('PUT') --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
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
                        <div class="col-sm-12">
                            <input type="hidden" id="idRegistro">
                            <input type="hidden" id="idTipoPersona">
                        {{-- <div class="col-sm-4">
                            <div class="form-group">
                                <input type="hidden" id="inputId" name="id_personas" value="{{ old('id_personas') }}">

                                <label for="inputFoto">Fotografía</label>
                                <input type="hidden" id="inputFoto" class="{{ $errors->has('foto') ? 'is-invalid' : '' }}" name="foto" value="{{ old('foto') }}">
                                <img id="fotoConductor" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto conductor">
                                @if ($errors->has('foto')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto') }}
                                    </div>            
                                @endif
                            </div>
                        </div> --}}
                        {{-- <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="inputNombre" name="nombre" value="{{ old('nombre') }}" autocomplete="off"
                                            placeholder="Nombre" readonly required>
                                        @if ($errors->has('nombre')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nombre') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputApellido">Apellido</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" id="inputApellido" name="apellido" value="{{ old('apellido') }}" autocomplete="off"
                                            placeholder="Apellido" readonly required>
                                        @if ($errors->has('apellido')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('apellido') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Identificación</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" id="inputIdentificacion" name="identificacion" autocomplete="off"
                                        value="{{ old('identificacion') }}" placeholder="Identificación" readonly required>
                                        @if ($errors->has('identificacion')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('identificacion') }}
                                            </div>          
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputTelefono">Actualizar teléfono</label>
                                        <input type="tel" class="conductor form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}"  id="inputTelefono" name="tel_contacto" value="{{ old('tel_contacto') }}" autocomplete="off"
                                            placeholder="Teléfono" required>
                                        @if ($errors->has('tel_contacto')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tel_contacto') }}
                                            </div>          
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputEps">Actualizar EPS</label>
                                        <select class="conductor select2bs4 form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" id="inputEps" name="id_eps"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}"
                                                    {{ $ep->id_eps == old('id_eps') ? 'selected' : '' }}>{{ $ep->eps }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_eps')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_eps') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputArl">Actualizar ARL</label>
                                        <select class="conductor select2bs4 form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" id="inputArl" name="id_arl"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}"
                                                    {{ $ar->id_arl == old('id_arl') ? 'selected' : '' }}>{{ $ar->arl }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_arl')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_arl') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="row mt-2">
                            <div class="col-12"> --}}

                                <!-- checkbox -->
                                <div class="form-group clearfix mt-n2 mb-1">
                                    <input type="hidden" id="inputVehiculo" name="casoRegistro">
                                    <div class="icheck-primary d-inline">
                                        <label for="checkVehiculo">
                                            ¿La persona sale sin vehículo?
                                        </label>
                                        <input type="checkbox" id="checkVehiculo">
                                    </div><br>
                                    <div class="icheck-primary d-inline">
                                        <label for="checkActivo">
                                            ¿La persona sale sin activo?
                                        </label>
                                        <input type="checkbox" id="checkActivo">
                                    </div>
                                </div>

                            {{-- </div>
                        </div> --}}
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type='button' id="botonGuardarSalida" class="btn btn-primary">Registrar salida</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        {{-- </form> --}}

    </div>
</div>