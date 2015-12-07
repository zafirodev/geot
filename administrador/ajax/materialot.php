<?php
session_start();
include_once("../class/conexion.class.php" );
$empleado=$_GET['empleado'];
if ($empleado!=0){
$nodispone="'El empleado no dispone de esa cantidad.'";
?>
<p><a href="#" id="ot"><b>-- Ocultar lista de materiales >> --</b></a></p>
				<?php
				$db = new MySQL();
				$query="select stock.*,u.Descripcion tipounidad,o.Cantidad stockemp FROM stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado as o on stock.ID = o.ArticuloID where Activo=1 and o.EmpleadoID=".$empleado;
				$result =  $db->consulta($query);
				
				while($result2=$db->fetch_array($result)){
					echo '<label>'.$result2['Descripcion'].':</label><input type="text" onblur="if (this.value>'.$result2['Cantidad'].') {alert('.$nodispone.'); this.focus(); die;}" name="'.$result2['ID'].'">'.$result2['tipounidad'].' - '.$result2['stockemp'].' disponibles.<br>';
				}
				?>
		
		
		
		<br>

<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
						   
		$("#mat").click(function(event){
	    event.preventDefault();
	$("#mat").hide();							 
    $("#materiales").show(200);
	});
		$("#ot").click(function(event){
    event.preventDefault();
    $("#materiales").hide(0);
	$("#mat").show(0);							 
	
	});
		
						   });
});

</script>
<?php } ?>