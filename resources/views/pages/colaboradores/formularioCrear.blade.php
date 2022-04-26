<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Crear nuevo colaborador</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectCodigo">Ingrese el activo</label>
                    <select name="activo" id="selectCodigo" class="form-control">
                        <option selected="selected" value="" disabled>Seleccione código</option>
                        @foreach ($computadores as $computador)
                            <option value="{{ $computador['users_id'] }}"
                            {{ $computador['users_id'] == old('activo') ? 'selected' : '' }}>{{ $computador['name'] }}
                            </option>
                        @endforeach

                        {{-- @foreach ($computadores as $computador)
                            <option value="{{ $computador->users_id }}"
                                {{ $computador->users_id == old('activo') ? 'selected' : '' }}>{{ $computador->name }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputNombre">Ingrese el nombre</label>
                    <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Nombre" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputApellido">Ingrese el apellido</label>
                    <input type="text" class="form-control" id="inputApellido" name="apellido" value="{{ old('apellido') }}"
                        placeholder="Apellido" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputIdentificacion">Ingrese la identificación</label>
                    <input type="text" class="form-control" id="inputIdentificacion"
                        name="identificacion" value="{{ old('identificacion') }}" placeholder="Identificación" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="inputTelefono">Ingrese el teléfono</label>
                    <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto" value="{{ old('tel_contacto') }}"
                        placeholder="Teléfono" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectEps">Ingrese la EPS</label>
                    <select id="selectEps" class="form-control select2" style="width: 100%;" name="id_eps" required>
                        <option selected="selected" value="" disabled>Seleccione la EPS</option>
                        @foreach ($eps as $ep)
                            <option value="{{ $ep->id_eps }}"
                                {{ $ep->id_eps == old('id_eps') ? 'selected' : '' }}>{{ $ep->eps }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectArl">Ingrese el ARL</label>
                    <select id="selectArl" class="form-control select2" style="width: 100%;" name="id_arl" required>
                        <option selected="selected" value="" disabled>Seleccione la ARL</option>
                        @foreach ($arl as $ar)
                            <option value="{{ $ar->id_arl }}"
                                {{ $ar->id_arl == old('id_arl') ? 'selected' : '' }}>{{ $ar->arl }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selectEmpresa">Ingrese la empresa de vinculación</label>
                    <select id="selectEmpresa" class="form-control select2" style="width: 100%;" name="id_empresa"
                        required>
                        <option selected="selected" value="" disabled>Seleccione la empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id_empresas}}"
                                {{ $empresa->id_empresas == old('id_empresa') ? 'selected' : '' }}>{{ $empresa->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type='submit' class="btn btn-primary">Crear colaborador</button>
        <button type='reset' class="btn btn-secondary">Limpiar</button>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->