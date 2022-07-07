@if (session('registro_persona'))
    <div class="modal fade" id="modal-crear-persona">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se registro el ingreso del <b>{{ session('registro_persona')[0] }}</b> exitosamente.</p>
                    <p>¿Desea realizar otro registro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('registro_vehiculo'))
    <div class="modal fade" id="modal-crear-personaVehiculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se registro el ingreso del <b>{{ session('registro_vehiculo')[0] }}</b> exitosamente.</p>
                    <p>Se registro el ingreso del vehículo <b>{{ session('registro_vehiculo')[1] }}</b> exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('registro_activo'))
    <div class="modal fade" id="modal-crear-personaActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se registro el ingreso del <b>{{ session('registro_activo')[0] }}</b> exitosamente.</p>
                    <p>Se registro el ingreso del activo <b>{{ session('registro_activo')[1] }}</b> exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('registro_vehiculoActivo'))
    <div class="modal fade" id="modal-crear-personaVehiculoActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se registro el ingreso del <b>{{ session('registro_vehiculoActivo')[0] }}</b> exitosamente.</p>
                    <p>Se registro el ingreso del vehículo <b>{{ session('registro_vehiculoActivo')[1] }}</b> exitosamente.</p>
                    <p>Se registro el ingreso del activo <b>{{ session('registro_vehiculoActivo')[2] }}</b> exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endif


<div class="modal fade" id="modal-registro-salida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="justify-content-between">
                    <h4 class="modal-title">Registro de salida</h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="parrafo"></p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>