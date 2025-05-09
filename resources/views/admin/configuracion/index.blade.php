@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>CENTRO EDUCATIVO MARVID</h1>
@stop

@section('content')
    <p>Datos principales de la escuela, si cuentas con los permisos adecuados podrás editar la información que será
        utilizada en varios reportes y formatos de impresión. Te invitamos a mantener al día esta información.</p>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detalle de la escuela</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action ="{{ url('admin/configuracion/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <!-- Etiqueta del campo -->
                                    <label class="form-label">Logo de la escuela <b>(*)</b></label><br>

                                    <!-- Ícono separado que activa el input -->
                                    <i class="fas fa-upload" style="cursor: pointer; font-size: 2rem;"
                                        onclick="document.getElementById('logoInput').click();">
                                    </i>

                                    <!-- Input file oculto -->
                                    <input type="file" id="logoInput" name="logo" accept="image/*"
                                        onchange="mostrarImagen(event)" style="display: none;">

                                    <br>
                                    <img id="preview" style="max-width: 300px; margin-top: 10px;">

                                    <script>
                                        const mostrarImagen = e => {
                                            const preview = document.getElementById('preview');
                                            const file = e.target.files[0];
                                            if (file) {
                                                preview.src = URL.createObjectURL(file);
                                            }
                                        }
                                    </script>

                                    @error('logo')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class= "col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de la institución</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="nombre_institucion"
                                                    placeholder="Escriba aqui ..." required
                                                    value="{{ old('nombre_institucion', $configuracion->nombre ?? '') }}">
                                            </div>
                                            @error('nombre_institucion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- termina nombre --}}
                                    {{-- inicia direccion --}}
                                    <div class= "col-md-8">
                                        <div class="form-group">
                                            <label for="">Dirección</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="direccion"
                                                    placeholder="Escriba aqui ..." required
                                                    value="{{ old('direccion', $configuracion->direccion ?? '') }}">
                                            </div>
                                            @error('direccion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- \\inicia otra fila --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Teléfono</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('telefono', $configuracion->telefono ?? '') }}"
                                                    name="telefono" placeholder="Escriba aqui ..." required>
                                            </div>
                                            @error('telefono')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Correo eléctronico</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-envelope-open"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('correoElectronico', $configuracion->correoElectronico ?? '') }}"
                                                    name="correoElectronico" placeholder="Escriba aqui ..." required>
                                            </div>
                                            @error('correoElectronico')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Divisa</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <select name="" id="" class="form-control" required>
                                                    <option value="">Selecciona una opción</option>
                                                    {{-- Se imprime la variable divisas del controlador configuracion --}}
                                                    @foreach ($divisas as $divisa)
                                                        <option value="{{ $divisa['symbol'] }}"
                                                            {{ old('divisa', $configuracion->divisa ?? '') == $divisa['symbol'] ? 'selected' : '' }}>
                                                            {{ $divisa['name'] . ' (' . $divisa['symbol'] . ')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('divisa')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Clave CTT</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('cctClave', $configuracion->cctClave ?? '') }}"
                                                    name="cctClave" placeholder="Escriba aqui ..." required>
                                            </div>
                                            @error('cctClave')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">RVOE</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('incorporacionClave', $configuracion->incorporacionClave ?? '') }}"
                                                    name="incorporacionClave" placeholder="Escriba aqui ..." required>
                                            </div>
                                            @error('incorporacionClave')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Página WEB</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('web', $configuracion->web ?? '') }}" name="web"
                                                    placeholder="Escriba aqui ...">
                                            </div>
                                            @error('incorporacionClave')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-thumbs-up"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('web', $configuracion->facebook ?? '') }}"
                                                    name="facebook" placeholder="Escriba aqui ...">
                                            </div>
                                            @error('facebook')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Instagram</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('instagram', $configuracion->instagram ?? '') }}"
                                                    name="instagram" placeholder="Escriba aqui ...">
                                            </div>
                                            @error('instagram')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Director</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('nombreDirector', $configuracion->nombreDirector ?? '') }}"
                                                    name="nombreDirector" placeholder="Escriba aqui ...">
                                            </div>
                                            @error('nombreDirector')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sub-Director</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('nombreSubdirector', $configuracion->nombreSubdirector ?? '') }}"
                                                    name="nombreSubdirector" placeholder="Escriba aqui ...">
                                            </div>
                                            @error('nombreSubdirector')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Control Escolar</label> <b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    value="{{ old('nombreControlEscolar', $configuracion->nombreControlEscolar ?? '') }}"
                                                    name="nombreControlEscolar" placeholder="Escriba aqui ...">
                                            </div>
                                            @error('nombreControlEscolar')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i>
                                        Guardar</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
