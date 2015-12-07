<?php
session_start();
include_once("../class/conexion.class.php" );
$udescripcion = $_POST['udescripcion'];
$activo = 1;

$db = new MySQL();
$query="select * from unidad where Activo=1";
$result =  $db->consulta($query);
$yaexiuni=0;
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($udescripcion,'UTF-8')){$yaexiuni=1;}}
if ($yaexiuni==0){	
$query = "insert into unidad (Descripcion,Activo) values ('$udescripcion','$activo');";		  
$result =  $db->consulta($query);
if ($result){
	echo "La unidad $udescripcion se cargó exitosamente.";
}else{ 
	echo "La nueva unidad de medida no pudo ser cargada.";
}}
else
{	echo "Ya existe la unidad $udescripcion. No se pueden registrar dos unidades con el mismo nombre";}
?>