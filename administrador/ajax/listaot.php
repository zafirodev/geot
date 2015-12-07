<?php
session_start();
include_once("../class/conexion.class.php" );
function afecha($lafecha){	
return substr($lafecha,8,2)."/".substr($lafecha,5,2)."/".substr($lafecha,0,4);	
}
$addq='';
$busqueda=$_GET['busqueda'];
$empleado=$_GET['tecnico'];
$estado=$_GET['estado'];
$OtID=$_GET['OtID'];
$IDCliente=$_GET['IDCliente'];
$FechaInstalacion=$_GET['FechaInstalacion'];
if ($busqueda!=""){$addquery="left join gasto_ot AS g on ot.ID=g.OtID INNER JOIN stock AS s on g.ArticuloID=s.ID where s.NroSerie like '%$busqueda%' and ";} else {$addquery="where ";}
if ($OtID!=0){$addquery.="ot.ID=$OtID and ";}
if ($estado!=0){$addquery.="ot.EstadoID=$estado and ";}
if ($IDCliente!="-356"){$addquery.="ot.ClientesID=$IDCliente and ";}
if ($FechaInstalacion!=''){$addquery.="ot.FechaInstalacion='$FechaInstalacion' and ";}
if ($empleado!=-1) {$addquery.= "PersonalID=$empleado";} else {$addquery.="1 ";}
$db = new MySQL();
$query = "SELECT ot.*,e.Descripcion AS empresa,p.NombreApellido AS empleado, est.Descripcion AS estado FROM ot inner join empresas as e ON ot.Servicio_EmpresaID = e.ID LEFT JOIN personal AS p ON ot.personalID = p.ID INNER JOIN estados AS est ON ot.EstadoID = est.ID $addquery group by (ID) order by ID desc";		  
$result =  $db->consulta($query);
$Cant=$db->num_rows($result);// obtenemos la cantidad de registros encontrados.
?>

<table border="2" align="center"><p align="center"><?php if ($Cant>1) echo "Se encontraron $Cant registros"; if ($Cant==1) echo "Se encontró 1 registro"; if ($Cant==0) echo "No se encontraron registros";?></p>
	<thead>
		<tr>
		  <th><select id="listaopot" class="filtroot"><option value="0">OT</option><?php
		if ($empleado!=-1) {$addq="where PersonalID=$empleado";}
		$query="select ID from ot $addq order by ID desc";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			if ($result4['ID']==$OtID){$otsel='selected';} else {$otsel='';}
			echo '<option value="'.$result4['ID'].'" '.$otsel.'>'.$result4['ID'].'</option>';
		}
		?>
										</select></th>
		  <th><select id="listaopcl" class="filtroot"><option value="-356">ID Cliente</option><?php
		if ($empleado!=-1) {$addq="where PersonalID=$empleado";}
		$query="select ClientesID from ot $addq group by ClientesID order by ClientesID";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			if ($result4['ClientesID']==$IDCliente){$clsel='selected';} else {$clsel='';}
			echo '<option value="'.$result4['ClientesID'].'" '.$clsel.'>'.$result4['ClientesID'].'</option>';
		}
		?>
										</select></th>
		<th>ID Visita</th>
		<th>Empresa</th>
		<th>Fecha Emisión</th>
		<th><select id="listaopfi" class="filtroot"><option value="">Fecha Instalación</option><?php
		if ($empleado!=0){if ($empleado!=-1) {$addq="where PersonalID=$empleado";}
		$query="select FechaInstalacion from ot $addq group by FechaInstalacion order by FechaInstalacion desc";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			if ($result4['FechaInstalacion']==$FechaInstalacion){$fisel='selected';} else {$fisel='';}
			echo '<option value="'.$result4['FechaInstalacion'].'" '.$fisel.'>'.afecha($result4['FechaInstalacion']).'</option>';
		}}
		?>
										</select></th>
		<th>Técnico</th>
		<th><select id="listaopes" class="filtroot"><option value="">Estado</option><?php
		$query="select ID,Descripcion from estados";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			if ($result4['ID']==$estado){$essel='selected';} else {$essel='';}
			echo '<option value="'.$result4['ID'].'" '.$essel.'>'.$result4['Descripcion'].'</option>';
		}
		?>
										</select></th>
		<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while ($result2 = $db->fetch_array($result)){// listamos de primero a ultimo
	$html = '<tr class="odd">';
	$html = $html.'<td>'.$result2['ID'].'</td>';
	$html = $html.'<td>'.$result2['ClientesID'].'</td>';
	$html = $html.'<td>'.$result2['NumeroVisita'].'</td>';
	$html = $html.'<td>'.$result2['empresa'].'</td>';
	$html = $html.'<td>'.afecha($result2['FechaEmision']).'</td>';
	$html = $html.'<td>';
	if ($result2['empleado']==""){$html = $html."Sin asignar";} else {$html = $html.afecha($result2['FechaInstalacion']);}
	echo '</td>';
	$html = $html.'<td>';
	if ($result2['empleado']==""){$html = $html."Sin asignar";} else {$html = $html.$result2['empleado'];}
	echo '</td>';
	$html = $html.'<td>'.$result2['estado'].'</td>';
	$html = $html.'<td align="center"><img src="img/borrar.png" onclick="borrar('.$result2['ID'].');" height="15" style="margin-bottom:3px; margin-right:-5px;" title="Anular" alt="Anular"><img src="img/editar.png" style="margin-left:10px;" height="20" title="Editar" onclick="editar('.$result2['ID'].');" alt="Editar"></td>';
	$html = $html.'</tr>';	
	echo $html;
	}
	?>
	</tbody>
</table>


<script type="text/javascript">

$(document).ready(function() {
					

$("select.filtroot").change(function(){
		$("#listaot").load("ajax/listaot.php?busqueda="+$("#busqueda").val()+"&tecnico="+$("#listaoptec").val()+"&OtID="+$("#listaopot").val()+"&IDCliente="+$("#listaopcl").val()+"&FechaInstalacion="+$("#listaopfi").val()+"&estado="+$("#listaopes").val());
								   });
					
});

</script>