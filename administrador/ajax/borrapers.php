<?php
session_start();
include_once("../class/conexion.class.php" );
$id = $_GET['id'];

$db = new MySQL();
$query="delete from personal where ID=$id";
$result =  $db->consulta($query);
?>