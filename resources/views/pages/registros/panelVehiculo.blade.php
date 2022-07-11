<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>Fotografía vehículo</label>
            <img id="fotoVehiculo" class="img-fluid rounded" style="border: 1px solid #fd7e14" src="" alt="Foto vehículo">
        </div>
    </div>
    <div class="col-sm-9">
        <label>Información del vehículo</label>
        <div id="cardVehiculo" class="card card-orange card-tabs ml-1 mr-n1">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabDatosIngresoVehiculo" data-toggle="pill" href="#datosIngresoVehiculo" role="tab" aria-controls="datosIngresoVehiculo" aria-selected="true">Datos de ingreso</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="datosIngresoVehiculo" role="tabpanel" aria-labelledby="tabDatosIngresoVehiculo">
                        <div class="ml-4">
                            <div class="row">                              
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                            <span id="spanFechaVehiculo"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                            <span id="spanHoraVehiculo"></span>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>                                                   
                            <div class="row">                              
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Identificador</h5>                                         
                                            <span id="spanIdentificador"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Tipo de vehículo</h5>                                         
                                            <span id="spanTipo"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Marca del vehículo</h5>                                         
                                            <span id="spanMarca"></span>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>