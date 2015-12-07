<?php
session_start();
include_once("../class/conexion.class.php" );
function afecha($lafecha){	
return substr($lafecha,8,2)."/".substr($lafecha,5,2)."/".substr($lafecha,0,4);	
}
$db = new MySQL();
$Rubro=$_GET['Rubro'];
if ($Rubro!=0){$sirubro="r.ID=$Rubro";} else {$sirubro="1";}
$Desc=$_GET['Desc'];
if ($Desc!=0){$sidesc="stock.ID=$Desc";} else {$sidesc="1";}
$query = "SELECT stock.*,u.Descripcion AS unidades,r.Descripcion AS rubros FROM stock inner join unidad as u ON stock.UnidadID = u.ID INNER JOIN rubro AS r ON stock.RubroID = r.ID where $sirubro and $sidesc";		  
$result1 =  $db->consulta($query);
$Cant=$db->num_rows($result1);// obtenemos la cantidad de registros encontrados.

?>
	   <p align="center">Se encontraron <?php echo $Cant; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
	<table border="2" align="center">
	<thead>
		<tr>
			<th style="display:none">ID Articulo</th>
			<th><select id="descstockg" class="filtrog"><option value="0">Descripcion</option><?php
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
			<th><select id="rubstockg" class="filtrog"><option value="0">Rubro</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			if ($result2['ID']==$Rubro){$rubsel="selected";} else {$rubsel="";}
			echo '<option value="'.$result2['ID'].'" '.$rubsel.'>'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
			<th>Fecha de Modificacion</th>
		</tr>
	</thead>	
		<?php 
		while ($result2 = $db->fetch_array($result1)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
		$html = $html.'<td style="display:none;">'.$result2['ID'].'</td>';
		$html = $html.'<td>'.$result2['Descripcion'].'</td>';
		$html = $html.'<td>'.$result2['NroSerie'].'</td>';
		$html = $html.'<td>'.$result2['rubros'].'</td>';
		$html = $html.'<td>'.$result2['Cantidad'].'</td>';
		$html = $html.'<td>'.$result2['unidades'].'</td>';
		$html = $html.'<td>'.afecha($result2['FechaModif']).'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>

<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
	$("select.filtrog").change(function(){
		$("#general").load("ajax/listastockgen.php?Rubro="+$("#rubstockg").val()+"&Desc="+$("#descstockg").val());
								   });
	
	
						   });
</script>                                   
