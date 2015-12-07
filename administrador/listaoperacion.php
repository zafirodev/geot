<?php
include("header.php");
$db = new MySQL();
$query = "SELECT ot.*,e.Descripcion AS empresa,p.NombreApellido AS empleado, est.Descripcion AS estado FROM ot inner join empresas as e ON ot.Servicio_EmpresaID = e.ID LEFT JOIN personal AS p ON ot.personalID = p.ID INNER JOIN estados AS est ON ot.EstadoID = est.ID  order by ID desc";		  
$result =  $db->consulta($query);
$Cant=$db->num_rows($result);// obtenemos la cantidad de registros encontrados.
?>
<p align="center"><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
<p>Filtrar por Serie/Mac: <input type="text" id="busqueda" name="busqueda">     Técnico:<select name="listaoptec" id="listaoptec"><option value="-1">Técnico</option><option value="0">Sin asignar</option><?php
										
										$query="select * from personal where PuestoID = 1 order by NombreApellido";
										$result3 =  $db->consulta($query);
										
										while($result4=$db->fetch_array($result3)){
											echo '<option value="'.$result4['ID'].'">'.$result4['NombreApellido'].'</option>';
										}
										?>


</select></p>

<div id="listaot"><p align="center">Se encontraron <?php echo $Cant; ?> Registros</p>
<table border="2" align="center">
	<thead>
		<tr>
        <th><select id="listaopot" class="filtroot"><option value="0">OT</option><?php
		$query="select ID from ot order by ID desc";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			echo '<option value="'.$result4['ID'].'">'.$result4['ID'].'</option>';
		}
		?>
										</select></th>
				  <th><select id="listaopcl" class="filtroot"><option value="-356">ID Cliente</option><?php
		$query="select ClientesID from ot group by ClientesID order by ClientesID";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			echo '<option value="'.$result4['ClientesID'].'">'.$result4['ClientesID'].'</option>';
		}
		?>
										</select></th>
		<th>ID Visita</th>
		<th>Empresa</th>
		<th>Fecha Emisión</th>
		 <th><select id="listaopfi" class="filtroot"><option value="">Fecha Instalación</option><?php
		$query="select FechaInstalacion from ot group by FechaInstalacion order by FechaInstalacion desc";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			echo '<option value="'.$result4['FechaInstalacion'].'">'.afecha($result4['FechaInstalacion']).'</option>';
		}
		?>
										</select></th>
		<th>Técnico</th>
		<th><select id="listaopes" class="filtroot"><option value="">Estado</option><?php
		$query="select ID,Descripcion from estados";
		$result3 =  $db->consulta($query);
		while($result4=$db->fetch_array($result3)){
			echo '<option value="'.$result4['ID'].'">'.$result4['Descripcion'].'</option>';
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
</div>
<div id="accion" style="display:none"></div>
<script type="text/javascript">
function borrar(OtID){
			if (confirm("Si continúa se anulará la OT "+OtID+".")){
				$("#accion").load("ajax/borraot.php?id="+OtID, function(){$("#listaot").load("ajax/listaot.php?busqueda="+$("#busqueda").val()+"&tecnico="+$("#listaoptec").val());});

				}
			else
				{alert("No se realizaron cambios.");}

}

function editar(OtID){
			location.href='cargaoperacion.php?mod=1&OtID='+OtID;
}

$(document).ready(function() {
					
		
$("#busqueda").keypress(function(e) {
		if(e.keyCode==13) {
			$("#listaot").load("ajax/listaot.php?busqueda="+$("#busqueda").val()+"&tecnico="+$("#listaoptec").val()+"&OtID="+$("#listaopot").val()+"&IDCliente="+$("#listaopcl").val()+"&FechaInstalacion="+$("#listaopfi").val()+"&estado="+$("#listaopes").val());
		}
							  });
$("#listaoptec").change(function(){
								$("#listaot").load("ajax/listaot.php?busqueda="+$("#busqueda").val()+"&tecnico="+$("#listaoptec").val()+"&OtID="+$("#listaopot").val()+"&IDCliente="+$("#listaopcl").val()+"&FechaInstalacion="+$("#listaopfi").val()+"&estado="+$("#listaopes").val());
								 
								 });
$("select.filtroot").change(function(){	
								$("#listaot").load("ajax/listaot.php?busqueda="+$("#busqueda").val()+"&tecnico="+$("#listaoptec").val()+"&OtID="+$("#listaopot").val()+"&IDCliente="+$("#listaopcl").val()+"&FechaInstalacion="+$("#listaopfi").val()+"&estado="+$("#listaopes").val());
								   });
					
});

</script>
<?php
include("footer.php");
?>
