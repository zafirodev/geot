<?php
include("class/login.class.php");
$login=new login();
$login->inicia(3600, $_POST['user'], $_POST['pass']);
?>
