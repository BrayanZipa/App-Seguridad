    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Crear nuevo activo</h3>
            <div class="card-tools">
                <button id="botonComprimirActivo" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
                <button id="botonCerrar3" type="button" class="btn btn-tool">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="inputActivo">Ingrese el tipo de activo</label>
                        <input type="text" class="activo form-control {{ $errors->has('activo') ? 'is-invalid' : '' }}" id="inputActivo" name="activo" value="{{ old('activo') }}"
                            required>
                            @if ($errors->has('activo')) 
                                <div class="invalid-feedback">
                                    {{ $errors->first('activo') }}
                                </div>          
                            @endif 
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="inputCodigo">Ingrese el código único del activo</label>
                        <input type="text" class="activo form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" id="inputCodigo" name="codigo"
                            value="{{ old('codigo') }}" autocomplete="off" required>
                            @if ($errors->has('codigo')) 
                                <div class="invalid-feedback">
                                    {{ $errors->first('codigo') }}
                                </div>          
                            @endif 
                    </div>
                </div>
                {{-- <div class="col-sm-4" style="display:none">
                    <div class="form-group">
                        <label>Ingrese al propietario del activo</label>
                        <select class="activo form-control select2" style="width: 100%;" name="id_persona" disabled required>
                            <option selected="selected" value=""  disabled>Seleccione al propietario</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id_personas }}">{{ $persona->nombre }} {{ $persona->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button id="botonCrear3" type='submit' class="btn btn-dark">Crear todo</button>
            <button id="botonLimpiar3" type='button' class="btn btn-secondary">Limpiar</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->