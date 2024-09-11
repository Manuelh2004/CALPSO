{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "distrito_sucursal",
        fields: [
            "id_distrito",
            "nombre_distrito"
        ],
        create_requiere : [],
        pk: "id_distrito",
        rutas : {
            crear: "crud/distrito_sucursal/create",
            obtener_data: "crud/distrito_sucursal/data",
            guardar_data: "crud/distrito_sucursal/update",
            dar_baja: "crud/distrito_sucursal/dar_baja",
            dar_alta: "crud/distrito_sucursal/dar_alta",
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
