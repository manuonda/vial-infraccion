   <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            
                             
                             <?php 

                                

                                $initGrupoSeccion="";  
                                foreach($listado as $gruposeccion): 
                                    

                                        echo "<li class='nav-item'>";
                                        echo " <a href='javascript:;' class='nav-link nav-toggle'>";
                                        echo " <i class='icon-diamond'></i>";
                                        echo " <span class='title'>".$gruposeccion['grupo_seccion']."</span>";
                                        echo " <span class='arrow'></span>";
                                        echo " </a>";
                                        echo " <ul class='sub-menu'>";
                                       
                                       if(sizeof($gruposeccion['seccion'])>0){
                                            foreach($gruposeccion['seccion'] as $item) : 
                                              echo "<li class='nav-item '>";
                                              echo "<a href='".$item->url."' class='nav-link '>";
                                              echo "<span class='title'>".$item->nombre."</span>";
                                              echo "</a>";
                                              echo "</li>";

                                             endforeach;
                                            echo "</ul>";
                                            echo "</li>";


                                       }else{
                                         echo "</ul>";
                                         echo "</li>";
                                       }


                                endforeach;

                            ?>

                          
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->