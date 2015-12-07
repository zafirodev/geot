<?php
session_start();
include_once("../class/conexion.class.php" );
function afecha($lafecha){	
return substr($lafecha,8,2)."/".substr($lafecha,5,2)."/".substr($lafecha,0,4);	
}


if (isset($_GET['Fecha'])){
$fechaot = $_GET['Fecha'];
$fechaot2= $_GET['Fecha2'];
$EmpleadoID=$_GET['tecnico'];
if ($EmpleadoID!=0){$siempleado="pe.ID=$EmpleadoID";} else {$siempleado="1";}
$OtID=$_GET['ot'];
if ($OtID!=0){$siot="ot.ID=$OtID";} else {$siot="1";}
$Desc=$_GET['articulo'];
if ($Desc!=0){$sidesc="s.ID=$Desc";} else {$sidesc="1";}} 
else {	
$sidesc=1; $siempleado=1; $siot=1;
$fechaot = $_POST['Fecha'];
$fechaot2= $_POST['Fecha2'];}
$fechac1 = strtotime($fechaot);
$fechac2 = strtotime($fechaot2);
if ($fechaot==""||$fechaot2==""){echo "<div align='center' style='color:#FFF;'>Debe completar ambas fechas.</div>"; die;}
if ($fechac1>$fechac2){echo "<div align='center' style='color:#FFF;'>La fecha Desde debe ser menor o igual a la fecha Hasta.</div>"; die;}
$db = new MySQL();
$html="";
$query4 = "SELECT sum(gasto_ot.Cantidad) as cant,
				gasto_ot.ArticuloID,
				s.Descripcion as articulo,
				s.NroSerie as serie,
				r.Descripcion AS rubros,
				u.Descripcion AS unidades,
				pe.NombreApellido as personal, ot.FechaInstalacion AS FechaInstalacion, ot.ID AS ot 		 
			FROM gasto_ot 
				inner join stock as s 
					on gasto_ot.ArticuloID = s.ID 
				inner join unidad as 
					u ON s.UnidadID = u.ID 
				INNER JOIN rubro AS r 
					ON s.RubroID = r.ID 
				INNER JOIN ot 
					ON gasto_ot.OtID = ot.ID
				INNER JOIN personal as pe
					on ot.PersonalID = pe.ID  
			WHERE ot.FechaInstalacion between '$fechaot' and '$fechaot2' and $sidesc and $siot and $siempleado group by ot.PersonalID,gasto_ot.ArticuloID order by FechaInstalacion, ArticuloID, personal";		  
$result5 =  $db->consulta($query4);
$Cant5=$db->num_rows($result5);// stock en calle.

?> <table border="2" align="center">
<thead>
	<tr>
		<th>Fecha</th>
        <th>Cantidad</th>
        <th><select id="articulo" class="filtro"><option value="0">Artículo</option><?php
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$Desc){$descsel="selected";} else {$descsel="";}
			echo '<option value="'.$result2['ID'].'" '.$descsel.' >'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
        <th> <select id="tecnico" class="filtro"><option value="0">Técnico</option><?php
		$query="select ID,NombreApellido from personal where PuestoID = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$EmpleadoID){$empsel="selected";} else {$empsel="";}
			echo '<option value="'.$result2['ID'].'" '.$empsel.' >'.$result2['NombreApellido'].'</option>';
		}
		?>
										</select>	</th>
        <th> <select id="ot" class="filtro"><option value="0">OT Todas</option><?php
		$query="select ID from ot";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$OtID){$otsel="selected";} else {$otsel="";}
			echo '<option value="'.$result2['ID'].'" '.$otsel.' >OT '.$result2['ID'].'</option>';
		}
		?>
										</select>	</th>
		<th>Nro.Serie/MAC</th>
		
  		
	</tr>
</thead>
<?php
		while ($result6 = $db->fetch_array($result5)){// listamos de primero a ultimo
		$html = $html.'<tr class="odd">';
		$html = $html.'<td>'.afecha($result6['FechaInstalacion']).'</td>';
		$html = $html.'<td>'.$result6['cant'].' '.$result6['unidades'].' </td>';
		$html = $html.'<td>'.$result6['articulo'].'</td>';
		$html = $html.'<td>'.$result6['personal'].'</td>';
		$html = $html.'<td>'.$result6['ot'].'</td>';
		$html = $html.'<td>'.$result6['serie'].'</td></tr>';
	
		}
		
		echo $html."</table>";
?>


<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
						   
		$("select.filtro").change(function(){
			$("#ajax_loader").load("ajax/consumomateriales.php?tecnico="+$("#tecnico").val()+"&articulo="+$("#articulo").val()+"&ot="+$("#ot").val()+"&Fecha="+$("#Fecha").val()+"&Fecha2="+$("#Fecha2").val());
	   });
 });
</script>
