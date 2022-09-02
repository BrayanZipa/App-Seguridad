<div class="row mt-n2">
    <div class="col-12">
        <form id="formRegistros3" class="formularios" action="" method="POST" novalidate>
            @csrf  
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información colaborador con activo</h3>
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
                    <input type="hidden" id="registro3" name="casoRegistro" value="{{ old('casoRegistro') }}">
                    <input type="hidden" id="inputId3" name="id_personas" value="{{ old('id_personas') }}">

                    <div id="columnaAutorizacion" class="row" style="display: none">
                        <div class="col-md-8 col-ms-12">
                            <label id="autorizacion"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputCodigo3">Activo</label>
                                <input type="text" id="inputCodigo3" class="registros form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" placeholder="Activo" autocomplete="off" readonly required>
                                    @if ($errors->has('codigo')) 
                                        <div id="mensajeCodigo" class="invalid-feedback">
                                            {{ $errors->first('codigo') }}
                                        </div>          
                                    @endif 
                                    <div id="mensajeActivo" class="text-center mt-1" style="display: none"></div> 
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputNombre3">Nombre</label>
                                <input type="text" id="inputNombre3" class="registros form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}"
                                    placeholder="Nombre" autocomplete="off" readonly required>
                                    @if ($errors->has('nombre')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nombre') }}
                                        </div>            
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputApellido3">Apellido</label>
                                <input type="text" id="inputApellido3" class="registros form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}"
                                    placeholder="Apellido" autocomplete="off" readonly required>
                                    @if ($errors->has('apellido')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('apellido') }}
                                        </div>            
                                    @endif
                            </div>
                        </div> 
                    </div>
                    <div class="row">   
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputIdentificacion3">Identificación</label>
                                <input type="text" id="inputIdentificacion3" class="registros form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" name="identificacion" value="{{ old('identificacion') }}" placeholder="Identificación" autocomplete="off" readonly required>
                                    @if ($errors->has('identificacion')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identificacion') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>         
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail3">Correo empresarial</label>
                                <input type="text" id="inputEmail3" class="registros form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    placeholder="Correo empresarial" autocomplete="off" readonly>
                                    @if ($errors->has('email')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="inputTelefono3">Teléfono</label>
                                <input type="tel" id="inputTelefono3" class="registros form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}" name="tel_contacto" value="{{ old('tel_contacto') }}"
                                    placeholder="Teléfono" autocomplete="off" required>
                                    @if ($errors->has('tel_contacto')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tel_contacto') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="selectEps3">EPS</label>
                                <select id="selectEps3" class="registros select2EPS form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
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
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="selectArl3">ARL</label>
                                <select id="selectArl3" class="registros select2ARL form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
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
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="selectEmpresa3">Empresa a la que pertenece</label>
                                <select id="selectEmpresa3" class="registros form-control {{ $errors->has('id_empresa') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa" required>
                                    <option selected="selected" value="" disabled>Seleccione la empresa</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id_empresas}}"
                                            {{ $empresa->id_empresas == old('id_empresa') ? 'selected' : '' }}>{{ $empresa->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_empresa')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_empresa') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-n2">
                            <!-- checkbox -->
                            <div class="form-group clearfix pt-4">
                                <div class="icheck-primary d-inline">
                                    <label for="checkVehiculo3">
                                        ¿El colaborador ingresa vehículo?
                                    </label>
                                    <input type="checkbox" id="checkVehiculo3">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="inputDescripcion3">Ingrese una descripción</label>
                                <textarea id="inputDescripcion3" class="registros form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion">
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
                    <div id="divVehiculo3" class="row justify-content-end" style="display: none">
                        <div id="colInputVehiculo" class="col-md-8 col-sm-12 flex-column">
                            <div class="form-group">
                                <input id="vehiculo3" type="hidden" name="retornoVehiculo" value="{{ old('id_vehiculo') }}">
                                <label for="selectVehiculo3">Ingrese el vehículo</label>
                                <select id="selectVehiculo3" class="registros form-control {{ $errors->has('id_vehiculo') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_vehiculo"></select>
                                @if ($errors->has('id_vehiculo')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_vehiculo') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                        <div id="colMensajeVehiculo3" class="col-md-4 col-sm-12 flex-column justify-content-center" style="display: none">
                            <div id="mensajeVehiculo3" class="mensajeVehiculo text-center"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                @can('registrarIngreso')
                    <div class="card-footer">
                        <button id="botonActualizar" type='submit' class="btn btn-primary">Guardar registro</button>
                    </div>
                @endcan
                <!-- /.card-footer-->
            </div>
        </form>
    </div>
</div>