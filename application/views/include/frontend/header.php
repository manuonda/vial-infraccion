 <header class="main-header">
                <!-- Logo -->
                <a href="<?php base_url('/Adicional'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>SI</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b></b>Infracciones Vial </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <img src="<?php echo base_url('template/dist/img/logo.png'); ?>" style="width: 170px; height: 50px;" alt="User Image">
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('template/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('nombre'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header" <?php if ($this->session->userdata('Estado') == FALSE) {
            echo 'style="background-color: red"';
        } ?> >
                                        <img src="<?php echo base_url('template/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                                        <p>
<?php echo $this->session->userdata('nombre'); ?> - <?php echo $this->session->userdata('username'); ?>
                                            <br>
                                            <small><b><?php echo $this->session->userdata('mensaje'); ?></b></b></small>
                                            <small>Autorizado desde <b><?php echo $this->session->userdata('desde'); ?></b> hasta <b><?php echo $this->session->userdata('hasta'); ?></b></small>

                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!--              <li class="user-body">
                                                    <div class="row">
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Followers</a>
                                                      </div>
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Sales</a>
                                                      </div>
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Friends</a>
                                                      </div>
                                                    </div>
                                                     /.row
                                                  </li>-->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url(); ?>usuario/edit/<?php echo $this->session->userdata('user_id'); ?>" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>