<div class="row mb-n2">
    <div class="col-md-12">
        {{-- <form id="form_registroSalida" action="" method="POST" >
            @csrf
            @method('PUT') --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 id="titulo" class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button id="botonCerrar" type="button" class="btn btn-tool">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                <div class="card-body mb-n4">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="hidden" id="idRegistro">
                            <input type="hidden" id="idTipoPersona">
                            <div class="form-group">
                                <label>Fotografía</label>
                                <img id="fotoPersona" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto persona">
                            </div>

                                {{-- <div class="form-group">
                                    <input type="hidden" id="inputId" name="id_personas" value="{{ old('id_personas') }}">
                                    <input type="hidden" id="inputFoto" class="{{ $errors->has('foto') ? 'is-invalid' : '' }}" name="foto" value="{{ old('foto') }}">
                                    <img id="fotoConductor" class="img-fluid rounded" style="border: 1px solid #007bff" src="" alt="Foto conductor">
                                    @if ($errors->has('foto')) 
                                        <div class="invalid-feedback">
                                            {{ $errors->first('foto') }}
                                        </div>            
                                    @endif
                                </div> --}}

                        {{-- <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputNombre">Nombre</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="inputNombre" name="nombre" value="{{ old('nombre') }}" autocomplete="off"
                                            placeholder="Nombre" readonly required>
                                        @if ($errors->has('nombre')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nombre') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputApellido">Apellido</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" id="inputApellido" name="apellido" value="{{ old('apellido') }}" autocomplete="off"
                                            placeholder="Apellido" readonly required>
                                        @if ($errors->has('apellido')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('apellido') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Identificación</label>
                                        <input type="text" class="conductor form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" id="inputIdentificacion" name="identificacion" autocomplete="off"
                                        value="{{ old('identificacion') }}" placeholder="Identificación" readonly required>
                                        @if ($errors->has('identificacion')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('identificacion') }}
                                            </div>          
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputTelefono">Actualizar teléfono</label>
                                        <input type="tel" class="conductor form-control {{ $errors->has('tel_contacto') ? 'is-invalid' : '' }}"  id="inputTelefono" name="tel_contacto" value="{{ old('tel_contacto') }}" autocomplete="off"
                                            placeholder="Teléfono" required>
                                        @if ($errors->has('tel_contacto')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tel_contacto') }}
                                            </div>          
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputEps">Actualizar EPS</label>
                                        <select class="conductor select2bs4 form-control {{ $errors->has('id_eps') ? 'is-invalid' : '' }}" style="width: 100%;" id="inputEps" name="id_eps"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}"
                                                    {{ $ep->id_eps == old('id_eps') ? 'selected' : '' }}>{{ $ep->eps }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_eps')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_eps') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputArl">Actualizar ARL</label>
                                        <select class="conductor select2bs4 form-control {{ $errors->has('id_arl') ? 'is-invalid' : '' }}" style="width: 100%;" id="inputArl" name="id_arl"
                                            required>
                                            <option selected="selected" value="" disabled></option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}"
                                                    {{ $ar->id_arl == old('id_arl') ? 'selected' : '' }}>{{ $ar->arl }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_arl')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_arl') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="row mt-2">
                            <div class="col-12"> --}}

                                <!-- checkbox -->
                                <div class="form-group clearfix mt-n2 mb-1">
                                    <input type="hidden" id="inputVehiculo" name="casoRegistro">
                                    <div class="icheck-primary d-inline">
                                        <label for="checkVehiculo">
                                            ¿La persona sale sin vehículo?
                                        </label>
                                        <input type="checkbox" id="checkVehiculo">
                                    </div><br>
                                    <div class="icheck-primary d-inline">
                                        <label for="checkActivo">
                                            ¿La persona sale sin activo?
                                        </label>
                                        <input type="checkbox" id="checkActivo">
                                    </div>
                                </div>

                            {{-- </div>
                        </div> --}}
                        </div>

                        {{-- <div class="col-sm-9">
                            <strong class="ml-4">Datos de la visita</strong>
                            <div class="ml-5">
                                <div class="row mb-n2">                              
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
                                                <h5 class="description-header">Hora de ingreso</h5>                                         
                                                <span id="spanHora"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Empresa que visita</h5>                                         
                                                <span id="spanEmpresa"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                </div>                                                   
                                <div class="row">                              
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Colaborador a cargo</h5>                                         
                                                <span id="spanColaborador"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Descripción</h5>                                         
                                                <p id="parrafoDescripcion"></p>
                                            </div>                                         
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <strong class="ml-4">Datos básicos</strong>
                            <div class="ml-5">
                                <div class="row">                              
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Nombre</h5>                                         
                                                <span id="spanNombre"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Apellidos</h5>                                         
                                                <span id="spanApellido"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Identificación</h5>                                         
                                                <span id="spanIdentificacion"></span>
                                            </div>                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">Teléfono de emergencia</h5>                                         
                                                <span id="spanTelefono"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">EPS</h5>                                         
                                                <span id="spanEps"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="description-block text-left">
                                                <h5 class="description-header">ARL</h5>                                         
                                                <span id="spanArl"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-sm-9">
                            <label>Información del registro</label>
                            <div class="card card-primary card-tabs ml-1 mr-n1">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tabDatosIngreso" data-toggle="pill" href="#datosIngreso" role="tab" aria-controls="datosIngreso" aria-selected="true">Datos de ingreso</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tabDatosBasicos" data-toggle="pill" href="#datosBasicos" role="tab" aria-controls="datosBasicos" aria-selected="false">Datos básicos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Activo</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body mb-5">
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
                                                                <h5 class="description-header mb-1">Teléfono de emergencia</h5>                                         
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
                                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type='button' id="botonGuardarSalida" class="btn btn-primary">Registrar salida</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        {{-- </form> --}}

    </div>
</div>




  {{-- <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Datos de ingreso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Datos básicos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Activo</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>
      </div>
    </div>
    <!-- /.card -->
  </div> --}}