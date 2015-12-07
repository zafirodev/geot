<?php
include_once("class/conexion.class.php" );
$db = new MySQL();
$user="pablo";
$pass=MD5("sirparte");
$query = "insert into usuario values (ID,203,'$user','$pass',1,'".date("Y-m-d")."',1)";		  
$result =  $db->consulta($query);
