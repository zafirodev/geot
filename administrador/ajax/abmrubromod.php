<?php
session_start();
include_once("../class/conexion.class.php" );
$rdescripcion = $_POST['rdescripcionm'];
$rdescant=$_POST['rdescant'];
$activo = 1;
if ($rdescripcion==""){echo "Debe ingresar el nombre final del rubro"; die;}
$db = new MySQL();
$query="select * from rubro where Activo=1";
$result =  $db->consulta($query);
$yaexirub=0;
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($rdescripcion,'UTF-8')){$yaexirub=1;}}
if ($yaexirub==0){	
$query = "update rubro set Descripcion='$rdescripcion' where Descripcion='$rdescant';";		  
$result =  $db->consulta($query);
if ($result){
	echo "El rubro $rdescant ahora se llama $rdescripcion.";
}else{ 
	echo "El rubro $rdescant no pudo ser modificado.";
}}
else
{	echo "Ya existe el rubro $rdescripcion. No se pueden registrar dos rubros con el mismo nombre";}
?>