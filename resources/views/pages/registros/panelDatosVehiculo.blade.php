<div class="card card-orange mb-4 mx-n1">
    <div class="card-header pb-1">
        <h3 id="tabInfoRegistro2" class="card-title"></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool pb-3 mr-n1" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button id="botonCerrar2" type="button" class="btn btn-tool pb-3 mr-n3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body mb-n4">
        <div class="row">
            <div id="columnaFoto2" class="col-md-3 col-sm-12">
                <div id="divFotoPersona2" class="form-group">
                    <label>Fotografía</label><br>
                    <img id="fotoPersona2" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto persona">
                </div>
                <div id="divLogoEmpresa2" class="form-group">
                    <label>Empresa</label><br>
                    <div class="text-center">
                        <img id="logoEmpresa2" class="img-fluid rounded" src="" alt="Logo empresa">
                    </div>
                </div>
            </div>
            <div id="columnaInformacion2" class="col-md-9 col-sm-12">
                <label>Información del registro</label>
                <div class="card card-orange card-tabs mx-1">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosIngreso2" data-toggle="pill" href="#datosIngreso2" role="tab" aria-controls="datosIngreso2" aria-selected="true">Datos de ingreso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosBasicos2" data-toggle="pill" href="#datosBasicos2" role="tab" aria-controls="datosBasicos2" aria-selected="false">Datos básicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="tabDatosVehiculo2" data-toggle="pill" href="#datosVehiculo2" role="tab" aria-controls="datosVehiculo2" aria-selected="false">Vehículo</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent2">
                            <div class="tab-pane fade" id="datosIngreso2" role="tabpanel" aria-labelledby="tabDatosIngreso2">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                    <span id="spanFecha2"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                    <span id="spanHora2"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>                                                   
                                    <div class="row"> 
                                        <div id="infoVisitanteConductor2" class="col-md-8 col-sm-12">
                                            <div class="row"> 
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Empresa que visita</h5>                                         
                                                            <span id="spanEmpresa2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>                             
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Colaborador a cargo</h5>                                         
                                                            <span id="spanColaborador2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="columnaDescripcion2" class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Descripción</h5>                                         
                                                    <p id="parrafoDescripcion2"></p>
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="datosBasicos2" role="tabpanel" aria-labelledby="tabDatosBasicos2">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Nombre</h5>                                         
                                                    <span id="spanNombre2"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Apellidos</h5>                                         
                                                    <span id="spanApellido2"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Identificación</h5>                                         
                                                    <span id="spanIdentificacion2"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 id="tituloTelefono2" class="description-header mb-1"></h5>                                         
                                                    <span id="spanTelefono2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">EPS</h5>                                         
                                                    <span id="spanEps2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">ARL</h5>                                         
                                                    <span id="spanArl2"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="infoColaborador2" class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Empresa a la que pertenece</h5>                                         
                                                    <span id="spanEmpresaCol2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Correo empresarial</h5>                                         
                                                    <span id="spanCorreo2"></span>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="datosVehiculo2" role="tabpanel" aria-labelledby="tabDatosVehiculo2">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12">
                                        <div class="ml-4">
                                            <div class="row">                              
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                            <span id="spanFechaVehiculo2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                            <span id="spanHoraVehiculo2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>                                                   
                                            <div class="row">                              
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Identificador</h5>                                         
                                                            <span id="spanIdentificador2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Tipo de vehículo</h5>                                         
                                                            <span id="spanTipo2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Marca del vehículo</h5>                                         
                                                            <span id="spanMarca2"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-n4">
                                        <div class="form-group">
                                            <label class="ml-4">Fotografía vehículo</label>
                                            <img id="fotoVehiculo2" class="img-fluid rounded" style="border: 1px solid #fd7e14" src="" alt="Foto vehículo">
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
    @can('registrarSalida')
        <div class="card-footer">
            <button type='button' id="botonGuardarSalida2" class="btn" style="background-color: rgb(255, 115, 0)">Registrar salida</button>
        </div> 
    @endcan
</div>