<?php
session_start();
include_once("../class/conexion.class.php" );
$db = new MySQL();
$query="select * from localidades where departamento_id=".$_GET['depto'].' order by nombre';
$result =  $db->consulta($query);
echo '<option value="0">Localidad</option>';		
while($result2=$db->fetch_array($result)){
echo '<option value="'.$result2["id"].'">'.utf8_encode($result2["nombre"]).'</option>';		
} 
?>
