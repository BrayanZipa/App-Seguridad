<input id="casoIngreso2" type="hidden" name="casoIngreso2" value="{{ old('casoIngreso2') }}">

<div class="card card-primary mb-n4 mx-n1">
    <div class="card-header pb-1">
        <h3 class="card-title">Crear nuevo colaborador</h3>
        <div class="card-tools">
            <button id="botonComprimirColaborador2" type="button" class="btn btn-tool pb-3 mr-n3" data-card-widget="collapse"><i
                    class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body mb-n4">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="form-group">
                    {{-- <label for="selectPersona">Buscar persona</label> --}}
                    <select id="selectPersona" class="colaborador2 form-control" style="width: 100%;" name="persona">
                        <option selected="selected" value="" disabled></option>
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id_personas }}"
                                {{ $persona->id_personas == old('persona') && old('casoIngreso2') != '' ? 'selected' : '' }}>C.C. {{ $persona->identificacion }} - {{ $persona->nombre }} {{ $persona->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputNombre2">Ingrese el nombre</label>
                    <input type="text" class="colaborador2 form-control {{ $errors->has('nombre') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" id="inputNombre2" name="nombre" value="{{ old('casoIngreso2') != '' ? old('nombre') : '' }}"
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
                    <input type="text" class="colaborador2 form-control {{ $errors->has('apellido') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" id="inputApellido2" name="apellido" value="{{ old('casoIngreso2') != '' ? old('apellido') : '' }}"
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
                    <input type="text" class="colaborador2 form-control {{ $errors->has('identificacion') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" id="inputIdentificacion2"
                        name="identificacion" value="{{ old('casoIngreso2') != '' ? old('identificacion') : '' }}" placeholder="Identificación" autocomplete="off" required>
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
                    <input type="text" class="colaborador2 form-control {{ $errors->has('email') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" id="inputEmail2" name="email" value="{{ old('casoIngreso2') != '' ? old('email') : '' }}"
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
                    <input type="tel" class="colaborador2 form-control {{ $errors->has('tel_contacto') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" id="inputTelefono2" name="tel_contacto" value="{{ old('casoIngreso2') != '' ? old('tel_contacto') : '' }}"
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
                    <select id="selectEps2" class="select2eps colaborador2 form-control {{ $errors->has('id_eps') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_eps" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($eps as $ep)
                            <option value="{{ $ep->id_eps }}"
                                {{ $ep->id_eps == old('id_eps') && old('casoIngreso2') != '' ? 'selected' : '' }}>{{ $ep->eps }}
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
                    <select id="selectArl2" class="select2arl colaborador2 form-control {{ $errors->has('id_arl') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_arl" required>
                        <option selected="selected" value="" disabled></option>
                        @foreach ($arl as $ar)
                            <option value="{{ $ar->id_arl }}"
                                {{ $ar->id_arl == old('id_arl') && old('casoIngreso2') != '' ? 'selected' : '' }}>{{ $ar->arl }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_arl')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('id_arl') }}
                        </div>            
                    @endif
                </div>
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <label for="checkVehiculo2">
                            ¿El colaborador ingresa vehículo?
                        </label>
                        <input type="checkbox" id="checkVehiculo2">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectEmpresa2">Ingrese la empresa a la que pertenece</label>
                    <select id="selectEmpresa2" class="colaborador2 form-control {{ $errors->has('id_empresa') && old('casoIngreso2') != '' ? 'is-invalid' : '' }}" style="width: 100%;" name="id_empresa"
                        required>
                        <option selected="selected" value="" disabled>Seleccione la empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id_empresas}}"
                                {{ $empresa->id_empresas == old('id_empresa') && old('casoIngreso2') != '' ? 'selected' : '' }}>{{ $empresa->nombre }}
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
                    <textarea id="inputDescripcion2" class="colaborador2 form-control {{ $errors->has('descripcion') && old('casoIngreso2') != '' ? ' is-invalid ' : '' }}" name="descripcion">
                        {{ old('casoIngreso2') != '' ? old('descripcion') : '' }}
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
    <div class="card-footer mt-n2">
        <button id="botonCrear3" type='submit' class="btn btn-primary">Crear</button>
        <button id="botonLimpiar3" type='button' class="btn btn-secondary">Limpiar</button>
    </div>
    <!-- /.card-footer-->
    
</div>
<!-- /.card -->