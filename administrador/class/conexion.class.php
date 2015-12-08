<?php  
 class MySQL{  
	private $conexion;  
	private $total_consultas;  
	public function MySQL(){
	   if(!isset($this->conexion)){ 
				$usuario='root';
				$pass='27860266';
		   $this->conexion = (mysqli_connect("localhost",$usuario,$pass,"geotdb"));
           if (mysqli_connect_errno())
           {
               echo "Failed to connect to MySQL: " . mysqli_connect_error();
           }
	   }
    }
	public function consulta($query){
        //die($query);
	   $this->total_consultas++;
	   $resultado = mysqli_query($this->conexion,$query);
		return $resultado;   
    }  
	public function fetch_array($consulta){   
		return mysqli_fetch_array($consulta);
    }  
	public function num_rows($consulta){   
		return mysqli_num_rows($consulta);
    }  
	public function getTotalConsultas(){
		return $this->total_consultas;  
    }
 }
?>

