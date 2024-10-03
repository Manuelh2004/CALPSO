{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "cargo_empleado",
        fields: [
            "id_cargo",
            "nombre_cargo",
            "descripcion",
            "salario_base"
        ],
        create_requiere : [],
        pk: "id_cargo",
        rutas : {
            crear: "crud/cargo_empleado/create",
            obtener_data: "crud/cargo_empleado/data",
            guardar_data: "crud/cargo_empleado/update",
            dar_baja: "crud/cargo_empleado/dar_baja",
            dar_alta: "crud/cargo_empleado/dar_alta",
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
