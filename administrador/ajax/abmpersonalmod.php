<?php
session_start();
include_once("../class/conexion.class.php" );
$nombreapellido = $_POST['nombreapellido'];
$cuilcuit = abs($_POST['cuilcuit']);
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$prov=$_POST['prov'];
if (isset($_POST['depto'])) $depto=$_POST['depto'];
if (isset($_POST['localidad'])) $localidad=$_POST['localidad'];
$puesto = $_POST['puesto'];
$falta = substr($_POST['falta'],8,4)."-".substr($_POST['falta'],3,2)."-".substr($_POST['falta'],0,2);


if ($nombreapellido=="") {echo "Debe completar nombre y apellido."; die;}
$db = new MySQL();
$query="select ID,NombreApellido from personal where NombreApellido='".$nombreapellido."'";
$result =  $db->consulta($query);
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($nombreapellido,'UTF-8')){
		if ($result2[0]!=$_POST['ID']){echo "No se puede completar la operación. Ya existe $nombreapellido."; die;}}}
if (!is_numeric($cuilcuit)) {echo "Debe ingresar el CUIT/CUIL."; die;}
if ((strlen($cuilcuit)<10)||(strlen($cuilcuit)>11)) {echo "Debe ingresar el CUIT/CUIL sin guiones."; die;}
if ($direccion=="") {echo "Debe ingresar una dirección."; die;}
if (!is_numeric($telefono)) {echo "Debe ingresar el teléfono sin guiones."; die;}
if (strlen($telefono)<2) {echo "Debe ingresar un teléfono."; die;}
if (strlen($celular)<2) {echo "Debe ingresar un celular."; die;}
if (!is_numeric($celular)) {echo "Debe ingresar el celular sin guiones."; die;}
if ($prov==0){echo "Debe ingresar la provincia."; die;}
if ($depto==0){echo "Debe ingresar el departamento."; die;}
if ($localidad==0){echo "Debe ingresar la localidad."; die;}

$db = new MySQL();
$query = "update personal set NombreApellido ='$nombreapellido',CuilCuit='$cuilcuit',Direccion='$direccion',Telefono='$telefono',PuestoID='$puesto',FechaAlta='$falta',FechaBaja='1111-11-11',ProvinciaID='$prov',LocalidadID='$localidad',Cel='$celular',DepartamentoID='$depto' where ID=".$_POST['ID'];		  
$result =  $db->consulta($query);
if ($result){
	echo "@El empleado $nombreapellido fue modificado con éxito.";
}else{ 
	echo "El empleado $nombreapellido no pudo ser modificado.";
} 
?>
