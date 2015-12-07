<?php
session_start();
include_once("../class/conexion.class.php" );
$udescripcion = $_POST['udescripcionm'];
$udescant=$_POST['udescant'];
$activo = 1;
if ($udescripcion==""){echo "Debe ingresar el nombre final de la unidad"; die;}
$db = new MySQL();
$query="select * from unidad where Activo=1";
$result =  $db->consulta($query);
$yaexiuni=0;
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($udescripcion,'UTF-8')){$yaexiuni=1;}}
if ($yaexiuni==0){	
$query = "update unidad set Descripcion='$udescripcion' where Descripcion='$udescant';";		  
$result =  $db->consulta($query);
if ($result){
	echo "La unidad de medida $udescant ahora se llama $udescripcion.";
}else{ 
	echo "La unidad de medida $udescant no pudo ser modificada.";
}}
else
{	echo "Ya existe la unidad de medida $udescripcion. No se pueden registrar dos unidades con el mismo nombre";}
?>

