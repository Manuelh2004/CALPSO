<!-- Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header" id="ModalLabel">
            <h4 class="modal-title" id="modal-title">Cliente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
            <form id="formulario_registrar_cliente" type="post" autocomplete="off" action="javascript:void(0);">

                <div class="row">
                    <div class="col-12 col-md-12" id="lista-tipo-cliente">
                        <div class="form-group">
                            <label>Tipo Cliente *</label>
                            <select class="form-control" name="id_tipo_cliente" id="id_tipo_cliente">
                                <option value="" disabled>Elije un tipo de cliente</option>
                                @foreach ($lista_tipo_cliente as $key => $p)
                                <option value="{{$p->id_tipo_cliente}}" >{{$p->nombre_tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre completo *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Género *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="FEMENINO">Femenino</option>
                                    <option value="MASCULINO">Masculino</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Edad *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="number" class="form-control" id="edad" name="edad">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Telefono *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="number" class="form-control" id="telefono" name="telefono">
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
