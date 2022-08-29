@extends('themes.lte.layout')

@section('titulo')
    Usuarios
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets/lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    {{-- <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    <!-- JavaScript propio -->
    <script src="{{ asset('js/usuarios/administrarUsuarios.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.usuarios.header')
    </div>

    <section id="formEditarUsuario" class="content-header mb-n4" style="display: none">
        <div class="row mb-n2">
            <div class="col-12">
                <form id="form_editarUsuario" action="" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Asignar rol de usuario</h3>
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
        
                        <div class="card-body mb-n3">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputUsuario">Usuario</label>
                                        <input type="text" class="usuario form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="inputUsuario" name="nombre" value="{{ old('name') }}" autocomplete="off" required>
                                        {{-- @if ($errors->has('nombre')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nombre') }}
                                            </div>            
                                        @endif --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="selectRol">Seleccione el rol de usuario</label>
                                        <select class="usuario form-control" style="width: 100%;" id="selectRol" name="role_id" required>
                                            <option selected="selected" value="" disabled>Rol de usuario</option>
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->id }}"
                                                    {{ $rol->id == old('role_id') ? 'selected' : '' }}> {{ $rol->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- @if ($errors->has('id_eps')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_eps') }}
                                            </div>            
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type='submit' class="btn btn-primary">Asignar</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla_usuarios" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo empresarial</th>
                                    <th>Rol de usuario</th>
                                    <th>Asignar rol</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </section>
@endsection
