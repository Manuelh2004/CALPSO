{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "usuario",
        fields: [
            "usuario_id",
            "id_area",
            "id_cargo",
            "id_tipo",
            "nombre",
            "apellido",
            "edad",
            "correo ",
            "genero",
            "name",
            "password",
            "estado"
        ],
        create_requiere : [],
        pk: "usuario_id",
        rutas : {
            crear: "crud/usuario/create",
            obtener_data: "crud/usuario/data",
            guardar_data: "crud/usuario/update",
            dar_baja: "crud/usuario/dar_baja",
            dar_alta: "crud/usuario/dar_alta",
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
