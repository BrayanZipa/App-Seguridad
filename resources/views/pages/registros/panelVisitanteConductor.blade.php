<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>Fotografía</label>
            <img id="fotoPersona" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto persona">
        </div>
    </div>
    <div class="col-sm-9">
        <label>Información del registro</label>
        <div id="cardPersona" class="card card-primary card-tabs ml-1 mr-n1">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabDatosIngreso" data-toggle="pill" href="#datosIngreso" role="tab" aria-controls="datosIngreso" aria-selected="true">Datos de ingreso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabDatosBasicos" data-toggle="pill" href="#datosBasicos" role="tab" aria-controls="datosBasicos" aria-selected="false">Datos básicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabDatosActivo" data-toggle="pill" href="#datosActivo" role="tab" aria-controls="datosActivo" aria-selected="false">Activo</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="datosIngreso" role="tabpanel" aria-labelledby="tabDatosIngreso">
                        <div class="ml-4">
                            <div class="row">                              
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                            <span id="spanFecha"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                            <span id="spanHora"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Empresa que visita</h5>                                         
                                            <span id="spanEmpresa"></span>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>                                                   
                            <div class="row">                              
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Colaborador a cargo</h5>                                         
                                            <span id="spanColaborador"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Descripción</h5>                                         
                                            <p id="parrafoDescripcion"></p>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="tab-pane fade" id="datosBasicos" role="tabpanel" aria-labelledby="tabDatosBasicos">
                        <div class="ml-4">
                            <div class="row">                              
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Nombre</h5>                                         
                                            <span id="spanNombre"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Apellidos</h5>                                         
                                            <span id="spanApellido"></span>
                                        </div>                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Identificación</h5>                                         
                                            <span id="spanIdentificacion"></span>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 id="tituloTelefono" class="description-header mb-1"></h5>                                         
                                            <span id="spanTelefono"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">EPS</h5>                                         
                                            <span id="spanEps"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">ARL</h5>                                         
                                            <span id="spanArl"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="datosActivo" role="tabpanel" aria-labelledby="tabDatosActivo">
                        <div class="ml-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                            <span id="spanFechaActivo"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                            <span id="spanHoraActivo"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Tipo de activo</h5>                                         
                                            <span id="spanTipoActivo"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="description-block text-left">
                                            <h5 class="description-header mb-1">Código del activo</h5>                                         
                                            <span id="spanCodigoActivo"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="form-group clearfix">  
                                        <div class="icheck-primary d-inline">
                                            <label for="checkActivo">
                                                ¿La persona sale sin activo?
                                            </label>
                                            <input type="checkbox" id="checkActivo">
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