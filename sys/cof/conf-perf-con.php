
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
    
    <div class="table-responsive">
								<table class="table table-hover">
								<thead>
								<tr>
									 
									<th>
										 Perfil
									</th>
									<th>
										 Nombre
									</th>
									<th>
										 Estatus
									</th>
									<th>
										 Fecha
									</th>
									<th>
										 Acciones
									</th>
								</tr>
								</thead>
								<tbody>
								
								 <?php
								 	$html = "<tr>";
									   while($row= $data['perfiles']->fetch_assoc()){
									   
			 							$html.="<td> ".print_r($row['skProfiles'])." </td>
												<td>  ".print_r($row['sName'])." </td>
												<td>  ".print_r($row['skStatus'])." </td>
												<td> ".print_r($row['dCreated'])." </td>";
												 
											
 									    }
 									   echo  $html."</tr>";
 									    
 									    
								 ?>
								 
								<tr>
 									<td>
										 Perfil1
									</td>
									<td>
										 Perfil1
									</td>
									<td>
										 Activo
									</td>
									<td>
										20/10/2014
									</td>
									<td>
										<span class="label label-sm label-danger">
										Blocked </span>
									</td>
								</tr>
								</tbody>
								</table>
							</div>
       
        </div>
        <!-- End: life time stats -->
    </div>
</div>
