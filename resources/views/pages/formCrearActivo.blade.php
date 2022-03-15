{{-- <form action="{{ route('crearVisitante') }}" method="POST">
    @csrf --}}

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
                        <input type="text" class="activo form-control" id="inputActivo" name="activo" value="Computador" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="inputCodigo">Ingrese el código único del activo</label>
                        <input type="text" class="activo form-control" id="inputCodigo" name="codigo" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Ingrese al propietario del activo</label>
                        <select class="activo form-control select2" style="width: 100%;" name="id_persona" required>
                            <option selected="selected" value=""  disabled>Seleccione al propietario</option>
                            @foreach ($arl as $ar)
                                <option value="{{ $ar->id_arl }}">{{ $ar->arl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Ingrese al propietario del vehículo</label>
                        <select class="activo form-control select2" style="width: 100%;" name="id_eps" required
                            disabled>                                             
                            <option selected="selected" value="" disabled>Seleccione al propietario</option>
                            @foreach ($eps as $ep)
                                <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button id="botonCrear3" type='submit' class="btn btn-dark" >Crear todo</button>
            <button id="botonLimpiar3" type='button' class="btn btn-secondary">Limpiar</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</form>