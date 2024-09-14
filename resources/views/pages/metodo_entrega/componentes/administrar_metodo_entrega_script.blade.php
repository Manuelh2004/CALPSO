{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "metodo_entrega",
        fields: [
            "id_metodo_entrega",
            "nombre_metodo_entrega",
            "costo",
        ],
        create_requiere : [],
        pk: "id_metodo_entrega",
        rutas : {
            crear: "crud/metodo_entrega/create",
            obtener_data: "crud/metodo_entrega/data",
            guardar_data: "crud/metodo_entrega/update",
            dar_baja: "crud/metodo_entrega/dar_baja",
            dar_alta: "crud/metodo_entrega/dar_alta",
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
