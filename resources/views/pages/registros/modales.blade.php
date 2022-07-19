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

<div class="modal fade" id="modal-salida-persona">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="d-flex justify-content-center">
                    <h4 class="modal-title">REGISTRO DE SALIDA</h4>
                </div>
            </div>
            <div class="modal-body">
                <p>Se registro la salida del <b class="textoPersona"></b> exitosamente.</p>
                <p>¿Desea registrar otra salida?</p>
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

<div class="modal fade" id="modal-salida-personaVehiculo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="justify-content-between">
                    <h4 class="modal-title">REGISTRO DE SALIDA</h4>
                </div>
            </div>
            <div class="modal-body">
                <p>Se registro la salida del <b class="textoPersona"></b> exitosamente.</p>
                <p>Se registro la salida del vehículo <b class="textoVehiculo"></b> exitosamente.</p>
                <p>¿Desea registrar otra salida?</p>
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

<div class="modal fade" id="modal-salida-personaActivo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="justify-content-between">
                    <h4 class="modal-title">REGISTRO CREADO</h4>
                </div>
            </div>
            <div class="modal-body">
                <p>Se registro la salida del <b class="textoPersona"></b> exitosamente.</p>
                <p>Se registro la salida del activo <b class="textoActivo"></b> exitosamente.</p>
                <p>¿Desea registrar otra salida?</p>
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

<div class="modal fade" id="modal-salida-personaVehiculoActivo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="justify-content-between">
                    <h4 class="modal-title">REGISTRO CREADO</h4>
                </div>
            </div>
            <div class="modal-body">
                <p>Se registro la salida del <b class="textoPersona"></b> exitosamente.</p>
                <p>Se registro la salida del vehículo <b class="textoVehiculo"></b> exitosamente.</p>
                <p>Se registro la salida del activo <b class="textoActivo"></b> exitosamente.</p>
                <p>¿Desea registrar otra salida?</p>
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

<div class="modal fade" id="modal-registrarSalida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="d-flex justify-content-center">
                    <h4 class="modal-title">REGISTRAR SALIDA</h4>
                </div>
            </div>
            <div class="modal-body">
                <p class="text-center" style="font-size: 18px">¿Esta seguro que desea registrar la salida del <b id="textoSalida"></b>?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100px">Cerrar</button>
                <button type="submit" id="botonContinuarSalida" class="btn btn-primary">Continuar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>