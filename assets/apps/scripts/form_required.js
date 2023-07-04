
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
function validarForm(x) {
    console.log("validarForms");
    var isValido = true;
    var form = (x);

    // recorre los input y verifica que son requeridos
    $(form).find('input').each(
            function() {                                               
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido');
                
                var stringSpan = "#" + id + "-error";
                var stringDiv="#"+id+"-div";
                if ($(this).val().trim() == '' && required) {
                   
                    
                    
                    /*var idErrorSpan = subStringId(stringSpan);
                    */console.log("234324 : "+stringSpan);
                    
                    $(this).addClass(styleErrorInput);

                    $(stringSpan).removeClass(styleSpanNone);
                    $(stringSpan).addClass(styleSpanError);  
                    $(stringSpan).css("display","");
                    $(stringDiv).addClass(has_error); 


                    isValido = false;
                } else {
                   $(stringSpan).css("display","none");
                }
            });
    $(form).find('select').each(
            function() {
                // obtengo el parent div
                var id = $(this).attr('id');
                var required = $(this).hasClass('requerido');
                var stringSpan = "#" + id + "-error";
                var idErrorSpan = subStringId(stringSpan);
                   
                if ($(this).val() == '' && required) {
                    console.log("id : "+id);
                    // agrego el error al input
                    $(this).addClass(styleErrorInput);

                    
                    var stringDiv="#"+id+"-div";
                    $(stringSpan).removeClass(styleSpanNone); 
                    $(stringSpan).addClass(styleSpanError);
                    $(stringSpan).css("display","");
                    $(stringDiv).addClass(has_error); 
                    isValido = false;
                } else{
                   $(stringSpan).css("display","none");
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
