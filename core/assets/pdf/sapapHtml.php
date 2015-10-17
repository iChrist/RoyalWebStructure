<style type="text/css">
table{
    width:  100%;
}
th{
    text-align: center;
}
td{
width:  50%;
    text-align: left;
font-size: 12px;
    word-wrap: break-word;
}
span{
	text-align: left;
font-size: 12px;
    word-wrap: break-word;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <page_header>
        <table style="width: 100%;">
            <tr>
            	<td style="text-align: left; width: 85%">
		<!--<img src="udc.png" style="width:170px;height:50px;" alt="Universidad de Colima">!-->
		<span style="font-size: 12px; font-weight: bold;text-align:center;">SISTEMA ADMINISTRATIVO DEL PROCESO DE ADMISIÓN DE POSGRADO</span>
		</td>
                <td style="text-align: right; width: 15%;"><?php echo date('d/m/Y'); ?></td>
            </tr>
        </table>
	<hr>
    </page_header>
    <page_footer>
	<hr>
        <table style="width: 100%;">
            <tr>
            	<td style="text-align: left;    width: 85%">Universidad de Colima</td>
                <td style="text-align: right;    width: 15%;">P&aacute;gina [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <br><br><br><br>
<span style="font-size: 16px; font-weight: bold;text-align:center;">DATOS PERSONALES</span>
<br><br>
	<table>
<tr>
  <td><strong>Nombre: </strong></td>
  <td>{{nombre}}</td>
</tr>


<tr>
  <td><strong>Apellido Paterno: </strong></td>
  <td><strong>Apellido Materno: </strong></td>
</tr>
<tr>
<td>{{apellidoPaterno}}</td>
  <td>{{apellidoMaterno}}</td>
</tr>
 
<tr>
  <td><strong>Programa a Inscribirse: </strong></td>
  <td><strong>Sexo: </strong></td>  
</tr>
<tr>
<td>{{programa}}</td>
<td>{{sexo}}</td>
</tr>


<tr>
  <td><strong>Fecha de Nacimiento: </strong></td>
<td><strong>Nacionalidad: </strong></td>
</tr>
<tr>
<td>{{dia}}/{{mes}}/{{anio}}</td>
  <td>{{nacionalidad}}</td>
</tr>


<tr>
  <td><strong>Estado: </strong></td>
  <td><strong>Municipio: </strong></td>
</tr>
<tr>
<td>{{estado}}</td>
  <td>{{municipio}}</td>
</tr>


<tr>
  <td><strong>Calle: </strong></td>
  <td><strong>Número Ext.: </strong></td>
</tr>
<tr>
<td>{{calle}}</td>
  <td>{{numExt}}</td>
</tr>


<tr>
  <td><strong>Número Int.: </strong></td>
<td><strong>Colonia: </strong></td>
</tr>
<tr>
  <td>{{numInt}}</td>
  <td>{{colonia}}</td>
</tr>


<tr>  
  <td><strong>Código postal: </strong></td>
  <td><strong>Número de teléfono: </strong></td>
</tr>
<tr>
  <td>{{cp}}</td>
  <td>{{telefono}}</td>
</tr>


<tr>
  <td><strong>Correo electrónico: </strong></td>
  <td><strong>Curp: </strong></td>
</tr>
<tr>
  <td>{{correo}}</td>
  <td>{{curp}}</td>
</tr> 
</table>

<br><br><br><br>
<span style="font-size: 16px; font-weight: bold;text-align:center;">ANTECEDENTES ESCOLARES</span>
<br><br>

<table>

<tr>
  <td><strong>Carrera o programa: </strong></td>
</tr>
<tr>
<td>{{carrera}}</td>
</tr>


<tr>
<td><strong>Institución: </strong></td>
  <td><strong>Título recibido: </strong></td>
</tr>
<tr>
  <td>{{institucion}}</td>
  <td>{{titulo}}</td>
</tr>


<tr>
  <td><strong>Promedio: </strong></td>
  <td><strong>Año de egreso: </strong></td>
</tr>
<tr>
<td>{{promedio}}</td>
  <td>{{egreso}}</td>
</tr>

</table>

<br><br><br><br>
<span style="font-size: 16px; font-weight: bold;text-align:center;">UBICACIÓN LABORAL</span>
<br><br>

<table>

<tr>
  <td><strong>Actualmente está trabajando: </strong></td>
  <td><strong>Institución o empresa donde labora: </strong></td>
</tr>
<tr>
<td>{{trabaja}}</td>
<td>{{empresa}}</td>
</tr>


<tr>
  <td><strong>Cargo que desempena: </strong></td>
  <td><strong>Tiempo en el cargo: </strong></td>
</tr>
<tr>
  <td>{{cargo}}</td>
  <td>{{tiempoCargo}}</td>
</tr>

<tr>
  <td><strong>Dispone de tiempo que demanda el programa de posgrado para la realización de los estudios y la asistencia de las actividades académicas programadas: </strong></td>
</tr>
<tr>
  <td>{{disponeTiempo}}</td>
</tr>

</table>


</page>
