<?php
session_start();
include_once("../class/conexion.class.php" );
$id = $_GET['id'];

//$db = new MySQL();
$query="update ot set EstadoID=3 where ID=$id";
$result =  $db->consulta($query);

?>