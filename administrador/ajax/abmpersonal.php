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
$falta = $_POST['falta'];
$db = new MySQL();

if ($nombreapellido=="") {echo "Debe completar nombre y apellido."; die;}
$query="select NombreApellido from personal";
$result =  $db->consulta($query);
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[0],'UTF-8')==mb_strtolower($nombreapellido,'UTF-8')){
echo "No se puede completar la operación. Ya existe $nombreapellido."; die;}}
if (!is_numeric($cuilcuit)) {echo "Debe ingresar el CUIT/CUIL."; die;}
if ((strlen($cuilcuit)<10)||(strlen($cuilcuit)>11)) {echo "Debe ingresar el CUIT/CUIL sin guiones."; die;}
$query="select CuilCuit from personal";
$result =  $db->consulta($query);
while($result2=$db->fetch_array($result)){
	if ($result2[0]==$cuilcuit){
echo "No se puede completar la operación. Ya existe un registro de CUIL/CUIT $cuilcuit."; die;}}
if ($direccion=="") {echo "Debe ingresar una dirección."; die;}
if (!is_numeric($telefono)) {echo "Debe ingresar el teléfono sin guiones."; die;}
if (strlen($telefono)<2) {echo "Debe ingresar un teléfono."; die;}
if (strlen($celular)<2) {echo "Debe ingresar un celular."; die;}
if (!is_numeric($celular)) {echo "Debe ingresar el celular sin guiones."; die;}
if ($prov==0){echo "Debe ingresar la provincia."; die;}
if ($depto==0){echo "Debe ingresar el departamento."; die;}
if ($localidad==0){echo "Debe ingresar la localidad."; die;}

$db = new MySQL();
$query = "insert into personal  (NombreApellido,CuilCuit,Direccion,Telefono,PuestoID,FechaAlta,FechaBaja,ProvinciaID,LocalidadID,Cel,DepartamentoID) values ('$nombreapellido','$cuilcuit','$direccion','$telefono','$puesto',NOW(),'1111-11-11','$prov','$localidad','$celular','$depto');";		  
$result =  $db->consulta($query);
if ($result){
	echo "@El empleado $nombreapellido fue ingresado con éxito.";
}else{ 
	echo "El nuevo empleado no pudo ser ingresado.";
} 
?>
