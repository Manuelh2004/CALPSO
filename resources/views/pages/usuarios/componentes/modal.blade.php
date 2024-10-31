<!-- Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header" id="ModalLabel">
            <h4 class="modal-title" id="modal-title">Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
            <form id="formulario_registrar_cliente" type="post" autocomplete="off" action="javascript:void(0);">

                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Apellido de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="apellido" name="apellido">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Edad de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="edad" name="edad">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Correo de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Name de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Género de usuario *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon6"><i data-feather="user"></i></span>
                                </div>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="">Seleccione género</option>
                                    <option value="F">FEMENINO</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="lista-tipo-cliente">
                        <div class="form-group">
                            <label>Area Usuario*</label>
                            <select class="form-control" name="id_area" id="id_area">
                                <option value="" disabled>Elije un area de usuario</option>
                                @foreach ($lista_area_usuario as $key => $p)
                                <option value="{{$p->id_area}}" >{{$p->nombre_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="lista-tipo-cliente">
                        <div class="form-group">
                            <label>Cargo Usuario *</label>
                            <select class="form-control" name="id_cargo" id="id_cargo">
                                <option value="" disabled>Elije un cargo de usuario</option>
                                @foreach ($lista_cargo_usuario as $key => $p)
                                <option value="{{$p->id_cargo}}" >{{$p->nombre_cargo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="lista-tipo-cliente">
                        <div class="form-group">
                            <label>Tipo Usuario *</label>
                            <select class="form-control" name="id_tipo" id="id_tipo">
                                <option value="" disabled>Elije un tipo de usuario</option>
                                @foreach ($lista_tipo_usuario as $key => $p)
                                <option value="{{$p->id_tipo}}" >{{$p->nombre_tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Contraseña *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <span>(*)Datos Obligatorios - La contraseña solo es obligatoria cuando se va a crear un registro.</span>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal"> <i data-feather="x-circle"></i> Cerrar</button>
            <button type="button" class="btn btn-primary btn-confirmar">Confirmar</button>

        </div>
    </div>
    </div>
</div>
