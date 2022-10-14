<input id="casoIngreso" type="hidden" name="casoIngreso" value="{{ old('casoIngreso') }}">
<input id="inputAutorizacion" type="hidden" name="autorizado" value="{{ old('autorizado') }}">

<div class="card card-primary mb-n1 mx-n1">
    <div class="card-header pb-1">
        <h3 class="card-title">Crear nuevo colaborador</h3>
        <div class="card-tools">
            <button id="botonComprimirColaborador" type="button" class="btn btn-tool pb-3 mr-n3" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body mb-n4">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="form-group">
                    <select id="selectCodigo" name="selectCodigo" class="form-control" style="width: 100%;">
                        <option selected="selected" value="" disabled></option>
                        @foreach ($computadores as $computador)
                            <option value="{{ $computador['id'] }}"
                                {{ $computador['id'] == old('selectCodigo') && old('casoIngreso2') == '' ? 'selected' : '' }}>{{ $computador['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 text-center mt-1">
                <label id="autorizacion"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="inputCodigo">Activo</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('codigo') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}"  id="inputCodigo" name="codigo" value="{{ old('casoIngreso2') == '' ? old('codigo') : '' }}" placeholder="Activo" autocomplete="off" readonly required>
                        @if ($errors->has('codigo')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('codigo') }}
                            </div>            
                        @endif
                </div>
            </div> 
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('nombre') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}"  id="inputNombre" name="nombre" value="{{ old('casoIngreso2') == '' ? old('nombre') : '' }}" placeholder="Nombre" autocomplete="off" readonly required>
                        @if ($errors->has('nombre')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>            
                        @endif
                </div>
            </div> 
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="inputApellido">Apellido</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('apellido') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputApellido" name="apellido" value="{{ old('casoIngreso2') == '' ? old('apellido') : '' }}" placeholder="Apellido" autocomplete="off" readonly required>
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
                    <label for="inputIdentificacion">Identificación</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('identificacion') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputIdentificacion" name="identificacion" value="{{ old('casoIngreso2') == '' ? old('identificacion') : '' }}" 
                        placeholder="Identificación" autocomplete="off" readonly required>
                        @if ($errors->has('identificacion')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('identificacion') }}
                            </div>          
                        @endif  
                </div>
            </div>  
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="inputEmail">Correo empresarial</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('email') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputEmail" name="email" value="{{ old('casoIngreso2') == '' ? old('email') : '' }}"
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
                    <label for="inputTelefono">Ingrese el teléfono</label>
                    <input type="tel" class="colaborador form-control {{ $errors->has('tel_contacto') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputTelefono" name="tel_contacto" value="{{ old('casoIngreso2') == '' ? old('tel_contacto') : '' }}"
                        placeholder="Teléfono" autocomplete="off" required onkeypress="return /[0-9]/i.test(event.key)">
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
                    <label for="selectEps">Ingrese la EPS</label>
                    <select id="selectEps" class="select2eps colaborador form-control {{ $errors->has('id_eps') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($eps as $ep)
                            <option value="{{ $ep->id_eps }}"
                                {{ $ep->id_eps == old('id_eps') && old('casoIngreso2') == '' ? 'selected' : '' }}>{{ $ep->eps }}
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
                    <label for="selectArl">Ingrese el ARL</label>
                    <select id="selectArl" class="select2arl colaborador form-control {{ $errors->has('id_arl') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($arl as $ar)
                            <option value="{{ $ar->id_arl }}"
                                {{ $ar->id_arl == old('id_arl') && old('casoIngreso2') == '' ? 'selected' : '' }}>{{ $ar->arl }}
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
                    <label for="selectEmpresa">Ingrese la empresa a la que pertenece</label>
                    <select id="selectEmpresa" class="colaborador form-control {{ $errors->has('id_empresa') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa" required>
                        <option selected="selected" value="" disabled>Seleccione la empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id_empresas}}"
                                {{ $empresa->id_empresas == old('id_empresa') && old('casoIngreso2') == '' ? 'selected' : '' }}>{{ $empresa->nombre }}
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
            <div class="col-md-4 col-sm-12">
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
            <div class="col-md-8 col-sm-12">
                <div class="form-group">
                    <label for="inputDescripcion">Ingrese una descripción</label>
                    <textarea id="inputDescripcion" class="colaborador form-control {{ $errors->has('descripcion') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" name="descripcion">
                        {{ old('casoIngreso2') == '' ? old('descripcion') : '' }}
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

    @can('crearColaborador')
        <div class="card-footer">
            <button id="botonCrear" type='submit' class="btn btn-primary">Crear</button>
            <button id="botonLimpiar" type='button' class="btn btn-secondary">Limpiar</button>
        </div>
    @endcan
    <!-- /.card-footer-->
</div>
<!-- /.card -->