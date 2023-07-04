<script type="text/javascript">
//    $('#publicar').click(function() {
$("#imprimeListado").click(function (){
$("div#imprimir").css('display','block');
$("div#imprimir").printArea();
$("div#imprimir").css('display','none');
});
function listado(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'V';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#servicioFormListado').submit();
    };
function ver(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'V';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#servicioFormListado').submit();
    };
    function publicar(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'P';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#confirm').addClass('modal-success');
        $('#btnAccion').addClass('fa-check ');
        $('#modalMsje').html('Va a publicar el Servicio. Publicado el Servicio NO podr&aacute; Editarlo  &oacute; Eliminarlo.<br> Esta seguro de Publicar?');
        $('#botonOk').html('Publicar');
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        });
    };
    function eliminar(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'D';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#confirm').addClass('modal-danger');
        $('#btnAccion').addClass(' fa-exclamation-triangle ');
        $('#modalMsje').html('Va a Eliminar el Servicio. Nose puede deshacer esta acci&oacute;n.<br> Esta seguro de Eliminar?');
        $('#botonOk').html('Eliminar');
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        });
    };
    function editar(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'E';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#servicioFormListado').submit();
    };
    function imprimir(id) {
        cmp = document.getElementById('accion');
        cmp.value = 'I';
        cmp = document.getElementById('idServicio');
        cmp.value = id;
        $('#servicioFormListado').submit();
    };
    $('#botonOk').click(function () {
        $('#servicioFormListado').submit();
    });

    $(document).ready(function () {
        $('#example').DataTable({
            "destroy": true, "paging": false, "ordering": false, "searching": false, "bInfo": false, 
            dom: 'Bfrtip', buttons: [{
						  extend: "print",
						  className: "btn-sm"
						}]});
        var base_url = '<?php echo base_url(); ?>';
    });
</script>