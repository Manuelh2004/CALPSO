var utils = {
    is_elements_empty: (arr)=>{
        for(let element of arr){
            if(element.value == "" ){
                element.focus();
                return true;
            }
        }
        return false;
    },
    block: ()=>{
        $.blockUI({
            message: '<span class="text-semibold">Cargando ...</span>',
            fadeIn: 800, 
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                zIndex: 1201,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    },
    error_alert: (message) => {
        swal({
            title: 'ERROR!',
            text: (message)? message: "Hubo un error",
            type: 'error',
            padding: '2em'
          })
    }

}