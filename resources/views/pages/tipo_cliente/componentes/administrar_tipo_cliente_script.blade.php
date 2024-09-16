{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "tipo_cliente",
        fields: [
            "id_tipo_cliente",
            "nombre_tipo",
            "descripcion",
            "descuento_asociado"
        ],
        create_requiere : [],
        pk: "id_tipo_cliente",
        rutas : {
            crear: "crud/tipo_cliente/create",
            obtener_data: "crud/tipo_cliente/data",
            guardar_data: "crud/tipo_cliente/update",
            dar_baja: "crud/tipo_cliente/dar_baja",
            dar_alta: "crud/tipo_cliente/dar_alta",
        }
    });

    crud.validation_before_create = function(){
        return true;
    }

    crud.validation_before_update = function(){
        return true; 
    }

	$("body").on("click", ".btn-editar", function () {
		let row_id = $(this).attr("row_id");
        crud.modal_editar(row_id);
    });

    $("body").on("click", ".btn-dar-baja", function () {
		let row_id = $(this).attr("row_id");
        crud.dar_baja(row_id, ()=>{
            tabla_ajax.ajax.reload();
        });
    });

    $("body").on("click", ".btn-dar-alta", function () {
		let row_id = $(this).attr("row_id");
        crud.dar_alta(row_id, ()=>{
            tabla_ajax.ajax.reload();
        });
    });

    $("body").on("click", ".btn-registrar", function () {
        crud.modal_crear();
    });

    $("body").on("click", ".btn-confirmar", function () {
		crud.confirmar();
    });
});
