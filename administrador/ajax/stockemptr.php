<?php
session_start();
include_once("../class/conexion.class.php" );

$db = new MySQL();
											$query="select stock.*,u.Descripcion tipounidad, stockempleado.Cantidad cant from stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado on stock.ID=StockEmpleado.ArticuloID where Activo=1 and EmpleadoID=".$_GET['EmpleadoID'];
											$result =  $db->consulta($query);
											
											while($result2=$db->fetch_array($result)){
												echo '<option value="'.$result2['ID'].'">'.$result2['cant']." ".$result2['tipounidad']." de ".$result2[Descripcion].'</option>';
											}




?>
