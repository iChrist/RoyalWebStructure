
<?php
global $core;
?> 
			<!-- BEGIN PAGE HEADER-->
                        <div class="col-md-6 col-sm-12">
                            <h3 class="page-title">
                            <?php echo $core->sTitle; ?>
                            <!--<small>
                                Inicio del sistema
                            </small>!-->
			</h3>
                        </div>
                        <?php
                            require_once (CORE_PATH.'stage/buttons.php');
                        ?>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<?= $core->breadcrumb();?>
 					
					 
				</ul>
				 
			</div>
			<!-- END PAGE HEADER-->
			 