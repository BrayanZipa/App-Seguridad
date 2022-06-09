<input id="casoIngreso" type="hidden" name="casoIngreso" value="{{ old('casoIngreso') }}">

<div class="card card-primary mb-n1 mx-n1">
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
            <div class="col-sm-8">
                <div class="form-group">
                    <select id="selectIdentificacion"  name="selectIdentificacion" class="colaborador form-control" style="width: 100%;">
                        <option selected="selected" value="" disabled></option>
                        @foreach ($listaColaboradores as $colaborador)
                            <option value="{{  $colaborador['id'] }}"
                            {{ $colaborador['id'] == old('selectIdentificacion') && old('casoIngreso2') == '' ? 'selected' : '' }}>C.C. {{ $colaborador['registration_number'] }} - {{ $colaborador['firstname'] }} {{ $colaborador['realname'] }} 
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputCodigo">Ingrese el activo</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('codigo') && old('casoIngreso2') == ''  ? 'is-invalid' : '' }}" id="inputCodigo" name="codigo" value="{{ old('casoIngreso2') == '' ? old('codigo') : '' }}" placeholder="Activo" autocomplete="off" readonly required>
                        @if ($errors->has('codigo')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('codigo') }}
                            </div>          
                        @endif  
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputNombre">Ingrese el nombre</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('nombre') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputNombre" name="nombre" value="{{ old('casoIngreso2') == '' ? old('nombre') : '' }}"
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
                    <label for="inputApellido">Ingrese el apellido</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('apellido') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputApellido" name="apellido" value="{{ old('casoIngreso2') == '' ? old('apellido') : '' }}"
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
                    <label for="inputIdentificacion">Ingrese la identificación</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('identificacion') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputIdentificacion"
                        name="identificacion" value="{{ old('casoIngreso2') == '' ? old('identificacion') : '' }}" placeholder="Identificación" autocomplete="off" readonly required>
                        @if ($errors->has('identificacion')) 
                            <div class="invalid-feedback">
                                {{ $errors->first('identificacion') }}
                            </div>          
                        @endif  
                </div>
            </div>  
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputEmail">Ingrese el correo empresarial</label>
                    <input type="text" class="colaborador form-control {{ $errors->has('email') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputEmail" name="email" value="{{ old('casoIngreso2') == '' ? old('email') : '' }}"
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
                    <label for="inputTelefono">Ingrese el teléfono</label>
                    <input type="tel" class="colaborador form-control {{ $errors->has('tel_contacto') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" id="inputTelefono" name="tel_contacto" value="{{ old('casoIngreso2') == '' ? old('tel_contacto') : '' }}"
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
            <div class="col-sm-4">
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectEmpresa">Ingrese la empresa a la que pertenece</label>
                    <select id="selectEmpresa" class="colaborador form-control {{ $errors->has('id_empresa') && old('casoIngreso2') == '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa"
                        required>
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
            <div class="col-sm-8">
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
    <!-- /.card-body -->
    <div class="card-footer">
        <button id="botonCrear" type='submit' class="btn btn-primary">Crear</button>
        <button id="botonLimpiar" type='button' class="btn btn-secondary">Limpiar</button>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->