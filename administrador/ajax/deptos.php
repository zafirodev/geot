<?php
session_start();
include_once("../class/conexion.class.php" );
$db = new MySQL();
$query="select * from departamentos where provincia_id=".$_GET['prov'].' order by nombre';
$result =  $db->consulta($query);
echo '<option value="0">Departamento</option>';		
while($result2=$db->fetch_array($result)){
echo '<option value="'.$result2["id"].'">'.utf8_encode($result2["nombre"]).'</option>';		
} 


?>
