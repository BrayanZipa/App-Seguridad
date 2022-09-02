    <div class="card card-dark mt-n2">
        <div class="card-header">
            <h3 class="card-title">Crear nuevo activo</h3>
            <div class="card-tools">
                <button id="botonComprimirActivo" type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button id="botonCerrar3" type="button" class="btn btn-tool">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->

        <div class="card-body mb-n4">
            <div class="row">
                <div class="col-md-4 col-sm-12">
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="inputCodigo">Ingrese el código único del activo</label>
                        <input type="text" class="activo form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" id="inputCodigo" name="codigo"
                            value="{{ old('codigo') }}" autocomplete="off" placeholder="Código" required>
                            @if ($errors->has('codigo')) 
                                <div class="invalid-feedback">
                                    {{ $errors->first('codigo') }}
                                </div>          
                            @endif 
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        @can('crearVisitante')
            <div class="card-footer">
                <button id="botonCrear3" type='submit' class="btn btn-dark">Crear todo</button>
                <button id="botonLimpiar3" type='button' class="btn btn-secondary">Limpiar</button>
            </div>
        @endcan
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->