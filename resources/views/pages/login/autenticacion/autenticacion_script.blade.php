{{--<script>--}}

function Autenticacion(){
    this.elem = {
        name: "username",
        password: "password",
        remember_me: "remember_me",
        boton: "boton-login",
        form: "formulario-autenticacion"
    };

    this.auth_require = [this.elem.name, this.elem.password];

    this.data = {
        name: "",
        password: "",
        remember_me: false
    };
    
    this.inicio = () => {
        let self = this;
        $('#'+self.elem.form).on('submit', (event) => {
            // Prevent the page from reloading
            event.preventDefault();
            self.login((respuesta)=>{
                console.log(respuesta);
                // window.location.href = respuesta.redirect_to;
                window.location.href = '/inicio';
            });
        });
    };

    this.login = (callback)=>{
        let self = this;
        if(!utils.is_elements_empty(self.auth_require)){
            $("#"+self.elem.boton).attr("disabled", true);
            $.ajax({
                url: 'auth/login',
                data: self.get_inputs(),
                type: 'post',
                beforeSend: function (a) {
                    utils.block();
                },
                complete: function (a) {
                    $("#"+self.elem.boton).attr("disabled", false);
                },
                error: function (err) {
                    console.log(err);
                    utils.error_alert("Hubo un error en el login.");
                },
                success: function (respuesta) {
                    if('estado' in respuesta){
                        if(respuesta.estado){
                            if(typeof callback == "function"){
                                callback(respuesta.payload);
                            }
                        } else {
                            utils.error_alert("Hubo un error en el login.");
                        }
                    } else {
                        utils.error_alert("Hubo un error en el login.");
                    }
                }
            });
        } else {
            console.log("Los campos no estan completos.");
        }
    };

    this.get_inputs = (callback) => {
        this.data.name = document.getElementById(this.elem.name).value;
        this.data.password = document.getElementById(this.elem.password).value;
        this.data.remember_me = $("#"+this.elem.remember_me).is(":checked");
        if(typeof callback == "function"){
            callback(this.data);
        } else {
            return this.data;
        }
    };


}
var autenticacion = new Autenticacion();

$(document).ready(function () {
    autenticacion.inicio();


});