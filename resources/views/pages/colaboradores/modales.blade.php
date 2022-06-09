@if (session('editar_colaborador'))
    <div class="modal fade" id="modal-editar-colaborador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>El visitante <b>{{ session('editar_colaborador') }}</b> ha cambiado su rol a colaborador exitosamente.</p>
                    <p>¿Desea permanecer en la página?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar2 btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('editar_colaborador_activo'))
    <div class="modal fade" id="modal-editar-colaboradorActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>El visitante <b>{{ session('editar_colaborador_activo')[0] }}</b> ha cambiado su rol a colaborador exitosamente.</p>
                    <p>Computador con código <b>{{ session('editar_colaborador_activo')[1] }}</b> actualizado exitosamente.</p>
                    <p>¿Desea permanecer en la página?</p>
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

@elseif (session('editar_colaborador_vehiculo'))
    <div class="modal fade" id="modal-editar-colaboradorVehiculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>El visitante <b>{{ session('editar_colaborador_vehiculo')[0] }}</b> ha cambiado su rol a colaborador exitosamente.</p>
                    <p>Vehículo con identificador <b>{{ session('editar_colaborador_vehiculo')[1] }}</b> creado exitosamente.</p>
                    <p>¿Desea permanecer en la página?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar2 btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('editar_colaborador_vehiculoActivo'))
    <div class="modal fade" id="modal-editar-colaboradorVehiculoActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>El visitante <b>{{ session('editar_colaborador_vehiculoActivo')[0] }}</b> ha cambiado su rol a colaborador exitosamente.</p>
                    <p>Vehículo con identificador <b>{{ session('editar_colaborador_vehiculoActivo')[1] }}</b> creado exitosamente.</p>
                    <p>Computador con código <b>{{ session('editar_colaborador_vehiculoActivo')[2] }}</b> creado exitosamente.</p>
                    <p>¿Desea permanecer en la página?</p>
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

@elseif (session('crear_colaborador'))
    <div class="modal fade" id="modal-crear-colaborador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se ha creado al colaborador <b>{{ session('crear_colaborador') }}</b> exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar2 btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('crear_colaborador_activo'))
    <div class="modal fade" id="modal-crear-colaboradorActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Colaborador <b>{{ session('crear_colaborador_activo')[0] }}</b> creado exitosamente.</p>
                    <p>Computador con código <b>{{ session('crear_colaborador_activo')[1] }}</b> creado exitosamente.</p>
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

@elseif (session('crear_colaborador_vehiculo'))
    <div class="modal fade" id="modal-crear-colaboradorVehiculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Colaborador <b>{{ session('crear_colaborador_vehiculo')[0] }}</b> creado exitosamente.</p>
                    <p>Vehículo con identificador <b>{{ session('crear_colaborador_vehiculo')[1] }}</b> creado exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar2 btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('crear_colaborador_vehiculoActivo'))
    <div class="modal fade" id="modal-crear-colaboradorVehiculoActivo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Colaborador <b>{{ session('crear_colaborador_vehiculoActivo')[0] }}</b> creado exitosamente.</p>
                    <p>Vehículo con identificador <b>{{ session('crear_colaborador_vehiculoActivo')[1] }}</b> creado exitosamente.</p>
                    <p>Computador con código <b>{{ session('crear_colaborador_vehiculoActivo')[2] }}</b> creado exitosamente.</p>
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

@elseif (session('editar_colaborador2'))
    <div class="modal fade" id="modal-editar-colaborador2">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">COLABORADOR ACTUALIZADO</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se ha actualizado al colaborador <b>{{ session('editar_colaborador2') }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('editar_colaborador_activo2'))
    <div class="modal fade" id="modal-editar-colaboradorActivo2">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="justify-content-between">
                        <h4 class="modal-title">COLABORADOR ACTUALIZADO</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se ha actualizado al colaborador <b>{{ session('editar_colaborador_activo2')[0] }}</b> exitosamente.</p>
                    <p>Se ha asigando el computador con código <b>{{ session('editar_colaborador_activo2')[1] }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif

<div class="modal fade" id="modalCambioRol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Cambiar a rol de visitante</h4>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px; text-align: center">¿Esta seguro que desea cambiar el rol del colaborador a visitante?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="botonError btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button id="botonConfirmar" type="button" class="btn btn-danger">Continuar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>