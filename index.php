<?php
session_start();
?>
<html>
<header>
<link rel="stylesheet" type="text/css" href="administrador/css/estilos.css" />
<title>ASM Desarrollo - G.O.T. Comunicaciones</title>
</header>
<body>
<div align="center" id="cabecera">
	<img src="administrador/img/logo.gif" alt="logo" width="300" height="85" align="left">
	<form name="frm_login" method="post" action="administrador/login.php">
	Usuario: <input type="text" size="10" name="user" /><br />
	Clave: <input type="password" size="10" name="pass" />
	<input type="submit" name="submit" value="Login" />
	</form>
</div>
</body>
</html>
<?php
if (isset($_GET['error'])) {
    echo '<p align="center"><b>Usuario o clave incorrecta</b></p>';
}
?>
