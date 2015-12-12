<?php
session_start();
header('Content-type: text/html; charset=utf-8');
header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );
?>
<html>
<header>
<link rel="stylesheet" type="text/css" href="administrador/css/estilos.css" />
<title>ZafiroDev - GEOT Telecomunicaciones</title>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
</header>
<body onLoad="if ('Navigator' == navigator.appName)document.forms[0].reset();">
<div align="center" id="cabecera">
	<img src="administrador/img/GEOTLOGO.png" alt="logo" width="300" align="left">
    <div style="float: right; padding-right: 5px;"><?php echo date("F j, Y, g:i a"); ?></div>
</div>
<div id="cuerpoinicio">
    <p>Introduzca usuario y contraseña para ingresar al sistema</p>
    <form name="frm_login" method="post" action="administrador/login.php">
        <p>Usuario: </p><input type="text" size="20" name="user" /><br />
        <p>Clave:   </p><input type="password" size="20" name="pass" /><br />
        <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
    </form>
</div>
</body>
</html>
<?php
if (isset($_GET['error'])) {
    echo '<p align="center"><b>Usuario o clave incorrecta</b></p>';
}
?>
