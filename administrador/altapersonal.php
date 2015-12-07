<?php
include("header.php");
?>
<div id="frmaltapersonal" class="formularios" >
		<form  id="altaot" class="altas" action="ajax/abmpersonal.php" method="post" style="height:180px;">
			<div id="ajax_loader" style=" position:fixed; margin-top: -32px;">
	<img id="loader_gif" src="img/239.gif" style="display:none; margin-bottom:-420px; "/></div>
            <h2 align="center">Alta Personal</h2>
			<label>Apellido y Nombre:</label> <input type="text" id="nombreapellido" name="nombreapellido" /><br>
            <label>Puesto:</label> <select name="puesto">
										<?php
										$db = new MySQL();
										$query="select * from puesto";
										$result =  $db->consulta($query);
										while($result2=$db->fetch_array($result)){
											echo '<option value="'.$result2[ID].'">'.utf8_encode($result2[Descripcion]).'</option>';
										}
										?>
									</select><br>
			<label>CUIT/CUIL:</label> <input type="text" id="cuilcuit" name="cuilcuit" />(Solo números sin guiones o barras)<br>
			<label>Dirección:</label> <input type="text" id="direccion" name="direccion" /><br>
			<label>Telefono:</label> <input type="text" id="telefono" name="telefono" />(Solo números sin guiones o barras)<br>
			<label>Cel:</label> <input type="text" id="celular" name="celular" />(Solo números sin guiones o barras)<br>
            <label>Provincia:</label> <select id="prov" name="prov">
										<?php
										$db = new MySQL();
										$query="select * from provincias order by nombre";
										$result =  $db->consulta($query);
										echo '<option value="0">Provincia</option>';
										while($result2=$db->fetch_array($result)){
											echo '<option value="'.$result2[id].'">'.utf8_encode($result2[nombre]).'</option>';
										}
										?>
									</select><br>
<div id="dept" style="display:none;">	<label>Departamento:</label> <select id="depto" name="depto">
										
									</select><br>        </div>                          

<div id="local" style="display:none">	<label>Localidad:</label> <select id="localidad" name="localidad">						
									</select><br> </div>
			<label>Fecha de Alta:</label> <input type="text" name="falta" value="<?php  echo date("d/m/Y"); ?>" readonly="readonly" /><br>
			<input type="hidden" name="fbaja" />

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
		$("#coment").html(responseText.substring(2,responseText.length)); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
		$("#nombreapellido").val("");
		$("#cuilcuit").val("");
		$("#direccion").val("");
		$("#telefono").val("");
		$("#celular").val("");
		$("#prov").val(0);
		$("#depto").val(0);
		$("#dept").hide();
		$("#localidad").val(0);
		$("#local").hide();

		
		
	// que borre al ingresar dato con exito
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
<?php
include("footer.php");
?>
