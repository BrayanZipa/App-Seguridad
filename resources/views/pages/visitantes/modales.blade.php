@if (session('crear_visitante'))
    <div class="modal fade" id="modal-crear">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="justify-content-between">
                        <h4 class="modal-title">VISITANTE CREADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se ha creado al visitante {{ session('crear_visitante') }} exitosamente.</p>
                    <p>¿Desea crear otro?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="botonSi" type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px">Si</button>
                    <button id="botonContinuar" type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
@elseif (session('editar_visitante'))
    <div class="modal fade" id="modal-editar">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="justify-content-between">
                        <h4 class="modal-title">VISITANTE ACTUALIZADO</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se ha actualizado al visitante {{ session('editar_visitante') }} exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif
