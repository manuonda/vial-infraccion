 <script type="text/javascript">

  $(document).ready(function(){
   

    $("select[name=domicilioPais]").change(function () {
        console.log("domicilio Pais");
        id = $(this).val();
        if (id === '')
            return false;

        resetaCombo('domicilioProvincia');
        resetaCombo('domcilioDepartamento');
        resetaCombo('domicilioLocalidad');
        resetaCombo('domicilioBarrio');
        resetaCombo('domicilioCalle');

      
        

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_provincias/' + id, function (data) {
            $("select[name=domicilioProvincia]").empty();
            $("select[name=domicilioProvincia]").append("<option value='-1'>Seleccionar</option>"); 
            var option = new Array();
            articulos=[];
            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_provincia});
                $(option[i]).append(obj.provincia);
                $("select[name=domicilioProvincia]").append(option[i]);
            });
        });

    });



     //articulo 
    $("select[name=domicilioProvincia]").change(function () {
        
        id = $(this).val();
        if (id === '')
            return false;

        resetaCombo('domcilioDepartamento');
        resetaCombo('domicilioLocalidad');
        resetaCombo('domicilioBarrio');
        resetaCombo('domicilioCalle');
        

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_departamentos/' + id, function (data) {

            var option = new Array();
            $("select[name=domicilioDepartamento]").empty();
            $("select[name=domicilioDepartamento]").append("<option value=''>Seleccionar</option>");  
            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_departamento});
                $(option[i]).append(obj.depto);

                $("select[name=domicilioDepartamento]").append(option[i]);
            });
        });
    });


    //select name inciso
    $("select[name=domicilioDepartamento]").change(function () {


        id = $(this).val();
        if (id === '')
            return false;

        resetaCombo('domicilioLocalidad');
        resetaCombo('domicilioBarrio');
        resetaCombo('domicilioCalle');

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_localidades/' + id, function (data) {

            var option = new Array(); 
            $("select[name=domicilioLocalidad]").empty();
            $("select[name=domicilioLocalidad]").append("<option value=''>Seleccionar</option>");  
            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_localidad});
                $(option[i]).append(obj.localidad);

                $("select[name=domicilioLocalidad]").append(option[i]);
            });
        });
    
    });

    $("select[name=domicilioLocalidad]").change(function () {
        id = $(this).val();
        if (id === '')
            return false;


         resetaCombo('domicilioBarrio');
         resetaCombo('domicilioCalle');

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_barrios/' + id, function (data) {
        
            var option = new Array();
            $("select[name=domicilioBarrio]").empty();
            $("select[name=domicilioBarrio]").append("<option value=''>Seleccionar</option>");  

            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_barrio});
                $(option[i]).append(obj.barrio);

                $("select[name=domicilioBarrio]").append(option[i]);
            });
        });
    
    });

    $("select[name=domicilioBarrio]").change(function () {
        id = $(this).val();
        if (id === '')
            return false;

        resetaCombo('domicilioCalle');

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_calles/' + id, function (data) {

            var option = new Array();
            $("select[name=domicilioCalle]").empty();
            $("select[name=domicilioCalle]").append("<option value=''>Seleccionar</option>");  


            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_calle});
                $(option[i]).append(obj.calle);

                $("select[name=domicilioCalle]").append(option[i]);
            });
        });
    
    });


     ///////////////////////////////////////////
     ////******* SELECT 2


     $(".select2-departamento-domicilio").select2({
            placeholder: 'Buscar',
            /*allowClear: true,*/
            escapeMarkup: function (markup) { return markup; },

            width: null,
            language: {
             noResults: function (elem) {
                 console.log("elemento : "+elem);
                 return "<a class='btn btn-red' href='javascript:;' onclick=addDepartamentoDomicilio()>Agregar</a>";
             }
           }
      });

       $(".select2-localidad-domicilio").select2({
            placeholder: 'Buscar',
            /*allowClear: true,*/
            escapeMarkup: function (markup) { return markup; },

            width: null,
            language: {
             noResults: function (elem) {
                 console.log("elemento : "+elem);
                 return "<a class='btn btn-red' href='javascript:;' onclick=addLocalidadDomicilio()>Agregar</a>";
             }
           }
      });


       $(".select2-barrio-domicilio").select2({
            placeholder: 'Buscar',
            /*allowClear: true,*/
            escapeMarkup: function (markup) { return markup; },

            width: null,
            language: {
             noResults: function (elem) {
                 console.log("elemento : "+elem);
                 return "<a class='btn btn-red' href='javascript:;' onclick=addBarrioDomicilio()>Agregar</a>";
             }
           }
      });

       $(".select2-calle-domicilio").select2({
            placeholder: 'Buscar',
            /*allowClear: true,*/
            escapeMarkup: function (markup) { return markup; },

            width: null,
            language: {
             noResults: function (elem) {
                 console.log("elemento : "+elem);
                 return "<a class='btn btn-red' href='javascript:;' onclick=addCalleDomicilio()>Agregar</a>";
             }
           }
      });

       

  });



</script>
   