@if (session('crear_vehiculo'))
    <div class="modal fade" id="modal-crear-vehiculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">VEHICULO CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Vehículo con identificador <b>{{ session('crear_vehiculo')}}</b> creado exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100px">Si</button>
                    <button type="submit" class="botonContinuar btn" style="background-color: rgb(255, 115, 0)">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('asignar_vehiculo'))
    <div class="modal fade" id="modal-asignar-vehiculo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">ASIGNACIÓN COMPLETADA</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se ha asignado el vehículo <b>{{ session('asignar_vehiculo')[0] }}</b> a la persona <b>{{ session('asignar_vehiculo')[1] }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@elseif (session('editar_vehiculo'))
    <div class="modal fade" id="modal-editar-vehiculo">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <div class="justify-content-between">
                        <h4 class="modal-title">VEHICULO ACTUALIZADO</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se ha actualizado al vehículo con identificador <b>{{ session('editar_vehiculo') }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif