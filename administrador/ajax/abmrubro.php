<?php
session_start();
include_once("../class/conexion.class.php" );
$rdescripcion = $_POST['rdescripcion'];
$activo = 1;

$db = new MySQL();
$query="select * from rubro where Activo=1";
$result =  $db->consulta($query);
$yaexirub=0;
while($result2=$db->fetch_array($result)){
	if (mb_strtolower($result2[1],'UTF-8')==mb_strtolower($rdescripcion,'UTF-8')){$yaexirub=1;}}
if ($yaexirub==0){	
    $query = "insert into rubro (Descripcion,Activo) values ('$rdescripcion','$activo');";
    $result =  $db->consulta($query);
    if ($result){
        echo "El rubro $rdescripcion se cargó exitosamente.";
    }else{
        echo "El nuevo rubro no pudo ser cargado.";
    }
}else{
    echo "Ya existe el rubro $rdescripcion. No se pueden registrar dos rubros con el mismo nombre";
}
?>