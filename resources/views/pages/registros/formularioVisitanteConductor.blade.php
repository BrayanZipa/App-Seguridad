<div class="row mt-n2">
    <div class="col-md-12">
        <form id="formRegistros1" class="formularios" action="{{ route('crearRegistro') }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 id="titulo" class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="botonCerrar btn btn-tool">
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
                                <input type="hidden" id="registro" name="casoRegistro" value="{{ old('casoRegistro') }}">
                                <input type="hidden" id="inputId" name="id_personas" value="{{ old('id_personas') }}">
                                <label for="inputFoto">Fotografía</label>
                                <input type="hidden" id="inputFoto" class="{{ $errors->has('foto') ? 'is-invalid' : '' }}" name="foto" value="{{ old('foto') }}">
                                <img id="fotografia" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto persona">
                                @if ($errors->has('foto')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" id="inputNombre" class="registros form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" autocomplete="off"
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
                                        <input type="text" id="inputApellido" class="registros form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" autocomplete="off"
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
                                        <input type="text" id="inputIdentificacion" class="registros form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" name="identificacion" autocomplete="off"
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
                                        <label for="inputTelefono">Teléfono de emergencia</label>
                                        <input type="tel" id="inputTelefono" class="registros form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}" name="tel_contacto" value="{{ old('tel_contacto') }}" autocomplete="off"
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
                                        <label for="selectEps">EPS</label>
                                        <select id="selectEps" class="registros select2EPS form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
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
                                        <label for="selectArl">ARL</label>
                                        <select id="selectArl" class="registros select2ARL form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="selectEmpresa">Ingrese la empresa que visita</label>
                                        <select id="selectEmpresa" class="registros form-control {{ $errors->has('empresa_visitada') ? 'is-invalid' : '' }}" style="width: 100%;" name="empresa_visitada" required>
                                            <option selected="selected" value="" disabled>Seleccione la empresa</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id_empresas}}"
                                                    {{ $empresa->id_empresas == old('empresa_visitada') ? 'selected' : '' }}>{{ $empresa->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('empresa_visitada')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('empresa_visitada') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputColaborador">Ingrese al colaborador a cargo</label>
                                        <input id="inputColaborador" type="text" class="registros form-control {{ $errors->has('colaborador') ? ' is-invalid ' : '' }}" name="colaborador" value="{{ old('colaborador') }}" autocomplete="off" 
                                            placeholder="Colaborador" required>
                                            @if ($errors->has('colaborador')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('colaborador') }}
                                                </div>          
                                            @endif      
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputDescripcion">Ingrese una descripción</label>
                                        <textarea id="inputDescripcion" class="registros form-control {{ $errors->has('descripcion') ? ' is-invalid ' : '' }}" name="descripcion">
                                            {{ old('descripcion') }}
                                        </textarea>
                                        @if ($errors->has('descripcion')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('descripcion') }}
                                            </div>          
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <div id="divActivo" class="row visitante" style="display: none">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputActivo">Ingrese el tipo de activo</label>
                                        <input type="text" id="inputActivo" class="registros form-control {{ $errors->has('activo') ? 'is-invalid' : '' }}" name="activo" value="{{ old('activo') }}" autocomplete="off" placeholder="Tipo de activo">
                                            @if ($errors->has('activo')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('activo') }}
                                                </div>          
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputCodigo">Ingrese el código único del activo</label>
                                        <input type="text" id="inputCodigo" class="registros form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" name="codigo"
                                            value="{{ old('codigo') }}" autocomplete="off" placeholder="Código">
                                            @if ($errors->has('codigo')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('codigo') }}
                                                </div>          
                                            @endif 
                                    </div>
                                </div>
                            </div>
                            <div id="divVehiculo" class="row" style="display: none">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input id="vehiculo" type="hidden" name="retornoVehiculo" value="{{ old('id_vehiculo') }}">
                                        <label for="selectVehiculo">Ingrese el vehículo</label>
                                        <select id="selectVehiculo" class="registros form-control {{ $errors->has('id_vehiculo') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_vehiculo">
                                        </select>
                                        @if ($errors->has('id_vehiculo')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_vehiculo') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="checkBox" class="row visitante">
                                <div class="col-12">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix mt-n1 mb-1">
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
                    <button type='submit' class="btn btn-primary">Guardar registro</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </form>
    </div>
</div>