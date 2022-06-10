<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Crear nuevo registro</h3>
        <div class="card-tools">
            <button id="botonComprimirVisitante" type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->

    <div class="card-body mb-n4 mt-n1" >
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selectTipoPersona">Seleccione el tipo de persona</label>
                        <select id="selectTipoPersona" class="select2bs4 form-control" style="width: 100%;">
                            <option selected="selected" value="" disabled>Tipo de persona</option>
                            @foreach ($tipoPersonas as $tipo)
                                <option value="{{ $tipo->id_tipo_personas }}" {{ $tipo->id_tipo_personas == old('tipoPersona') ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                            @endforeach
                        </select>  
                </div>
            </div>
            <div id="buscarPersona" class="col-sm-6" style="display: none">
                <div class="form-group">
                    <label for="selectPersona">Seleccione a la persona</label>
                    <select id="selectPersona" class="select2bs4 form-control" style="width: 100%;" name="id_persona">
                        <option selected="selected" value="" disabled></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>