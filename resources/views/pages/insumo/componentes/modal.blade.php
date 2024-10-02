<!-- Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header" id="ModalLabel">
            <h4 class="modal-title" id="modal-title">Insumo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
            <form id="formulario_registrar_cliente" type="post" autocomplete="off" action="javascript:void(0);">

                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre de insumo *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombre_insumo" name="nombre_insumo">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Stock *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <input type="number" class="form-control" id="stock" name="stock">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label>Descripcion *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><i data-feather="clipboard"></i></span>
                                </div>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <span>(*) Datos Obligatorios. </span>
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
