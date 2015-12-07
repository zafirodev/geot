<?php
session_start();
include_once("../class/conexion.class.php" );
function afecha($lafecha){	
return substr($lafecha,8,2)."/".substr($lafecha,5,2)."/".substr($lafecha,0,4);	
}
$db = new MySQL();
$EmpleadoID=$_GET['EmpleadoID'];
if ($EmpleadoID!=0){$siempleado="EmpleadoID=$EmpleadoID";} else {$siempleado="1";}
$Rubro=$_GET['Rubro'];
if ($Rubro!=0){$sirubro="r.ID=$Rubro";} else {$sirubro="1";}
$Desc=$_GET['Desc'];
if ($Desc!=0){$sidesc="s.ID=$Desc";} else {$sidesc="1";}

$query4 = "SELECT sum(stockempleado.Cantidad) as cant,
				stockempleado.ArticuloID,
				s.Descripcion as articulo,
				s.NroSerie as serie,
				r.Descripcion AS rubros,
				u.Descripcion AS unidades, p.NombreApellido AS empleado 	 
			FROM stockempleado 
				inner join stock as s 
					on stockempleado.ArticuloID = s.ID 
				inner join unidad as 
					u ON s.UnidadID = u.ID 
				inner join personal AS p
					ON p.ID=stockempleado.EmpleadoID
				INNER JOIN rubro AS r 
					ON s.RubroID = r.ID where ".$siempleado." 
			and ".$sirubro." and ".$sidesc. "
			group BY stockempleado.ArticuloID
			ORDER BY p.NombreApellido,s.Descripcion";		  
$result5 =  $db->consulta($query4);
$Cant5=$db->num_rows($result5);// stock en calle.
?>
	<p align="center">Se encontraron <?php echo $Cant5; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
	<table border="2" align="center">
		<thead>
		<tr>
        	
		<th> <select id="empstockc" class="filtroc"><option value="0">Empleado</option><?php
		$db = new MySQL();
		$query="select ID,NombreApellido from personal where PuestoID = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$EmpleadoID){$empsel="selected";} else {$empsel="";}
			echo '<option value="'.$result2['ID'].'" '.$empsel.'>'.$result2['NombreApellido'].'</option>';
		}
		?>
										</select>	</th> 
<th style="display:none;">ID Articulo</th>
			<th><select id="descstockc" class="filtroc"><option value="0">Descripcion</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
				if ($result2['ID']==$Desc){$descsel="selected";} else {$descsel="";}
			echo '<option value="'.$result2['ID'].'" '.$descsel.'>'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Numero de Serie</th>
			<th><select id="rubstockc" class="filtroc"><option value="0">Rubro</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$Rubro){$rubsel="selected";} else {$rubsel="";}
			echo '<option value="'.$result2['ID'].'" '.$descsel.'>'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
		</tr>
		</thead>
		
<?php 
		while ($result6 = $db->fetch_array($result5)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
	$html=$html.'<tr> <td>'.$result6['empleado'].'</td>';
		$html = $html.'<td>'.$result6['articulo'].'</td>';
		$html = $html.'<td>'.$result6['serie'].'</td>';
		$html = $html.'<td>'.$result6['rubros'].'</td>';
		$html = $html.'<td>'.$result6['cant'].'</td>';
		$html = $html.'<td>'.$result6['unidades'].'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>



<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
	$("select.filtroc").change(function(){
		$("#calle").load("ajax/listastockcalle.php?EmpleadoID="+$("#empstockc").val()+"&Rubro="+$("#rubstockc").val()+"&Desc="+$("#descstockc").val());
								   });
	
	
						   });
</script>                                   
