@if (session('rol_asignado'))
    <div class="modal fade" id="modal-asignar-rol">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="d-flex justify-content-center">
                        <h4 class="modal-title">ROL ASIGNADO</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Se ha asignado el rol de <b>{{ session('rol_asignado')[0] }}</b> al usuario <b>{{ session('rol_asignado')[1] }}</b> exitosamente.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif