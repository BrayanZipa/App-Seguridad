@if ($errors->has('nombre') || $errors->has('apellido') || $errors->has('identificacion') || $errors->has('email') || $errors->has('tel_contacto') || 
    $errors->has('id_eps') || $errors->has('id_arl') || $errors->has('id_empresa') || $errors->has('colaborador') || $errors->has('ficha') || $errors->has('descripcion') || $errors->has('foto'))
    <div class="text-center" style="display: none">
        <button type="button" id="botonRetorno" class="btn btn-danger">Error</button>
    </div>

@elseif ($errors->has('identificador') || $errors->has('id_tipo_vehiculo') || $errors->has('id_marca_vehiculo') || $errors->has('foto_vehiculo'))
    <div class="text-center" style="display: none">
        <button type="button" id="botonRetorno2" class="btn btn-danger">Error</button>
    </div>

@elseif ($errors->has('activo') || $errors->has('codigo'))
    <div class="text-center" style="display: none">
        <button type="button" id="botonRetorno3" class="btn btn-danger">Error</button>
    </div>

@endif

{{-- @if (count($errors) > 0)
    <div class="modal fade" id="modal-errores-personas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Error al ingresar los datos</h4>
                    <button type="button" class="botonError close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
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
@endif --}}
