<?php
include("header.php");
$db = new MySQL();
$query="select * from personal where ID=".$_GET['ID'];
$resulto =  $db->consulta($query);
while($result=$db->fetch_array($resulto)){

?>
<div id="frmaltapersonal" class="formularios" >
		<form  id="altaot" class="altas" action="ajax/abmpersonalmod.php" method="post" style="height:180px;">
			<div id="ajax_loader" style=" position:fixed; margin-top: -32px;">
	<img id="loader_gif" src="img/239.gif" style="display:none; margin-bottom:-420px; "/></div>
            <h2 align="center">Editar Personal</h2>
			<label>Apellido y Nombre:</label> <input type="text" id="nombreapellido" name="nombreapellido" value="<?php echo $result['NombreApellido'];?>"/><br>
            <label>Puesto:</label> <select name="puesto">
										<?php
									
										$query="select * from puesto";
										$resulti =  $db->consulta($query);
										while($result2=$db->fetch_array($resulti)){
											if ($result['PuestoID']==$result2['ID']){$selp="selected";} else {$selp="";}
											echo '<option value="'.$result2['ID'].'" '.$selp.'>'.utf8_encode($result2['Descripcion']).'</option>';
										}
										?>
									</select><br>
			<label>CUIT/CUIL:</label> <input type="text" id="cuilcuit" name="cuilcuit" value="<?php echo $result['CuilCuit'];?>"/>(Solo números sin guiones o barras)<br>
			<label>Dirección:</label> <input type="text" id="direccion" name="direccion" value="<?php echo $result['Direccion'];?>" /><br>
			<label>Telefono:</label> <input type="text" id="telefono" name="telefono" value="<?php echo $result['Telefono'];?>" />(Solo números sin guiones o barras)<br>
			<label>Cel:</label> <input type="text" id="celular" name="celular" value="<?php echo $result['Cel'];?>"/>(Solo números sin guiones o barras)<br>
            <label>Provincia:</label> <select id="prov" name="prov">
										<?php
										
										$query="select * from provincias order by nombre";
										$resultp =  $db->consulta($query);
										echo '<option value="0">Provincia</option>';
										while($result2=$db->fetch_array($resultp)){
											echo $result['ProvinciaID']."DD".$result2['id']."S";
												if ($result['ProvinciaID']==$result2['id']){$provs="selected";} else {$provs="";}
											echo '<option value="'.$result2['id'].'" '.$provs.' >'.utf8_encode($result2['nombre']).'</option>';
										}
										?>
									</select><br>
<div id="dept" style="">	<label>Departamento:</label> <select id="depto" name="depto">
										<?php 	
										$query='select * from departamentos where provincia_id='.$result['ProvinciaID'].' order by nombre';
										$resultd =  $db->consulta($query);
										echo '<option value="0">Departamento</option>';
										while($result2=$db->fetch_array($resultd)){
											if ($result['DepartamentoID']==$result2['id']){$depts="selected";} else {$depts="";}
											echo '<option value="'.$result2[id].'" '.$depts.' >'.utf8_encode($result2[nombre]).'</option>';
										}?>
									</select><br>        </div>                          

<div id="local" style="">	<label>Localidad:</label> <select id="localidad" name="localidad">						
										<?php 	
										$query='select * from localidades where departamento_id='.$result['DepartamentoID'].' order by nombre';
										$resultl =  $db->consulta($query);
										echo '<option value="0">Localidad</option>';
										while($result2=$db->fetch_array($resultl)){
											if ($result['LocalidadID']==$result2['id']){$locals="selected";} else {$locals="";}
											echo '<option value="'.$result2[id].'" '.$locals.' >'.utf8_encode($result2[nombre]).'</option>';
										}?>
									</select><br> </div>
			<label>Fecha de Alta:</label> <input type="text" name="falta" value="<?php echo afecha($result['FechaAlta']); ?>" readonly="readonly" /><br>
			<input type="hidden" name="fbaja" />
            <input type="hidden" name="ID" value="<?php echo $_GET['ID'];?>"/>

			<input type="submit" value="Guardar"  style="float:left"/> <div id="coment" style=" float:left; margin-top:2px; margin-left:10px; color:#FF9"></div>
		</form>
</div>

<br /><br /><br /><br /><br />

<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
	// definimos las opciones del plugin AJAX FORM
	var opciones= {
	   beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
	   success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
	};
	 //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
	$('.altas').ajaxForm(opciones) ;

	 //lugar donde defino las funciones que utilizo dentro de "opciones"
	 function mostrarLoader(){
	  $('#loader_gif').fadeIn("slow");
	 };
	 function mostrarRespuesta (responseText){
	  $("#loader_gif").fadeOut("slow"); // Hago desaparecer el loader de ajax
	  // alert(responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
		if (responseText.substring(1,2)=="@") {
		location.href='listapersonal.php';		
		}	
		else
		{$("#coment").html(responseText);}
	 };
	$('#prov').change(function(){
		$('#dept').hide(100);
		$('#local').hide(100);
		$('#depto').load('ajax/deptos.php?prov='+$('#prov').val());		
		$('#dept').show(400);});
	$('#depto').change(function(){
		$('#local').hide(100);
		$('#localidad').load('ajax/localidades.php?depto='+$('#depto').val());		
		$('#local').show(400);});


});

</script>
<?php }
include("footer.php");
?>
