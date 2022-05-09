@if (session('crear_colaborador'))
    <div class="modal fade" id="modal-crear-colaborador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">REGISTRO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Colaborador <b>{{ session('crear_colaborador')[0] }}</b> creado exitosamente.</p>
                    <p>Computador con código <b>{{ session('crear_colaborador')[1] }}</b> creado exitosamente.</p>
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
                    <button type="submit" class="botonContinuar btn btn-primary">Continuar</button>
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

@elseif (session('editar_colaborador'))
    <div class="modal fade" id="modal-editar-colaborador">
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
                    <p>Se ha actualizado al colaborador <b>{{ session('editar_colaborador') }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
{{-- @endif --}}

@elseif  (session('colaborador_repetido'))
    <div class="modal fade" id="modal-colaboradorRepetido">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Colaborador repetido</h4>
                    <button type="button" class="botonError close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('colaborador_repetido') }}
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="botonError" type="button" class="botonError btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endif