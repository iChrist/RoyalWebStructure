
<?php
global $core;
?> 
			<!-- BEGIN PAGE HEADER-->
                        <div class="col-md-6 col-sm-12">
                            <h3 class="page-title">
                            <?php echo utf8_encode($core->sTitle); ?>
                                <img class="page-title-loading" style="width:50px;height:50px;display:none;" alt="cargando..." src="<?php echo SYS_URL; ?>core/assets/img/loading.gif">
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
			 