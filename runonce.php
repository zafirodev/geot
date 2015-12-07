<?php
include_once("administrador/class/conexion.class.php" );
$db = new MySQL();
$query = "alter table usuario change Pass Pass char(40)";	
$result =  $db->consulta($query);?>