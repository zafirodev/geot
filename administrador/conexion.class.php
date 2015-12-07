<?php  
 class MySQL{  
	private $conexion;  
	private $total_consultas;  
	public function MySQL(){  
	   if(!isset($this->conexion)){  
		   $this->conexion = (mysql_connect("localhost","bs000352_admin","Aasm1234")) or die(mysql_error());  
		   mysql_select_db("geotdb",$this->conexion) or die(mysql_error());  
	   }  
    }  
	public function consulta($query){  
	   $this->total_consultas++;  
	   $resultado = mysql_query($query,$this->conexion); 
		   if(!$resultado){  
		   echo 'MySQL Error: ' . mysql_error();  
		   exit;  
		}  
		return $resultado;   
    }  
	public function fetch_array($consulta){   
		return mysql_fetch_array($consulta);  
    }  
	public function num_rows($consulta){   
		return mysql_num_rows($consulta);  
    }  
public function getTotalConsultas(){  
		return $this->total_consultas;  
    }  
 }
?>
