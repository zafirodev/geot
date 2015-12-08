<?php
include_once("class/login.class.php");
include_once("class/conexion.class.php" );
$login=new login();
$login->inicia();
function afecha($lafecha){	
return substr($lafecha,8,2)."/".substr($lafecha,5,2)."/".substr($lafecha,0,4);
}
header('Content-type: text/html; charset=utf-8');
?>
<html>
<head>
<script type="text/javascript" src="inc/jquery-1.3.2.js"></script>
<script type="text/javascript" src="inc/jquery.form.js"></script>
<script type="text/javascript" src="inc/datepicker/jquery.datepick.js"></script>
<!-- <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAASvDE0QpBvBhK6m8KAQTFRRS72yV0ZR0YeBuqhNeIbRqq1BUtHxQ9H-8ncVjlyFt38jaIPKTwvuiqYg" type="text/javascript"></script> -->

<link rel="stylesheet" href="estilosg.css" type="text/css">
<style type="text/css">
		@import "inc/datepicker/humanity.datepick.css";
</style>
<title>ASM Desarrollo - G.O.T Comunicaciones</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<SCRIPT language="javascript">
function imprimir() {
		if ((navigator.appName == "Netscape")) { window.print() ;
	}
	else {
		var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
		document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = "";
	}
}
function cargar() {
	if (GBrowserIsCompatible()) {
   var map2 = new GMap2(document.getElementById("map2"));
   map2.addControl(new GSmallMapControl());
   map2.addControl(new GMapTypeControl());
   map2.setCenter(new GLatLng(37.4419, -122.1419), 13);
	} 
}
</SCRIPT>
</head>
<body  ondragstart='return false'>
<div class="contenedor">
<div align="center" id="cabecera" >
	<img src="img/GEOTLOGO.png" alt="logo" width="300" align="left">
    <div style="float: right; padding-right: 5px;"><?php echo date("F j, Y, g:i a"); ?></div>
</div>
<div id="tabsH">
	<ul>
	  <li><a href="altastock.php"><span>Stock Altas | </span></a></li>
	  <li><a href="listastock.php"><span>Listar Stock | </span></a></li>
	  <li><a href="consumodemateriales.php"><span>Consumo de Materiales | </span></a></li>
	  <li><a href="cargaoperacion.php"><span>Cargar OT | </span></a></li>
	  <li><a href="listaoperacion.php"><span>Listar OT | </span></a></li>
	  <li><a href="altapersonal.php"><span>Alta Personal | </span></a></li>
	  <li><a href="listapersonal.php"><span>Lista Personal | </span></a></li>
<!--	  <li><a href="otmap.php"><span>OTmap | </span></a></li> -->
      <li><a href="../index.php?cerrar=1"><span>Cerrar sesión</span></a></li>
	</ul>
</div>
<div class="cuerpo">
<br>
<br>
