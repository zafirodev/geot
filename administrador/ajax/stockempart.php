<?php
session_start();
include_once("../class/conexion.class.php" );

$db = new MySQL();
$query="select stock.Descripcion,u.Cantidad cantidad from stock inner join stockempleado as u on stock.ID = u.ArticuloID where EmpleadoID=".$_GET['EmpleadoID'].' and ArticuloID='.$_GET['ArticuloID'];
											$result =  $db->consulta($query);
											
											while($result2=$db->fetch_array($result)){
												echo 'Actualmente tiene '.$result2['cantidad'].' unidades.';
											}




?>
