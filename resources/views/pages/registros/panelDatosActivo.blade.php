<div class="card card-primary mb-4 mx-n1">
    <div class="card-header pb-1">
        <h3 class="card-title">Registro colaborador</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool pb-3 mr-n1" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button id="botonCerrar3" type="button" class="btn btn-tool pb-3 mr-n3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body mb-n4">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Empresa</label><br>
                    <img id="logoEmpresa3" class="img-fluid rounded" src="" alt="Logo empresa">
                </div>
            </div>
            <div class="col-sm-10">
                <label>Información del registro</label>
                <div class="card card-primary card-tabs mx-1">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosIngreso3" data-toggle="pill" href="#datosIngreso3" role="tab" aria-controls="datosIngreso3" aria-selected="true">Datos de ingreso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosBasicos3" data-toggle="pill" href="#datosBasicos3" role="tab" aria-controls="datosBasicos3" aria-selected="false">Datos básicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="tabDatosActivo3" data-toggle="pill" href="#datosActivo3" role="tab" aria-controls="datosActivo3" aria-selected="false">Activo</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent3">
                            <div class="tab-pane fade" id="datosIngreso3" role="tabpanel" aria-labelledby="tabDatosIngreso3">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                    <span id="spanFecha3"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                    <span id="spanHora3"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>                                                   
                                    <div class="row"> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Descripción</h5>                                         
                                                    <p id="parrafoDescripcion3"></p>
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="datosBasicos3" role="tabpanel" aria-labelledby="tabDatosBasicos3">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Nombre</h5>                                         
                                                    <span id="spanNombre3"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Apellidos</h5>                                         
                                                    <span id="spanApellido3"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Identificación</h5>                                         
                                                    <span id="spanIdentificacion3"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Teléfono de contacto</h5>                                         
                                                    <span id="spanTelefono3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">EPS</h5>                                         
                                                    <span id="spanEps3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">ARL</h5>                                         
                                                    <span id="spanArl3"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Empresa a la que pertenece</h5>                                         
                                                    <span id="spanEmpresaCol3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Correo empresarial</h5>                                         
                                                    <span id="spanCorreo3"></span>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="datosActivo3" role="tabpanel" aria-labelledby="tabDatosActivo3">
                                <div class="ml-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                    <span id="spanFechaActivo3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                    <span id="spanHoraActivo3"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Tipo de activo</h5>                                         
                                                    <span id="spanTipoActivo3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Activo</h5>                                         
                                                    <span id="spanCodigoActivo3"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="columnaActivo2" class="col-sm-4" style="display: none">
                                            <div class="form-group mb-0">
                                                <div class="description-block text-left mb-0">
                                                    <h5 class="description-header mb-1">Cambio de activo</h5>
                                                    <span id="spanCodigoActivo4"></span>
                                                    <div class="mt-1">
                                                        <label id="autorizacion2"></label>
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
        </div>
    </div>
    <div class="card-footer">
        <button type='button' id="botonGuardarSalida3" class="btn btn-primary">Registrar salida</button>
    </div>
</div>