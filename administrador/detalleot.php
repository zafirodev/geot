<?php
include("header.php");
$id = $_GET['nroot'];
$db = new MySQL();
$query = "SELECT ot.*,e.Descripcion AS empresa,p.NombreApellido AS empleado, est.Descripcion AS estado FROM ot inner join empresas as e ON ot.Servicio_EmpresaID = e.ID INNER JOIN personal AS p ON ot.personalID = p.ID INNER JOIN estados AS est ON ot.EstadoID = est.ID WHERE ot.ID = '$id'";		  
$result =  $db->consulta($query);
$Cant=$db->num_rows($result);// obtenemos la cantidad de registros encontrados.
$resultot = $db->fetch_array($result);
?>

<div style="border: solid 1px;width: 500px;" align="center" class="formularios">
<p align="left">Se encontraron <? echo $Cant; ?> Registros</p>
<br>
		<label>ID Cliente:</label><input type="text" value="<? echo $resultot['ClientesID'];?>" disabled="disabled" /><br>
		<label>ID Visita:</label><input type="text" value="<? echo $resultot['NumeroVisita'];?>" disabled="disabled" /><br>
		<label>Empresa:</label><input type="text" value="<? echo $resultot['empresa'];?>" disabled="disabled" /><br>
		<label>Fecha Emision:</label><input type="text" value="<? echo $resultot['FechaEmicion'];?>" disabled="disabled" /><br>
		<label>Fecha Instalacion:</label><input type="text" value="<? echo $resultot['FechaInstalacion'];?>" disabled="disabled" /><br>
		<label>Empleado:</label><input type="text" value="<? echo $resultot['empleado'];?>" disabled="disabled" /><br>
		<label>Estado:</label><input type="text" value="<? echo $resultot['estado'];?>" disabled="disabled" /><br>
		
			<font SIZE=3 COLOR=#fff>
			<u>Materiales:</u>
			<?php
			$querymat="SELECT go.*,s.Descripcion,s.NroSerie  
						FROM gasto_ot as go 
						inner join stock as s 
						on go.ArticuloID = s.ID  
						where go.OtID = '$id'";
			$resultm =  $db->consulta($querymat);
			
			while($resultmat=$db->fetch_array($resultm)){
				echo '<ol>'.$resultmat[Descripcion].': <font SIZE=5 color=white>'.$resultmat[Cantidad].'</font> Nro.Serie/MAC: '.$resultmat[NroSerie].'</ol>';
			}
			?>

			</font>

</div>
<p align="center"><a href="listaoperacion.php">Volver..</a></p>
<?php
include("footer.php");
?>
