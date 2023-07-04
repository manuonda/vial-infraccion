    //departamento
                $("select[name=departamento]").change(function () {
                    id_departamento = $(this).val();
                    if (id_departamento === '')
                        return false;

                    resetaCombo('localidad');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_localidad/' + id_departamento, function (data) {

                        console.log("data = > " + data);
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

                        console.log("data = > " + data);
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_barrio});
                            $(option[i]).append(obj.barrio);

                            $("select[name=barrio]").append(option[i]);
                        });
                    });
                });
