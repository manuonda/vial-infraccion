 <!-- jQuery 2.2.3 
        <script src="<?php echo base_url(); ?>template/plugins/jQuery/jquery-2.2.3.min.js"></script>
       -->
       
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>template/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>template/dist/js/app.min.js"></script>
   
         <!-- BEGIN CORE PLUGINS -->
    
    
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->


        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

       
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2.2/js/select2.full.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ;?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>  
         
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysiwyg/external/jquery.hotkeys.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysiwyg/external/google-code-prettify/prettify.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysiwyg/bootstrap-wysiwyg.js" type="text/javascript"></script>  


        <!-- input mask --> 
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>  



        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- END PAGE LEVEL SCRIPTS -->
         
        <?php $this->load->view('js/combos');?>
        <?php $this->load->view('js/combosDomicilio');?>
        <?php $this->load->view('js/form_domicilio_required');?>
        <?php $this->load->view('js/form_comprobante_required');?>
        <?php $this->load->view('js/util');?>

        <!-- modules -->
        <?php $this->load->view('js/module_detalle_pago');?>
               
        <!--librarys --> 
        <script src="<?php echo base_url();?>assets/apps/scripts/form_required.js" type="text/javascript"></script>

        <script type="text/javascript" charset="utf-8">
            

            $(document).ready(function () {
                 $('#summernote').summernote({
                     height: 150,   //set editable area's height
                     codemirror: { // codemirror options
                        theme: 'monokai'
                      } 
                    });

               
            });
            // ]]>
        </script>

        <?php
        if (isset($jScript)) {
            foreach ($jScript as $js) {
                echo '<script src="' . base_url($js) . '"></script>';
            }
        }
        if (isset($javaScript)) {
            $this->load->view('js/' . $javaScript);
        }
        ?>