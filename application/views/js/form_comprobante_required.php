<script>
var styleError = "error_input";
var styleSpanError = "help-block help-block-error";
var styleSpanNone = "span_none";
var styleErrorInput = "error_input";
var has_error="has-error";



function changeTextRequired(input) {
    var value = input.value;
    var id = input.id;
   
    var stringSpan = "#" + id + "-error";
    var idErrorSpan = subStringId(stringSpan);
    var formId = subStringForm(id);
    var idInput = subStringId(id);
   
    if (input.value.length >= 1) {

        console.log("Campo completandose...");

        $("#" + idErrorSpan).removeClass(styleSpanError);
        $("#" + idErrorSpan).addClass(styleSpanNone);
        // remuevo del input
        $("#" + formId + "\\:" + idInput).removeClass(styleErrorInput);
    } else {

        console.log("El input esta vacio");
       
        $("#" + idErrorSpan).removeClass(styleSpanNone);
        $("#" + idErrorSpan).addClass(styleSpanError);
        $("#" + formId + "\\:" + idInput).addClass(styleErrorInput);

    }

}


/**
 * Se valida que los input sean requeridos para mostrar los mensajes de error
 *
 */
function validarComprobanteCuota(x) {
    let isValido = true;
    let form = (x);
    let formInput = "#"+ x + " :input"; 
    console.log(formInput);

    // recorre los input y verifica que son requeridos
    $(formInput).each(

            function() {                                               
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-cuota');
                
                if ($(this).val().trim() == '' && required) {
                   
                    var stringSpan = "#" + id + "-error";
                    var stringDiv="#"+id+"-div";
                    
                    /*var idErrorSpan = subStringId(stringSpan);
                    *///console.log("idErrorSpan : "+idErrorSpan);
                    
                    $(this).addClass(styleErrorInput);

                    $(stringSpan).removeClass(styleSpanNone);
                    $(stringSpan).addClass(styleSpanError);  
                    $(stringDiv).addClass(has_error);                 

                    isValido = false;
                }
            });
    $(form).find('select').each(
            function() {
                // obtengo el parent div
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-cuota');
                
                if ($(this).val() == '' && required) {
                    console.log("id : "+id);
                    // agrego el error al input
                    $(this).addClass(styleErrorInput);

                    var stringSpan = "#" + id + "-error";
                    var idErrorSpan = subStringId(stringSpan);
                   
                    var stringDiv="#"+id+"-div";
                    $(stringSpan).removeClass(styleSpanNone); 
                    $(stringSpan).addClass(styleSpanError);
                    $(stringDiv).addClass(has_error); 
                    isValido = false;
                }
            });
    return isValido;

}

/**
 * Se valida que los input sean requeridos para mostrar los mensajes de error
 *
 */
function validarComprobanteContado(x) {
    let isValido = true;
    let form = (x);
    let formInput = "#"+ x + " :input"; 
    console.log(formInput);

    // recorre los input y verifica que son requeridos
    $(formInput).each(

            function() {                                               
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-contado');
                
                if ($(this).val().trim() == '' && required) {
                   
                    var stringSpan = "#" + id + "-error";
                    var stringDiv="#"+id+"-div";
                    
                    /*var idErrorSpan = subStringId(stringSpan);
                    *///console.log("idErrorSpan : "+idErrorSpan);
                    
                    $(this).addClass(styleErrorInput);

                    $(stringSpan).removeClass(styleSpanNone);
                    $(stringSpan).addClass(styleSpanError);  
                    $(stringDiv).addClass(has_error);                 

                    isValido = false;
                }
            });
    $(form).find('select').each(
            function() {
                // obtengo el parent div
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-contado');
                
                if ($(this).val() == '' && required) {
                    console.log("id : "+id);
                    // agrego el error al input
                    $(this).addClass(styleErrorInput);

                    var stringSpan = "#" + id + "-error";
                    var idErrorSpan = subStringId(stringSpan);
                   
                    var stringDiv="#"+id+"-div";
                    $(stringSpan).removeClass(styleSpanNone); 
                    $(stringSpan).addClass(styleSpanError);
                    $(stringDiv).addClass(has_error); 
                    isValido = false;
                }
            });
    return isValido;

}

/**
 * Se valida que los input sean requeridos para mostrar los mensajes de error
 *
 */
function validarComprobanteLicencia(x) {
    let isValido = true;
    let form = (x);
    let formInput = "#"+ x + " :input"; 
    console.log(formInput);

    // recorre los input y verifica que son requeridos
    $(formInput).each(

            function() {                                               
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-licencia');
                
                if ($(this).val().trim() == '' && required) {
                   
                    var stringSpan = "#" + id + "-error";
                    var stringDiv="#"+id+"-div";
                    
                    /*var idErrorSpan = subStringId(stringSpan);
                    *///console.log("idErrorSpan : "+idErrorSpan);
                    
                    $(this).addClass(styleErrorInput);

                    $(stringSpan).removeClass(styleSpanNone);
                    $(stringSpan).addClass(styleSpanError);  
                    $(stringDiv).addClass(has_error);                 

                    isValido = false;
                }
            });
    $(form).find('select').each(
            function() {
                // obtengo el parent div
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido-comprobante-licencia');
                
                if ($(this).val() == '' && required) {
                    console.log("id : "+id);
                    // agrego el error al input
                    $(this).addClass(styleErrorInput);

                    var stringSpan = "#" + id + "-error";
                    var idErrorSpan = subStringId(stringSpan);
                   
                    var stringDiv="#"+id+"-div";
                    $(stringSpan).removeClass(styleSpanNone); 
                    $(stringSpan).addClass(styleSpanError);
                    $(stringDiv).addClass(has_error); 
                    isValido = false;
                }
            });
    return isValido;

}

function subStringId(stringSpan) {
    var indexOf = stringSpan.indexOf(":");
    var idComponent = stringSpan.substring(indexOf + 1);
    return idComponent;
}

function subStringForm(stringSpan) {
    var indexOf = stringSpan.indexOf(":");
    var idForm = stringSpan.substring(0 ,indexOf );
    return idForm;
}

</script>
