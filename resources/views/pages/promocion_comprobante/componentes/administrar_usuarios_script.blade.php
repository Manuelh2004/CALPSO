{{-- <script> --}}

var crud = new crud_administracion();

$(document).ready(function() {
	crud.iniciar({
        title: "Usuario",
        fields: [
            "name",
            {
                name: "psis_user_role",
                id_field: "user_rol"
            },
            {
                name: "user_email",
                id_field: "user-email",
                requiere_create: true,
                requiere_update: false,
            },
            {
                name: "password",
                requiere_create: true,
                requiere_update: false,
            },
            {
                name: "password_confirmation",
                send: false,
                requiere: false
            }
        ],
        create_requiere : ["name", "user-email", "password"],
        pk: "user_id",
        rutas : {
            crear: "crud/user/create",
            obtener_data: "crud/user/data",
            guardar_data: "crud/user/update",
            dar_baja: "crud/user/dar_baja",
            dar_alta: "crud/user/dar_alta",
        }
    });

    crud.validation_before_create = function(){
        let password = $("#password").val(); 
        let password_confirmation= $("#password_confirm").val();
        if(password == password_confirmation){
            return true;
        }

        crud.mensaje_error = "Debe colocar la misma contraseña en la confirmación.";
        return false;
    }

    crud.validation_before_update = function(){
        let password = $("#password").val(); 
        let password_confirmation= $("#password_confirm").val();
        if(password == "" && password_confirmation == ""){
            return true;
        }

        if(password == password_confirmation){
            return true
        }
        crud.mensaje_error = "Debe colocar la misma contraseña en la confirmación.";
        return false;
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