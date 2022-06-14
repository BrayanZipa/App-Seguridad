<div class="row mt-n2">
    <div class="col-md-12">
        <form id="formRegistros3" id="form_EditarColaborador" action="{{ route('crearRegistro') }}" method="POST" novalidate>
            @csrf  
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información colaborador con activo</h3>
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
                    <input type="hidden" id="inputId" name="id_personas" value="{{ old('id_personas') }}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputCodigo">Activo</label>
                                <input type="text" id="inputCodigo" class="registros form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" placeholder="Activo" autocomplete="off" readonly required>
                                    @if ($errors->has('codigo')) 
                                        <div id="mensajeCodigo" class="invalid-feedback">
                                            {{ $errors->first('codigo') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputNombre">Nombre</label>
                                <input type="text" id="inputNombre" class="registros form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}"
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
                                <label for="inputApellido">Apellido</label>
                                <input type="text" id="inputApellido" class="registros form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}"
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputIdentificacion">Identificación</label>
                                <input type="text" id="inputIdentificacion" class="registros form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" name="identificacion" value="{{ old('identificacion') }}" placeholder="Identificación" autocomplete="off" readonly required>
                                    @if ($errors->has('identificacion')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('identificacion') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>         
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputEmail">Correo empresarial</label>
                                <input type="text" id="inputEmail" class="registros form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    placeholder="Correo empresarial" autocomplete="off" readonly>
                                    @if ($errors->has('email')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>          
                                    @endif  
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputTelefono">Teléfono</label>
                                <input type="tel" id="inputTelefono" class="registros form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}" name="tel_contacto" value="{{ old('tel_contacto') }}"
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectEps">EPS</label>
                                <select id="selectEps" class="registros select2bs4 form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
                                    <option selected="selected" value="" disabled>Seleccione EPS</option>
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectArl">ARL</label>
                                <select id="selectArl" class="registros select2bs4 form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
                                    <option selected="selected" value="" disabled>Seleccione ARL</option>
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
                                <label for="selectEmpresa">Empresa a la que pertenece</label>
                                <select id="selectEmpresa" class="registros form-control {{ $errors->has('id_empresa') ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa" required>
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="inputDescripcion">Ingrese una descripción</label>
                                <textarea id="inputDescripcion" class="registros form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion">
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="botonActualizar" type='submit' class="btn btn-primary">Guardar registro</button>
                    <button id="botonCambiarRol" type='button' class="btn btn-danger" style="display: none">Cambiar a visitante</button>
                </div>
                <!-- /.card-footer-->
            </div>
        </form>
    </div>
</div>