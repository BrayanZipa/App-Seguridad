<div id="panel" class="card card-primary">
    <div id="cardHeader" class="card-header">
        <h3 id="tabInfoRegistro" class="card-title"></h3>
        <div class="card-tools">
            <button id="botonCollapse" type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button id="botonCerrar" type="button" class="btn btn-tool">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body mb-n4">
        <div class="row">
            <div id="columnaFoto" class="col-md-3 col-sm-12">
                <div id="divFotoPersona" class="form-group">
                    <label>Fotografía</label><br>
                    <img id="fotoPersona" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto persona">
                </div>
                <div id="divLogoEmpresa" class="form-group">
                    <label>Empresa</label><br>
                    <div class="text-center">
                        <img id="logoEmpresa" class="img-fluid rounded" src="" alt="Logo empresa">
                    </div>
                </div>
            </div>
            <div id="columnaInformacion" class="col-md-9 col-sm-12">
                <label>Información del registro</label>
                <div class="card card-primary card-tabs mx-1">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabDatosIngreso" data-toggle="pill" href="#datosIngreso" role="tab" aria-controls="datosIngreso" aria-selected="true">Datos de ingreso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosBasicos" data-toggle="pill" href="#datosBasicos" role="tab" aria-controls="datosBasicos" aria-selected="false">Datos básicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosActivo" data-toggle="pill" href="#datosActivo" role="tab" aria-controls="datosActivo" aria-selected="false">Activo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabDatosVehiculo" data-toggle="pill" href="#datosVehiculo" role="tab" aria-controls="datosVehiculo" aria-selected="false">Vehículo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabHistorial" data-toggle="pill" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent1">
                            <div class="tab-pane fade active show" id="datosIngreso" role="tabpanel" aria-labelledby="tabDatosIngreso">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                    <span id="spanFecha"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                    <span id="spanHora"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div id="infoSalidaPersona" class="col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Fecha de salida</h5>
                                                            <span id="spanFechaSalida"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Hora de salida</h5>
                                                            <span id="spanHoraSalida"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                   
                                    <div class="row"> 
                                        <div id="infoVisitanteConductor" class="col-md-6 col-sm-12">
                                            <div class="row"> 
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Empresa que visita</h5>                                         
                                                            <span id="spanEmpresa"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>                             
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Colaborador a cargo</h5>                                         
                                                            <span id="spanColaborador"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="columnaDescripcion" class="col-md-6 col-sm-12">
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
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Nombre</h5>                                         
                                                    <span id="spanNombre"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Apellidos</h5>                                         
                                                    <span id="spanApellido"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Identificación</h5>                                         
                                                    <span id="spanIdentificacion"></span>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 id="tituloTelefono" class="description-header mb-1"></h5>                                         
                                                    <span id="spanTelefono"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">EPS</h5>                                         
                                                    <span id="spanEps"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4  col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">ARL</h5>                                         
                                                    <span id="spanArl"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="infoColaborador" class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Empresa a la que pertenece</h5>                                         
                                                    <span id="spanEmpresaCol"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Correo empresarial</h5>                                         
                                                    <span id="spanCorreo"></span>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="datosActivo" role="tabpanel" aria-labelledby="tabDatosActivo">
                                <div class="ml-4">
                                    <div class="row">
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                    <span id="spanFechaActivo"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                    <span id="spanHoraActivo"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="infoSalidaActivo" class="col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Fecha de salida</h5>
                                                            <span id="spanFechaSalidaActivo"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Hora de salida</h5>
                                                            <span id="spanHoraSalidaActivo"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <div class="description-block text-left">
                                                    <h5 class="description-header mb-1">Tipo de activo</h5>                                         
                                                    <span id="spanTipoActivo"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="columnaPanel col-md-3 col-sm-6">
                                            <div class="form-group mb-0">
                                                <div class="description-block text-left mb-0">
                                                    <h5 class="description-header mb-1">Activo</h5>                                        
                                                    <span id="spanCodigoActivo"></span>
                                                    <div class="mt-1">
                                                        <label id="autorizacion"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="columnaActivo" class="columnaPanel col-md-3 col-sm-12" style="display: none">
                                            <div class="form-group mb-0">
                                                <div class="description-block text-left mb-0">
                                                    <h5 id="tituloActivo" class="description-header mb-1">Cambio de activo</h5>
                                                    <span id="spanCodigoActivo2"></span>
                                                    <div class="mt-1">
                                                        <label id="autorizacion2"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('registrarSalida')
                                        <div id="divActivo" class="row mt-3 mb-n3">
                                            <div class="col-12">
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
                                    @endcan
                                </div>
                            </div>
                            <div class="tab-pane fade" id="datosVehiculo" role="tabpanel" aria-labelledby="tabDatosVehiculo">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12">
                                        <div class="ml-4">
                                            <div class="row">                              
                                                <div class="columnaPanel col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Fecha de ingreso</h5>                                         
                                                            <span id="spanFechaVehiculo"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="columnaPanel col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Hora de ingreso</h5>                                         
                                                            <span id="spanHoraVehiculo"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div id="infoSalidaVehiculo" class="col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <div class="description-block text-left">
                                                                    <h5 class="description-header mb-1">Fecha de salida</h5>
                                                                    <span id="spanFechaSalidaVehiculo"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <div class="description-block text-left">
                                                                    <h5 class="description-header mb-1">Hora de salida</h5>
                                                                    <span id="spanHoraSalidaVehiculo"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                   
                                            <div class="row">                              
                                                <div class="columnaPanel col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Identificador</h5>                                         
                                                            <span id="spanIdentificador"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="columnaPanel col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Tipo de vehículo</h5>                                         
                                                            <span id="spanTipo"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                                <div class="columnaPanel col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="description-block text-left">
                                                            <h5 class="description-header mb-1">Marca del vehículo</h5>                                         
                                                            <span id="spanMarca"></span>
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                            @can('registrarSalida')
                                                <div id="divVehiculo" class="row mt-3 mb-n3">
                                                    <div class="col-12">
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-primary d-inline">
                                                                <label for="checkVehiculo">
                                                                    ¿La persona sale sin vehículo?
                                                                </label>
                                                                <input type="checkbox" id="checkVehiculo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            @endcan
                                        </div> 
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-n4">
                                        <div class="form-group">
                                            <label class="ml-4">Fotografía vehículo</label>
                                            <img id="fotoVehiculo" class="img-fluid rounded" style="border: 1px solid #fd7e14" src="" alt="Foto vehículo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="tabHistorial">
                                <div class="ml-4">
                                    <div class="row">                              
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="selectAnio">Filtrar registros por año</label>
                                                <select id="selectAnio" class="form-control" style="width: 100%;">
                                                    <option selected="selected" value="" disabled>Seleccione el año</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="selectMes">Filtrar registros por mes</label>
                                                <select id="selectMes" class="form-control" style="width: 100%;">
                                                    <option selected="selected" value="" disabled>Seleccione el mes</option>
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="6">Junio</option>
                                                    <option value="7">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Total registros</label>
                                                <input type="text" id="totalRegistros" class="form-control" disabled>
                                            </div>
                                        </div>                                      
                                    </div>
                                    <div class="row">                              
                                        <div class="col-12">
                                            <div id="tablaRegistros" class="table-responsive" style="display: none">
                                                <table class="table m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha de ingreso</th>
                                                            <th>Hora de ingreso</th>
                                                            <th>Fecha de salida</th>
                                                            <th>Hora de salida</th>
                                                            <th>Ingresa vehículo</th>
                                                            <th>Ingresa activo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaRegistrosFilas"></tbody>
                                                </table>
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
    @can('registrarSalida')
        <div id="footerPanel" class="card-footer">
            <button type='button' id="botonGuardarSalida" class="btn btn-primary">Registrar salida</button>
        </div> 
    @endcan
</div>