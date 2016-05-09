
<?php
global $dash;
?>
<div class="clearfix">
			</div>
 <div class="row">

	 <?php  $dash->numUser();?>
	 <?php  $dash->numEmpresas();?>
	 <?php  $dash->numReferencias();?>
	 <?php  $dash->numRevalidaciones();?>

</div>


<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6">
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Referencias en Sistema por Año
							</div>

						</div>
						<div class="portlet-body">
							<!--<div id="pie_chart_6" class="chart">
							</div>-->
							<div id="chart_div"></div>
							<div id="columnchart_material" ></div>

						</div>
					</div>

				</div>
				<div class="col-md-6">
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Referencias en Sistema por Mes (Año actual)
							</div>

						</div>
						<div class="portlet-body">
							<!--<div id="pie_chart_6" class="chart">
							</div>-->
							<div id="chart_div"></div>
							<div id="columnchart_material1" ></div>


						</div>
					</div>

				</div>




			<!--	<div class="col-md-12">
				<center>
				<img src="<?php echo SYS_URL; ?>core/assets/img/logo.svg" style="width:300px;height:200px;margin-top:40px;" />
				</center>
				</div>
			</div>-->
			<!--<div class="row ">

				<div class="col-md-6 col-sm-6">
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bell"></i>Opciones
							</div>

						</div>
						<div class="portlet-body">
							<div class="table-scrollable">

							</div>
						</div>
					</div>
				</div>-->
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				    <script type="text/javascript">

						google.charts.load('current', {'packages':['bar']});
						google.charts.setOnLoadCallback(drawChart);
						function drawChart() {
							var data = google.visualization.arrayToDataTable([
							/*	['Año', 'Referencia' ],
								['2015', 330],
								['2016', 560]*/
								<?php  $dash->numRefeano();?>
							]);

							var options = {
								chart: {
									title: 'Agencia Aduanal Grupo Alvez',
									subtitle: 'Referencias creadas  en el sistema: 2015-2016',
								}
							};

							var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

							chart.draw(data, options);
						}
						google.charts.setOnLoadCallback(drawChart1);

						function drawChart1() {
							var data = google.visualization.arrayToDataTable([
								<?php   $dash->numRefeMes();?>
 							]);
 							var options = {
								chart: {
									title: 'Agencia Aduanal Grupo Alvez',
									subtitle: 'Referencias creadas  en el sistema 2016',
								}
							};
 							var chart1 = new google.charts.Bar(document.getElementById('columnchart_material1'));
 							chart1.draw(data, options);
						}
						
 				    </script>
