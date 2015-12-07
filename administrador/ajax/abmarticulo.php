<?php
session_start();
include_once("../class/conexion.class.php" );
	$db = new MySQL();
if(isset($_POST['cantidadactualiza'])){
	$Idart = $_POST['articulo']; 
	$cantidadact = $_POST['cantidadactualiza'];
	$query = "select Cantidad from stock where ID = '$Idart'";		  
	$result2 =  mysql_result($db->consulta($query),0);
	if ($result2+$cantidadact<0){echo "No hay suficiente stock."; die;}
	$query = "update stock SET Cantidad = Cantidad + '$cantidadact' where ID = '$Idart'";		  
	$result =  $db->consulta($query);
		if ($result){
			echo "El artículo fue actualizado con éxito.";
		}else{ 
			echo "El artículo NO pudo ser actualizado.";
		}
}elseif(isset($_POST['cantidadactualizae'])){
	$Idart = $_POST['articulo']; 
	$cantidadact = $_POST['cantidadactualizae'];
	$empleadoID = $_POST['tecnico'];
	$query = "select Cantidad from stockempleado where ArticuloID = '$Idart' and EmpleadoID=$empleadoID";		  
	$result2 =  mysql_result($db->consulta($query),0);
	//if ($result2+$cantidadact<0){echo "El empleado no tiene suficiente stock. No se realizaron cambios."; die;}
		$query = "select Cantidad from stock where ID = '$Idart'";		  
	$result2 =  mysql_result($db->consulta($query),0);
	if ($result2-$cantidadact<0){echo "No hay suficiente stock en base. No se realizaron cambios"; die;}
	$query = "update stockempleado SET stockempleado.Cantidad = stockempleado.Cantidad + '$cantidadact' where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$empleadoID' ";		  
	//die($query);
	$result =  $db->consulta($query);
		if ($result){
			$query2 = "update stock SET Cantidad = Cantidad - '$cantidadact' where stock.ID = '$Idart'";	
			$result2 =  $db->consulta($query2);
			echo "El stock del técnico fue actualizado con éxito.";
		}else{ 
			echo "El stock del técnico NO pudo ser actualizado.";
		}
}elseif(isset($_POST['cantidadtrasp'])){
	$Idart = $_POST['traspstempart']; 
	$cantidadact = $_POST['cantidadtrasp'];
	$empleadoID = $_POST['traspstemp'];
	$empleado2ID = $_POST['traspstemp2'];
	$query = "select Cantidad from stockempleado where ArticuloID = '$Idart' and EmpleadoID=$empleadoID";		  
	$result2 =  mysql_result($db->consulta($query),0);
	if ($result2-$cantidadact<0){echo "El empleado no tiene suficiente stock. No se realizaron cambios."; die;}
	$query = "select ArticuloID from stockempleado where ArticuloID = '$Idart' and EmpleadoID=$empleado2ID";		  
	$result2 =  @mysql_result($db->consulta($query),0);
	if ($result2!=$Idart){echo "El empleado no dispone del artículo. Debe agregarlo en altas. No se realizaron cambios."; die;}
	$query = "update stockempleado SET stockempleado.Cantidad = stockempleado.Cantidad - '$cantidadact' where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$empleadoID' ";		  
//die($query);
	$result =  $db->consulta($query);
	$query = "update stockempleado SET stockempleado.Cantidad = stockempleado.Cantidad + '$cantidadact' where stockempleado.ArticuloID = '$Idart' AND stockempleado.EmpleadoID = '$empleado2ID' ";	
	$result =  $db->consulta($query);
		if ($result){
				echo "El stock fue traspasado con éxito.";
		}else{ 
			echo "El stock NO pudo ser traspasado.";
		}
}elseif(isset($_POST['cantidade'])){
	$Idart = $_POST['articulo']; 
	$cantidad = $_POST['cantidade'];
	$empleadoID = $_POST['tecnico'];
	$query="select Descripcion from stock where ID=".$Idart;
	$result =  $db->consulta($query);
	while($result2=$db->fetch_array($result)){ $DescArt=$result2['Descripcion'];}
	$query="select NombreApellido from personal where ID=".$empleadoID;
	$result =  $db->consulta($query);
	while($result2=$db->fetch_array($result)){ $NomApe=$result2['NombreApellido'];}
	$query="select ID from stockempleado where EmpleadoID=".$empleadoID.' and ArticuloID='.$Idart;
	$result =  $db->consulta($query);
	if (mysql_num_rows($result)>0){
	
	echo 'El empleado '.$NomApe.' ya tiene registrado el artículo '.$DescArt.'. Utilice la opción de Actualización de Stock Empleado para modificar la cantidad del mismo.'; die;} else {	
	$query = "select Cantidad from stock where ID = '$Idart'";		  
	$result2 =  mysql_result($db->consulta($query),0);
	if ($result2-$cantidad<0){echo "No hay suficiente stock en base. No se realizó el alta."; die;}
	$query = "insert into stockempleado (Cantidad,ArticuloID,EmpleadoID,FechaModifica) values ('$cantidad','$Idart','$empleadoID',NOW());";
	$result =  $db->consulta($query);
		if ($result){
			$query2 = "update stock SET Cantidad = Cantidad - '$cantidad' where stock.ID = '$Idart'";	
			$result2 =  $db->consulta($query2);
			echo "El artículo fue ingresado con éxito..";
		}else{ 
			echo "El artículo NO pudo ser ingresado.";
		}
	}
}else{
	$descripcion = $_POST['descripcion'];
	$rubro = $_POST['rubro'];
	$unidad = $_POST['unidad'];
	$cantidad = $_POST['cantidad'];
	$serie = $_POST['serie'];
	$merma = 0;
$query="select ID,Descripcion from stock where Descripcion='".$descripcion."'";
$result =  $db->consulta($query);
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($descripcion,'UTF-8')){
		echo "No se puede completar la operación. Ya existe un artículo con el nombre $descripcion."; die;}}

	$query = "insert into stock (Descripcion,RubroID,Cantidad,Merma,UnidadID,FechaModif,NroSerie) values ('$descripcion','$rubro','$cantidad','$merma','$unidad',NOW(),'$serie');";		  
	$result =  $db->consulta($query);
	if ($result){
		echo "El nuevo artículo fue cargado con éxito.";
	}else{ 
		echo "El nuevo artículo NO pudo ser cargado.";
	}

}
?>
