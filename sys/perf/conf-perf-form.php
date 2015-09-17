<!-- BEGIN SAMPLE FORM PORTLET-->
                    <!--<div class="portlet ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i> Nuevo Perfil
                            </div>
                        </div>
                        <div class="portlet-body form">!-->
                    <?php echo $data['msg']; 
                        $result = $data['datos']->fetch_assoc();
                    ?>
                    <form id="_save" method="post" class="form-horizontal" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Nombre</label>
                                        <div class="col-md-4">
                                            <input type="text" name="sName" class="form-control" placeholder="Enter text" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>">                                            
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Estado</label>
                                        <div class="col-md-4">
                                            <div class="radio-list">
                                                <label>
                                                <input type="radio" name="skStatus" id="optionsRadios22" value="AC" checked>Activo</label>
                                                <label>
                                                <input type="radio" name="skStatus" id="optionsRadios23" value="IN" checked>Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form><!--
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->