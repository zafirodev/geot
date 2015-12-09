<?php
include("header.php");
$db = new MySQL();
$query = "SELECT * FROM personal order by NombreApellido";		  
$result =  $db->consulta($query);
$Cant=$db->num_rows($result);// obtenemos la cantidad de registros encontrados.
?>
<p align="center">Se encontraron <?php  echo $Cant; ?> Registros<br><a onClick='imprimir();' href='#'><img style="margin-top:3px;" src="img/print.jpg"></a></p>
<br>
<table border="2" align="center">
<thead>
	<tr>
		<th>Nombre</th>
		<th>Cuit/Cuil</th>
		<th>Dirección</th>
		<th>Teléfono</th>
		<th>Celular</th>
		<th>Puesto</th>
		<th>Fecha Alta</th>
		<th align="center">Acciones</th>
	</tr>
</thead>
	<?php 
	while ($result2 = $db->fetch_array($result)){// listamos de primero a ultimo
	$html = '<tr class="odd">';
	$html = $html.'<td>'.$result2['NombreApellido'].'</td>';
	$html = $html.'<td>'.$result2['CuilCuit'].'</td>';
	$html = $html.'<td>'.$result2['Direccion'].'</td>';
	$html = $html.'<td>'.$result2['Telefono'].'</td>';
	$html = $html.'<td>'.$result2['Cel'].'</td>';
	$html = $html.'<td>'.$result2['PuestoID'].'</td>';
	$html = $html.'<td>'.afecha($result2['FechaAlta']).'</td>';
	$html = $html.'<td align="center"><img src="img/borrar.png" onclick="borrar('.$result2['ID'].','."'".$result2['NombreApellido']."'".');" height="15" style="margin-bottom:3px; margin-right:-5px;" title="Borrar" alt="Borrar"><img src="img/editar.png" style="margin-left:10px;" height="20" title="Editar" onclick="editar('.$result2['ID'].');" alt="Editar"></td>';
	$html = $html.'</tr>';	
	echo $html;
	}
	?>
</table>
<div id="accion" style="display:none"></div>

<script type="text/javascript">
// esperamos que el DOM cargue
function borrar(persID,persNombre){
			if (confirm("Si continúa se eliminará toda la información concerniente a "+persNombre+".")){
				$("#accion").load("ajax/borrapers.php?" + new Date().getTime() + "&id="+persID, function(){location.reload();});

				}
			else
				{alert("No se realizaron cambios.");}

}

function editar(persID){
			location.href='modpersonal.php?ID='+persID;
}
</script>
						   
						   
						   
<?php
include("footer.php");
?>
