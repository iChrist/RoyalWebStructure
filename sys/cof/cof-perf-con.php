
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
         <div class="table-responsive">
								<table class="table table-hover">
								<thead>
									<tr>
										<th>Estatus</th>
										<!--<th>Perfil</th>-->
										<th> Nombre</th>
										<th>Fecha</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
 								 <?php
								 	while($row = $data['perfiles']->fetch_assoc()){
								 		echo "<tr>";
								 		echo "<td>".$row['Estatus']."</td>";
								 		//echo "<td>".$row['skProfiles']."</td>";
								 		echo "<td>".$row['sName']."</td>";
								 		echo "<td>".($row['dCreated'] ? date("d/m/Y", strtotime($row['dCreated']) ) : '')."</td>";
								 		echo "<td>Acciones</td>";
								 		echo "</tr>";
								 	}
 								 ?>
								</tbody>
								</table>
							</div>
       
        </div>
        <!-- End: life time stats -->
    </div>
</div>
