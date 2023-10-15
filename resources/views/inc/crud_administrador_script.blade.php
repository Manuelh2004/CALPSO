{{-- <script> --}}

function crud_administracion(){
    this.enable = false;
	this.modal = {
        id: "#crudModal",
        id_title: "modal-title",
        title: "Registro"
    };
    this.create_requiere = [];
    this.fields = [];
    this.pk = null;
    this.rutas = {
        crear: "",
        obtener_data: "",
        guardar_data: "",
        dar_baja: "",
        dar_alta: "",
    };

    this.mensaje_error = "No se ha podido realizar la acción correctamente.";

    this.row_id = null;
	
	this.iniciar = function(config){
		let self = this;
        if("fields" in config){
            self.load_fields(config.fields);
        } else {
            swal("Error", "0001 - No se tiene la configuracion de campos correcta, la vista no funcionará correctamente.", 'error');
            return false;
        }

        if("pk" in config){
            self.pk = config.pk;
        } else {
            swal("Error", "0002 - No se tiene la configuracion de campos correcta, la vista no funcionará correctamente.", 'error');
            return false;
        }

        if("rutas" in config){
            self.rutas = config.rutas;
        } else {
            swal("Error", "0003 - No se tiene la configuracion de campos correcta, la vista no funcionará correctamente.", 'error');
            return false;
        }

        if("create_requiere" in config){
            self.create_requiere = config.create_requiere;
        }

        if("title" in config){
            self.modal.title = config.title;
        }

        self.enable = true;
		console.log("Se ha iniciado el servicio de administracion CRUD");
	};

    this.load_fields = function (data){
        let self = this;
        self.fields = [];
        for(let i of data){
            if(typeof i == "string"){
                self.fields.push({
                    name: i,
                    id_field: i,
                    requiere_create: true,
                    requiere_update: true,
                    send: true
                });
            } else if(typeof i == "object") {
                if("name" in i){
                    self.fields.push({
                        name: i.name,
                        id_field: ("id_field" in i)? i.id_field: i.name,
                        send: ("send" in i)? i.send: true,
                        requiere_create: ("requiere_create" in i)? i.requiere_create: ("requiere" in i)? i.requiere: true,
                        requiere_update: ("requiere_update" in i)? i.requiere_update: ("requiere" in i)? i.requiere: true
                    });
                }
            }
        }
    }

    this.clean_form = function(){
        let self = this;
        console.log(self.fields);
        for(let i of self.fields){
            $("#"+i.id_field).val("");
        }
    }

    this.validation_before_update = function (){
        return true;
    };

    this.validation_before_create = function (){
        return true;
    }

	this.modal_editar = function(row_id){
        let self = this;
        if(!self.enable){swal("Error", "0004 - La aplicación no esta correctamente configurada.", 'error');}
        console.log(self.fields);
        self.clean_form();
        self.row_id = row_id;
        
        let values = {};
        values[self.pk] = row_id;

        if(parseInt(row_id) == 0){
            swal("Error", "No se puede identificar correctamente el dato.", 'error');
            return false;
        }

        $("#"+self.modal.id_title).text("Editar "+ this.modal.title+ ": "+this.row_id);

        this.realizar_consulta({
			url: self.rutas.obtener_data,
			datos: values
		}, function(response){
            $(self.modal.id).modal('show');
			
            for(let i of self.fields){
                if(i.name in response){
                    $("#"+i.id_field).val(response[i.name]);    
                }
            }
		});
	}

    this.modal_crear = function(row_id){
        let self = this;
        if(!self.enable){swal("Error", "0008 - La aplicación no esta correctamente configurada.", 'error');}
        self.row_id = null;
        
        $("#"+self.modal.id_title).text("Registrar "+ this.modal.title);
        self.clean_form();
        $(self.modal.id).modal('show');
	}

    this.test = function (){
        swal({
            title: 'Completado!',
            text: "Los cambios se han guardado exitosamente",
            type: 'success',
        }).then(function(isConfirm){
            location.reload();
        });
    }

    this.confirmar = function (){
        let self = this;

        if(self.row_id){
            console.log("Actualizando Registro");
            return self.guardar_cambios();
        } else {
            console.log("Creando Registro");
            return self.crear_registro();
        }
    };

    this.validate_create_requiere = function(){
        let self = this;
        for(let i of self.fields){
            if(i.requiere_create){
                if($("#"+i.id_field).val() == ""){
                    $("#"+i.id_field).focus();
                    console.log("Falta", i);
                    swal("Error", "0007 - No se tienen todos los campos requeridos para registrar.", 'error');
                    return false;
                }
            }
        }
        return true;
    }

    this.validate_update_requiere = function(){
        let self = this;
        for(let i of self.fields){
            if(i.requiere_update){
                if($("#"+i.id_field).val() == ""){
                    $("#"+i.id_field).focus();
                    swal("Error", "0009 - No se tienen todos los campos requeridos para actualizar.", 'error');
                    return false;
                }
            }
        }
        return true;
    }

    this.get_send_data = function(){
        let self = this;
        let values = {};
        for(let i of self.fields){
            if(i.send){
                values[i.name] = $("#"+i.id_field).val();
            }
        }
        console.log(values);
        return values;
    }

    this.crear_registro = function (){
        let self = this;
        if(!self.enable){swal("Error", "0005 - La aplicación no esta correctamente configurada.", 'error');}

        if(!self.validation_before_create()){
            swal("Error", self.mensaje_error, 'error');
            return false;
        }

        if(!self.validate_create_requiere()){
            return false;
        }

        this.realizar_consulta({
			url: self.rutas.crear,
			datos: self.get_send_data()
		}, function(response){
			swal({
                title: 'Completado!',
                text: "Los cambios se han guardado exitosamente",
                type: 'success',
            }).then(function(isConfirm){
                location.reload();
            });
		});
    }

    this.dar_alta = function (row_id, callback) {
        let self = this;
        let values = {};
        values[self.pk] = row_id;

        this.realizar_consulta({
			url: self.rutas.dar_alta,
			datos: values
		}, function(response){
			const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: 'Se ha dado de alta al '+self.modal.title+' '+row_id,
                padding: '2em',
            });

            if(typeof callback == "function"){
                callback(row_id);
            }
		});
    }

    this.dar_baja = function (row_id, callback){
        let self = this;
        let values = {};
        values[self.pk] = row_id;

        this.realizar_consulta({
			url: self.rutas.dar_baja,
			datos: values
		}, function(response){
			const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: 'Se ha dado de alta al '+self.modal.title+' '+row_id,
                padding: '2em',
            });

            if(typeof callback == "function"){
                callback(row_id);
            }
		});
    }
    
    this.guardar_cambios = function(){
        let self = this;
        if(!self.enable){swal("Error", "0006 - La aplicación no esta correctamente configurada.", 'error');}

        if(!self.validation_before_update()){
            swal("Error", self.mensaje_error, 'error');
            return false;
        }

        if(!self.validate_update_requiere()){
            return false;
        }

        let values = self.get_send_data();
        values[self.pk] = self.row_id;

        this.realizar_consulta({
			url: self.rutas.guardar_data,
			datos: values
		}, function(response){
			swal({
                title: 'Completado!',
                text: "Los cambios se han guardado exitosamente",
                type: 'success',
            }).then(function(isConfirm){
                location.reload();
            });
		});

    }

	this.realizar_consulta = function(data, callback) {
        if (typeof data != "undefined") {
            if (!("datos" in data)) {
                console.log("No se han ingresado todos los parametros necesarios");
                return false;
            }
            if (!("url" in data)) {
                console.log("No se han ingresado todos los parametros necesarios");
                return false;
            }
        }

        $.ajax({
            url: data.url,
            type: 'post',
            dataType: "json",
            data: data.datos,
            beforeSend: function(a) {
                $("#preloader").show();
            },
            complete: function(a) {
                $("#preloader").hide();
            },
            error: function(data) {
                $("#preloader").hide();
                swal("Error", "Por favor comuniquese con el administrador", 'error');
            },
            success: function(response) {
            	if(response.estado){
            		if (typeof callback == "function") {
	                    callback(response.payload);
	                }	
            	} else {
            		swal("Error", response.mensaje, 'error');		
            	}
            }
        });
    };
}