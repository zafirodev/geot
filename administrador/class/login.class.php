<?php
session_start();
include_once("class/conexion.class.php" );
class login {
// Inicia sesion

public function inicia($tiempo=3600, $usuario=NULL, $clave=NULL) { 
    if ($usuario==NULL && $clave==NULL) {
        // Verifica sesion
        if (isset($_SESSION['idusuario'])) {
            //echo "Estas logeado";
			
        } else {
            // Verifica cookie
            if (isset($_COOKIE['idusuario'])) {
                // Restaura sesion
                $_SESSION['idusuario']=$_COOKIE['idusuario'];
				//$_SESSION['pass']=$_COOKIE['pass'];
				echo '<script language="JavaScript">window.location="../index.php?cerrar=1"</script>';
            } else {
                // Si no hay sesion regresa al login
		echo '<script language="JavaScript">window.location="../index.php?cerrar=1"</script>';
                //header( "Location: ../index.php" );
            }
        }
    } else { 
        $this->verifica_usuario($tiempo, $usuario, $clave);
    }
}  
//  Verifica login
private function verifica_usuario($tiempo, $usuario, $clave) {
  
        // Si la clave es correcta
        //$idusuario=$this->codificar_usuario($usuario);
		$db = new MySQL();
		$query = "SELECT ID FROM usuario where Usuario='$usuario' and Pass=MD5('$clave')";		  
		$result =  $db->consulta($query);
		if ($db->num_rows($result)>0){
		setcookie("idusuario", $usuario, time()+$tiempo);		
        setcookie("pass", $clave, time()+$tiempo);		
        $_SESSION['idusuario']=$usuario;
		$_SESSION['pass']=$clave;
	echo '<script language="JavaScript">window.location="listastock.php"</script>';}
	else
	{
		echo '<script language="JavaScript">window.location="../index.php?error=1"</script>';}
	
//        header( "Location: listastock.php" );
   
}
// Codifica idusuario
private function codificar_usuario($usuario) {
    return md5($usuario);
}
}
?>
