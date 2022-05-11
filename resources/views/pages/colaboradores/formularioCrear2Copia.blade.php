<input id="casoIngreso2" type="hidden" name="casoIngreso2" value="{{ old('casoIngreso2') }}">

<div class="card card-primary mb-1 mx-n1">
    <div class="card-header pb-1">
        <h3 class="card-title">Crear nuevo colaborador</h3>
        <div class="card-tools">
            <button id="botonComprimirColaborador" type="button" class="btn btn-tool pb-3 mr-n3" data-card-widget="collapse"><i
                    class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body mb-n4">
        <div class="row">
            {{-- <div class="col-sm-4">
                <div class="form-group">
                    <input type="hidden" id="inputCodigo" name="codigo" value="{{ old('codigo') }}" required>
                    <label for="selectCodigo">Ingrese el activo</label>
                    <select name="selectCodigo" id="selectCodigo" class="colaborador form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" style="width: 100%;" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($computadores as $computador)
                            <option value="{{ $computador['users_id'] }}"
                            {{ $computador['users_id'] == old('selectCodigo') ? 'selected' : '' }}>{{ $computador['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('codigo')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('codigo') }}
                        </div>            
                    @endif
                </div>
            </div>  --}}
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputNombre2">Ingrese el nombre</label>
                    <input type="text" class="colaboradorVehiculo form-control {{ $errors->has('nombre') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" id="inputNombre2" name="nombre" value="{{ old('casoIngreso2') == 'casoVehiculo' ? old('nombre') : '' }}"
                        placeholder="Nombre" autocomplete="off" required>
                        @if ($errors->has('nombre')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>            
                        @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputApellido2">Ingrese el apellido</label>
                    <input type="text" class="colaboradorVehiculo form-control {{ $errors->has('apellido') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" id="inputApellido2" name="apellido" value="{{ old('casoIngreso2') == 'casoVehiculo' ? old('apellido') : '' }}"
                        placeholder="Apellido" autocomplete="off" required>
                        @if ($errors->has('apellido')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('apellido') }}
                            </div>            
                        @endif
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputIdentificacion2">Ingrese la identificación</label>
                    <input type="text" class="colaboradorVehiculo form-control {{ $errors->has('identificacion') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" id="inputIdentificacion2"
                        name="identificacion" value="{{ old('casoIngreso2') == 'casoVehiculo' ? old('identificacion') : '' }}" placeholder="Identificación" autocomplete="off" required>
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
                    <label for="inputEmail2">Ingrese el correo empresarial</label>
                    <input type="text" class="colaboradorVehiculo form-control {{ $errors->has('email') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" id="inputEmail2" name="email" value="{{ old('casoIngreso2') == 'casoVehiculo' ? old('email') : '' }}"
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
                    <label for="inputTelefono2">Ingrese el teléfono</label>
                    <input type="tel" class="colaboradorVehiculo form-control {{ $errors->has('tel_contacto') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" id="inputTelefono2" name="tel_contacto" value="{{ old('casoIngreso2') == 'casoVehiculo' ? old('tel_contacto') : '' }}"
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
                    <label for="selectEps2">Ingrese la EPS</label>
                    <select id="selectEps2" class="select2eps colaboradorVehiculo form-control {{ $errors->has('id_eps') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($eps as $ep)
                            <option value="{{ $ep->id_eps }}"
                                {{ $ep->id_eps == old('id_eps') && old('casoIngreso2') == 'casoVehiculo' ? 'selected' : '' }}>{{ $ep->eps }}
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
                    <label for="selectArl2">Ingrese el ARL</label>
                    <select id="selectArl2" class="select2arl colaboradorVehiculo form-control {{ $errors->has('id_arl') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($arl as $ar)
                            <option value="{{ $ar->id_arl }}"
                                {{ $ar->id_arl == old('id_arl') && old('casoIngreso2') == 'casoVehiculo' ? 'selected' : '' }}>{{ $ar->arl }}
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
                    <label for="selectEmpresa2">Ingrese la empresa a la que pertenece</label>
                    <select id="selectEmpresa2" class="colaboradorVehiculo form-control {{ $errors->has('id_empresa') && old('casoIngreso2') == 'casoVehiculo' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa"
                        required>
                        <option selected="selected" value="" disabled>Seleccione la empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id_empresas}}"
                                {{ $empresa->id_empresas == old('id_empresa') && old('casoIngreso2') == 'casoVehiculo' ? 'selected' : '' }}>{{ $empresa->nombre }}
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
                    <textarea id="inputDescripcion2" class="colaboradorVehiculo form-control {{ $errors->has('descripcion') && old('casoIngreso2') == 'casoVehiculo' ? ' is-invalid ' : '' }}" name="descripcion">
                        {{ old('casoIngreso2') == 'casoVehiculo' ? old('descripcion') : '' }}
                    </textarea>
                    @if ($errors->has('descripcion')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
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
                        <label for="checkVehiculo">
                            ¿El colaborador ingresa vehículo?
                        </label>
                        <input type="checkbox" id="checkVehiculo">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->