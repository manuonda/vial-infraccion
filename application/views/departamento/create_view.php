<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Crear Nueva Contravención </div>

    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="#" class="horizontal-form">
            <div class="form-body">
                <h3 class="form-section">Departamento Contravencional</h3>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Número Expediente</label>
                            <input id="num_exp_cont" class="form-control" placeholder=" Ingresar N° de Expediente" type="text"
                                   value="<?php if (isset($expediente)) echo $expediente->numero_expediente; ?>"
                                   >
                                  <!-- <span class="help-block"> This is inline help </span> -->
                        </div>
                    </div>
                    <!--/span-->
                    <!-- fecha con datapiker-->
                    <div class="col-md-3">
                        <div class="form-group has-error">
                            <label class="control-label">Fecha de Ingreso</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control" readonly="">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <!--<span class="help-block">Es obligatorio el campo fecha </span> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"> Instrucción</label>
                            <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                <option value="Category 1">49°</option>
                                <option value="Category 2">21°</option>
                                <option value="Category 3">UR1</option>
                                <option value="Category 4">34°</option>
                            </select>
                        </div>
                    </div>



                    <!--/span-->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">N° Expte. Comisaria</label>
                          <!-- <textarea class="form-control" rows="3"></textarea> -->
                            <input id="exp_comisaria" class="form-control" placeholder="Ingresar N° de Expediente" type="text"> 

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-error">
                            <label class="control-label">Fecha de Ingreso</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control" readonly="">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <!--<span class="help-block">Es obligatorio el campo fecha </span> -->
                        </div>
                    </div>
                </div>
                <!--/row-->

                <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Instructor</label>
                                <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="Category 1">Dr. Rodriguez</option>
                                    <option value="Category 2">Dr. Vargas</option>
                                    <option value="Category 3">Dr. Retamozo</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Dictamen</label>
                                <input id="dictamen" class="form-control" placeholder="N° de Dictamen" type="text">
                                <!--<span class="help-block"> This field has error. </span> -->
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Año</label>
                                <input id="dictamen" class="form-control" placeholder="Año de Dictamen" type="text">
                                <!--<span class="help-block"> This field has error. </span> -->
                            </div>
                        </div>



                        <!--/span-->
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Membership</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio"> Option 1 </label>
                                    <label class="radio-inline">
                                        <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio"> Option 2 </label>
                                </div>
                            </div>
                        </div> -->
                        <!--/span-->
                        <!-- </div> -->
                        <!--/row-->
                        <!--<h3 class="form-section">Address</h3>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input class="form-control" type="text"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text"> </div>
                            </div> -->
                        <!--/span-->
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <input class="form-control" type="text"> </div>
                        </div> -->
                        <!--/span-->
                        <!--</div>-->
                        <!--/row-->
                        <!--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Post Code</label>
                                    <input class="form-control" type="text"> </div>
                            </div> -->
                        <!--/span-->
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control"> </select>
                            </div>
                        </div> -->
                        <!--/span-->
                        <!--</div> -->
                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancelar</button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> Guardar</button>
                    </div>
                    </form>
                   