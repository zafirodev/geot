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

$query3 = "SELECT stockempleado.*,
				p.NombreApellido as nombre,
				s.Descripcion as articulo,
				s.NroSerie as serie,
				r.Descripcion AS rubros,
				u.Descripcion AS unidades 		 
			FROM stockempleado 
				inner join stock as s 
					on stockempleado.ArticuloID = s.ID 
				inner join personal as p 
					on stockempleado.EmpleadoID = p.ID 
				inner join unidad as 
					u ON s.UnidadID = u.ID 
				INNER JOIN rubro AS r 
					ON s.RubroID = r.ID where ".$siempleado." 
			and ".$sirubro." and ".$sidesc. "
					
                  
			ORDER BY p.NombreApellido,s.Descripcion";		  
$result3 =  $db->consulta($query3);
$Cant3=$db->num_rows($result3);// stock por empleado
?>
	<p align="center">Se encontraron <?php echo $Cant3; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
   
	<table border="2" align="center">
		<thead>
		<tr>
			<th> <select id="empstock" class="filtro"><option value="0">Empleado</option><?php
		$query="select ID,NombreApellido from personal where PuestoID = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$EmpleadoID){$empsel="selected";} else {$empsel="";}
			echo '<option value="'.$result2['ID'].'" '.$empsel.' >'.$result2['NombreApellido'].'</option>';
		}
		?>
										</select>	</th>
			<th style="display:none;">ID Articulo</th>
			<th><select id="descstock" class="filtro"><option value="0">Descripcion</option><?php
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$Desc){$descsel="selected";} else {$descsel="";}
			echo '<option value="'.$result2['ID'].'" '.$descsel.' >'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Numero de Serie</th>
			<th><select id="rubstock" class="filtro"><option value="0">Rubro</option><?php
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$Rubro){$rubsel="selected";} else {$rubsel="";}
			echo '<option value="'.$result2['ID'].'" '.$rubsel.' >'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
			<th>Fecha de Modificacion</th>
		</tr>
		</thead>
		<?php 
		while ($result4 = $db->fetch_array($result3)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
		$html = $html.'<td>'.$result4['nombre'].'</td>';
		$html = $html.'<td style="display:none;">'.$result4['ArticuloID'].'</td>';
		$html = $html.'<td>'.$result4['articulo'].'</td>';
		$html = $html.'<td>'.$result4['serie'].'</td>';
		$html = $html.'<td>'.$result4['rubros'].'</td>';
		$html = $html.'<td>'.$result4['Cantidad'].'</td>';
		$html = $html.'<td>'.$result4['unidades'].'</td>';
		$html = $html.'<td>'.afecha($result4['FechaModifica']).'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>


<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
	$("select.filtro").change(function(){
		$("#empleado").load("ajax/listastockemp.php?EmpleadoID="+$("#empstock").val()+"&Rubro="+$("#rubstock").val()+"&Desc="+$("#descstock").val());
								   });
	
	
						   });
</script>                                   
