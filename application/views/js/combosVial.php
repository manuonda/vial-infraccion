<script>
$(document).ready(function(){
 
     $("select[name=provincia]").change(function () {
                    id_provincia = $(this).val();
                    if (id_provincia === '')
                        return false;

                    resetaCombo('departamento');
                    resetaCombo('localidad');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_departamento/' + id_provincia, function (data) {

                       
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_departamento});
                            $(option[i]).append(obj.depto);

                            $("select[name=departamento]").append(option[i]);
                        });
                    });
                }); 
                 
                //departamento
                $("select[name=departamento]").change(function () {
                    id_departamento = $(this).val();
                    if (id_departamento === '')
                        return false;

                    resetaCombo('localidad');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_localidad/' + id_departamento, function (data) {

                        
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_localidad});
                            $(option[i]).append(obj.localidad);

                            $("select[name=localidad]").append(option[i]);
                        });
                    });
                });

                //localidad 
                $("select[name=localidad]").change(function () {
                    id_localidad = $(this).val();
                    if (id_localidad === '')
                        return false;

                    resetaCombo('barrio');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_barrio/' + id_localidad, function (data) {
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_barrio});
                            $(option[i]).append(obj.barrio);

                            $("select[name=barrio]").append(option[i]);
                        });
                    });
                });

                //barrio 
                $("select[name=barrio]").change(function () {
                    id_barrio = $(this).val();
                    if (id_barrio === '')
                        return false;

                    resetaCombo('calle');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_calle/' + id_barrio, function (data) {
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_calle});
                            $(option[i]).append(obj.calle);

                            $("select[name=calle]").append(option[i]);
                        });
                    });
                });


                //marca de auto 
                $("select[name=tipovehiculo]").change(function () {
                    id_tipovehiculo = $(this).val();
                    if (id_tipovehiculo === '')
                        return false;

                    

                    resetaCombo('marca');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_marca/' + id_tipovehiculo, function (data) {
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_marca});
                            $(option[i]).append(obj.nombre);

                            $("select[name=marca]").append(option[i]);
                        });
                    });
                });

                //marca de auto 
                $("select[name=marca]").change(function () {
                    id_marca = $(this).val();
                    if (id_marca === '')
                        return false;

                    resetaCombo('modelo');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_modelo/' + id_marca, function (data) {
                         var option = new Array();
                        $("select[name=modelo]").append("<option>--Seleccionar--</option>");
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_modelo});
                            $(option[i]).append(obj.nombre);

                            $("select[name=modelo]").append(option[i]);
                        });
                    });
                });


});
</script>


              