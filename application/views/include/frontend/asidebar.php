 <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                   
                        <?php

                        

                         foreach($listado as $gruposeccion) :?> 
                            <li class="treeview active">
                            <a href="#">
                            <i class="fa fa-share"></i> <span><?php echo $gruposeccion['grupo_seccion'];?></span>
                            <span class="pull-right-container">
                               <i class="fa fa-angle-left pull-right"></i>
                            </span>
                            </a>
                            <ul class="treeview-menu">
                              <?php if(sizeof($gruposeccion['seccion'])>0) :
                                     foreach($gruposeccion['seccion'] as $item) : 
                              ?>
                                     <li class="treeview">
                                         <a href="<?php echo base_url(). $item->url;?>"><i class="fa fa-circle-o"></i> <?php echo $item->nombre;?>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                      </a>
                                    </li>

                                 
                                  <?php endforeach; ?> 
                              
                             <?php  endif; ?>
                             
                             </ul>
                           
                            </li>
                        <?php endforeach; ?> 

                        <li>
                              <ul>
                                <li class="treeview">
                                         <a href="<?php echo base_url().'configuraciones/index';?>"><i class="fa fa-circle-o"></i>Configurar Valor Unidad
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                      </a>
                                    </li>
                             </ul>
                        </li>
                         <li>
                              <ul>
                                <li class="treeview">
                                         <a href="<?php echo base_url().'configuraciones/create';?>"><i class="fa fa-circle-o"></i>Crear Valor Unidad
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                      </a>
                                    </li>
                             </ul>
                        </li>

                         <?php if($habilitarContador == true) { ?>>
                         <li  
                              <ul>
                                <li class="treeview">
                                         <a href="<?php echo base_url().'informecuotas';?>"><i class="fa fa-circle-o"></i>
                                            Informe Pago Cuota
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                      </a>
                                    </li>
                             </ul>
                         </li>
                         <?php } ?>  

        
                    
                </section>
                <!-- /.sidebar -->
            </aside>