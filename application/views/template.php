<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php
            if (isset($title)) {
                echo $title;
            } else {
                echo 'Sistema de Infracciones Viales';
            }
            ?>
        
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <?php echo link_tag('template/bootstrap/css/bootstrap.css'); ?>

        <!-- Font Awesome -->
        <?php echo link_tag('template/bootstrap/css/font-awesome.css'); ?>
        <!-- Ionicons -->
        <?php echo link_tag('template/bootstrap/css/ionicons.css'); ?>
        <!-- Theme style -->
        <?php echo link_tag('template/dist/css/AdminLTE.css'); ?>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <?php echo link_tag('template/dist/css/skins/_all-skins.css'); ?>


            <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        -->
        <?php echo link_tag('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>
        <link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       <?php echo link_tag('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>
        <!-- END GLOBAL MANDATORY STYLES -->



        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
       
        <!--datatables -->
        <link href="<?php echo base_url() ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        

        <!-- select 2 -->
        <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />       
        

        <!-- modal -->
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
        

        <!--summernote -->
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />

        <!-- jexcel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jexcel/1.5.7/css/jquery.jexcel.min.css" type="text/css" />

     
        <!-- wysihtml -->
        <link href="<php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />  
        <link href="<php echo base_url(); ?>assets/global/plugins/bootstrap-wysiwyg/index.css" />  

            


        <!-- END PAGE LEVEL PLUGINS -->
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        
        <link href="<?php echo base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />  

         
            <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
         <!--  
           <script src="<?php echo base_url() ?>assets/js/jquery.min.3.1.1.js"></script>
           <script src="<?php echo base_url() ?>assets/js/js/numeral.min.js"></script>
           <script src="<?php echo base_url() ?>assets/js/jquery.jexcel.js"></script>  
           <script src="<?php echo base_url() ?>assets/js/excel-formula.min.js"></script>
           <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/jquery.jexcel.min.css" type="text/css" />
          -->

        <?php
      
        ?>
        <style type="text/css">
            .loader {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 99;
                background: 50% 50% no-repeat rgb(249,249,249);
            }
            .loader-container {
                width: 600px;
                height: 200px;
                position: absolute;
                top:0;
                bottom: 0;
                left: 0;
                right: 0;

                margin: auto;
                text-align: center;
            }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

      
             <!-- END HEAD -->




    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="wrapper" style="height:auto;">

           <?php $this->load->view('include/frontend/header.php'); ?>
           
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('include/frontend/asidebar.php');?>

           
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="page-title">
                     <?php echo $titulo ?>
                    </h1>
                </section>
              
                <section class="content">
                    <?php
                   
                        $this->load->view($contenido);
                    ?>
                    <div class="clearfix"></div>
                </section>
                <!-- /.content -->
            </div>
           
            <div class="control-sidebar-bg"></div>
        </div>

        <!-- footer php -->
        <?php $this->load->view('include/frontend/footer.php');?>

        
        <!-- ./library -->
        <?php $this->load->view('include/frontend/library.php');?>


        
    </body>

</html>
