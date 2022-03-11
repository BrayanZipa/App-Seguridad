{{-- <div class="row">
    <div class="col-md-12"> --}}

        <form action="{{ route('crearVisitante') }}" method="POST">
            @csrf

            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title">Crear nuevo vehículo</h3>
                    <div class="card-tools">
                        <button id="botonComprimirVehiculo" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        <button id="botonCerrar2" type="button" class="btn btn-tool">
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
                                <label for="inputNombre">Ingrese el número identificador del vehículo</label>
                                <input type="text" class="form-control" id="inputNombre" name="nombre"
                                    placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ingrese el tipo de vehículo</label>
                                <select class="form-control select2" style="width: 100%;" name="id_eps" required>
                                    <option selected="selected" value="" disabled>Seleccione el tipo</option>
                                    @foreach ($eps as $ep)
                                        <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ingrese la marca del vehículo</label>
                                <select class="form-control select2" style="width: 100%;" name="id_arl" required>
                                    <option selected="selected" value=""  disabled>Seleccione la marca</option>
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
                                <select class="form-control select2" style="width: 100%;" name="id_eps" required
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
                    <button id="botonCrear2" type='submit' class="btn" style="background-color: rgb(255, 115, 0)">Crear vehículo</button>
                    <button id="botonLimpiar2" type='reset' class="btn btn-secondary">Limpiar</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </form>
            
    {{-- </div>
</div> --}}