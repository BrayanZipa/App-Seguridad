<div class="row mt-n2">
    <div class="col-md-12">
        <form id="formRegistros2" class="formularios" action="" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información colaborador</h3>
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
                    <input type="hidden" id="inputId2" name="id_personas" value="{{ old('id_personas') }}">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputNombre2">Nombre</label>
                                <input type="text" id="inputNombre2" class="registros form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}"
                                    placeholder="Nombre" autocomplete="off" readonly required>
                                    @if ($errors->has('nombre')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nombre') }}
                                        </div>            
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputApellido2">Apellido</label>
                                <input type="text" id="inputApellido2" class="registros form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}"
                                    placeholder="Apellido" autocomplete="off" readonly required>
                                    @if ($errors->has('apellido')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('apellido') }}
                                        </div>            
                                    @endif
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputIdentificacion2">Identificación</label>
                                <input type="text" id="inputIdentificacion2" class="registros form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" name="identificacion" value="{{ old('identificacion') }}" 
                                    placeholder="Identificación" autocomplete="off" readonly required>
                                    @if ($errors->has('identificacion')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identificacion') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>  
                    </div>
                    <div class="row">          
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputEmail2">Correo empresarial</label>
                                <input type="text" id="inputEmail2" class="registros form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    placeholder="Correo empresarial" autocomplete="off">
                                    @if ($errors->has('email')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputTelefono2">Teléfono</label>
                                <input type="tel" id="inputTelefono2" class="registros form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}" name="tel_contacto" value="{{ old('tel_contacto') }}"
                                    placeholder="Teléfono" autocomplete="off" required>
                                    @if ($errors->has('tel_contacto')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tel_contacto') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectEps2">EPS</label>
                                <select id="selectEps2" class="registros select2EPS form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectArl2">ARL</label>
                                <select id="selectArl2" class="registros select2ARL form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectEmpresa2">Empresa a la que pertenece</label>
                                <select id="selectEmpresa2" class="registros form-control {{ $errors->has('id_empresa') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa" required>
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputDescripcion2">Ingrese una descripción</label>
                                <textarea id="inputDescripcion2" class="registros form-control {{ $errors->has('descripcion') ? ' is-invalid ' : '' }}" name="descripcion">
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

                    <div id="" class="row divVehiculo mt-n4" style="display: none">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectVehiculo2">Ingrese el vehículo</label>
                                <select id="selectVehiculo2" class="registros form-control {{ $errors->has('id_vehiculo') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_vehiculo"></select>
                                @if ($errors->has('id_vehiculo')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_vehiculo') }}
                                    </div>            
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- mt-n3 --}}
                    <div class="row mt-n3">
                        <div class="col-sm-4">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <label for="checkVehiculo2">
                                        ¿El colaborador ingresa vehículo?
                                    </label>
                                    <input type="checkbox" id="checkVehiculo2">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-n2">
                    <button type='submit' class="btn btn-primary">Guardar registro</button>
                    {{-- <button id="botonCambiarRol" type='button' class="btn btn-danger">Cambiar a visitante</button> --}}
                </div>
                <!-- /.card-footer-->
            </div>
        </form>
    </div>
</div>