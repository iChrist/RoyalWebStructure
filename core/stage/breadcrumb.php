
<?php
 $core = new Core_Model(); 

 
 //print_r($core->breadcrumb());
  

/*while($row= $data['empresas']->fetch_assoc()){
		echo $row['sPkModule']."<br>";
		
		
	}*/
?> 
			<!-- BEGIN PAGE HEADER-->
                        <div class="col-md-6 col-sm-12">
                            <h3 class="page-title">
                            Inicio
                            <small>
                                Inicio del sistema
                            </small>
			</h3>
                        </div>
                        <?php
                            require_once (CORE_PATH.'stage/buttons.php');
                        ?>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<?= $core->breadcrumb();?>
					<!--<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Inicio</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Pagina Principal</a>
					</li>-->
				</ul>
				 
			</div>
			<!-- END PAGE HEADER-->
			 