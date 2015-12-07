<?php
session_start();
include_once("../class/conexion.class.php" );
$ClientesID = $_POST['idcliente'];
$Servicio_EmpresaID = $_POST['empresa'];
$FechaEmision = $_POST['FechaEmision'];
$FechaInstalacion = $_POST['FechaInstalacion'];
$PersonalID = $_POST['tecnico'];
if ($PersonalID==0){$FechaInstalacion=date("Y-m-d");}
$Comentarios = $_POST['comentarios'];

$EstadoID = $_POST['estadoot'];
$NumeroVisita = $_POST['visita'];
$db = new MySQL();
$mod=$_POST['mod'];
$OtID=$_POST['OtID'];


if($mod==1){
$query5 = "update ot set ClientesID='$ClientesID',Servicio_EmpresaID='$Servicio_EmpresaID',FechaEmision='$FechaEmision',FechaInstalacion='$FechaInstalacion',Comentarios='$Comentarios',PersonalID='$PersonalID',EstadoID='$EstadoID',NumeroVisita='$NumeroVisita' where ID='".$OtID."'";
$result5 =  $db->consulta($query5);
if ($result5){
// materiales
				$query="select stock.*,u.Descripcion tipounidad from stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado as o on stock.ID = o.ArticuloID where Activo=1 and o.EmpleadoID=".$PersonalID;
				$result =  $db->consulta($query);
				$ultimoID=mysql_insert_id();
				while($result2=$db->fetch_array($result)){
					$Idart = $result2['ID'];
					$cantidadact=(int) $_POST[$result2['ID']];
					$query="select Cantidad from stockempleado where ArticuloID='".$result2['ID']."' and EmpleadoID='".$PersonalID."'";
					$result8=$db->consulta($query);
					$cantemp=mysql_result($result8,0);
					$query="select Cantidad from gasto_ot where ArticuloID='".$result2['ID']."' and OtID='".$OtID."'";
					$result7=$db->consulta($query);
					if (mysql_num_rows($result7)>0){	
						$cantant=mysql_result($result7,0);
					
						if ($cantemp-($cantidadact-$cantant)<0) {echo "$query d $cantidadact 3 $cantant sError en el ajuste de materiales. Reitere los ajustes desde el artículo ".$result2['Descripcion']; die;}
						$query6 = "update gasto_ot set Cantidad='$cantidadact' where OtID=".$OtID." and ArticuloID=".$result2['ID'];		  						$result7=$db->consulta($query6);
						$query3 = "update stockempleado SET stockempleado.Cantidad = (stockempleado.Cantidad - ($cantidadact-$cantant)) where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$PersonalID' ";		  
						//die($query);
						$result3 =  $db->consulta($query3);}
						else
						{
						$query6 = "insert into gasto_ot values (ID, '$OtID', '$Idart','$cantidadact')";		  
						$result6 =  $db->consulta($query6);
						//die($cantidadact);
						$query3 = "update stockempleado SET stockempleado.Cantidad = stockempleado.Cantidad - '$cantidadact' where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$PersonalID' ";		  
						//die($query);
						$result3 =  $db->consulta($query3);}
					
				}
//fin de materiales
				


	echo "@La OT $OtID fue modificada con éxito.";
	
}else{ 
	echo "La OT $OtID no pudo ser modificada.";
}
}
else
{
$query5 = "insert into ot (ClientesID,Servicio_EmpresaID,FechaEmision,FechaInstalacion,Comentarios,PersonalID,EstadoID,NumeroVisita) values ('$ClientesID','$Servicio_EmpresaID','$FechaEmision','$FechaInstalacion','$Comentarios','$PersonalID','$EstadoID','$NumeroVisita');";		  
$result5 =  $db->consulta($query5);
if ($result5){
// materiales
				$query="select stock.*,u.Descripcion tipounidad from stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado as o on stock.ID = o.ArticuloID where Activo=1 and o.EmpleadoID=".$PersonalID;
				$result =  $db->consulta($query);
				$ultimoID=mysql_insert_id();
				while($result2=$db->fetch_array($result)){
					$Idart = $result2['ID'];
					$cantidadact= (int) $_POST[$result2['ID']];
						if($cantidadact >= 0){
						$query6 = "insert into gasto_ot (OtID,ArticuloID,Cantidad) values ('$ultimoID','$Idart','$cantidadact')";		  
						$result6 =  $db->consulta($query6);
						//die($cantidadact);
						$query3 = "update stockempleado SET stockempleado.Cantidad = stockempleado.Cantidad - '$cantidadact' where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$PersonalID' ";		  
						//die($query);
						$result3 =  $db->consulta($query3);
					}
				}
//fin de materiales
				$query="select ID from ot order by ID DESC limit 1";
				$result =  $db->consulta($query);
				while($result2=$db->fetch_array($result)){$OtID=$result2['ID'];}


	echo "La nueva OT $OtID fue cargada con exito..";
	//header("Location: http://www.cristalab.com");
}else{ 
	echo "La nueva OT no pudo ser cargada..";
}
}
?>
