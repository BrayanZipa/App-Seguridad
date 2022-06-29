<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Crear nuevo conductor</h3>
        <div class="card-tools">
            <button id="botonComprimirConductor" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body mb-n4">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputFoto">Fotografía</label>

                    <input type="hidden" id="inputFoto" class="{{ $errors->has('foto') ? 'is-invalid' : '' }}" name="foto" value="{{ old('foto') }}">

                    <video src="" id="video" class="img-fluid rounded" style="display: none"></video>
                    <canvas id="canvas" class="img-fluid rounded" style="display: none"></canvas>

                    @if ($errors->has('foto')) 
                        <div class="invalid-feedback">
                            {{ $errors->first('foto') }}
                        </div>            
                    @endif

                    <div class="mt-2">
                        <button id="botonActivar" type="button" class="btn btn-primary btn-sm">Activar</button>
                        <button id="botonCapturar" type="button" class="btn btn-primary btn-sm"
                            style="display: none">Capturar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputNombre">Ingrese el nombre</label>
                            <input type="text" class="conductor form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="inputNombre" name="nombre"
                                value="{{ old('nombre') }}" autocomplete="off" placeholder="Nombre" autofocus required>
                                @if ($errors->has('nombre')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nombre') }}
                                    </div>            
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputApellido">Ingrese el apellido</label>
                            <input type="text" class="conductor form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" id="inputApellido" name="apellido"
                                value="{{ old('apellido') }}" autocomplete="off" placeholder="Apellido" required>
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
                            <label for="inputIdentificacion">Ingrese la identificación</label>
                            <input type="text" class="conductor form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" id="inputIdentificacion" autocomplete="off"
                                name="identificacion" value="{{ old('identificacion') }}" placeholder="Identificación"
                                required>
                                @if ($errors->has('identificacion')) 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('identificacion') }}
                                    </div>          
                                @endif  
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputTelefono">Ingrese un teléfono</label>
                            <input type="tel" class="conductor form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}" id="inputTelefono" name="tel_contacto"
                                value="{{ old('tel_contacto') }}" autocomplete="off" placeholder="Teléfono" required>
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
                            <label for="selectEps">Ingrese la EPS</label>
                            <select id="selectEps" class="conductor select2bs4 form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;"
                                name="id_eps" required>
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
                            <label for="selectArl">Ingrese la ARL</label>
                            <select id="selectArl" class="conductor select2bs4 form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;"
                                name="id_arl" required>
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
                            <select id="selectEmpresa" class="conductor form-control {{ $errors->has('empresa_visitada') ? 'is-invalid' : '' }}" style="width: 100%;"
                                name="empresa_visitada" required>
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
                            <input type="text" class="conductor form-control {{ $errors->has('colaborador') ? ' is-invalid ' : '' }}" id="inputColaborador" name="colaborador"
                                value="{{ old('colaborador') }}" autocomplete="off" placeholder="Colaborador" required>
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
                            <textarea class="conductor form-control {{ $errors->has('descripcion') ? ' is-invalid ' : '' }}" name="descripcion" id="inputDescripcion">
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
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
