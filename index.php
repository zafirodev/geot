<?php
session_start();
header('Content-type: text/html; charset=utf-8');
?>
<html>
<header>
<link rel="stylesheet" type="text/css" href="administrador/css/estilos.css" />
<title>ASM Desarrollo - G.O.T. Comunicaciones</title>
</header>
<body>
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
