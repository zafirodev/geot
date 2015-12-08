<?php
include("header.php");
?>
<br><br><br><br><br>
<div id="consummateria">
<h1>Consumo de materiales</h1>
	<div align="center"><p><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p></div>
<div class="formularios">
		<img id="loader_gif" src="img/239.gif" style="display:none; position:absolute; margin-top:-80px;"/>
	<form  class="consumo" action="ajax/consumomateriales.php" method="post" style="height:180px;">
	<div style="float:left;"><label>Desde:  </label> <input readonly="readonly" type="text" id="Fecha" name="Fecha" class="fechadate" /></div><div style="float:left;"> <label>Hasta:  </label> <input readonly="readonly" type="text" id="Fecha2" name="Fecha2" class="fechadate" /></div>
	<input type="submit" value="ver" />
	</form><br>
</div><div id="ajax_loader" style="margin-top:-200px">
	
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.fechadate').datepick({
		 dateFormat: 'yy-mm-dd' 
	});
});

</script>

<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
		
	// definimos las opciones del plugin AJAX FORM
	var opciones= {
	   beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
	   success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
	};
	 //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
	$('.consumo').ajaxForm(opciones) ;

	 //lugar donde defino las funciones que utilizo dentro de "opciones"
	 function mostrarLoader(){
	  $('#loader_gif').fadeIn("slow");
	 };
	 function mostrarRespuesta (responseText){
	  $("#loader_gif").fadeOut("slow"); // Hago desaparecer el loader de ajax
		//alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
		//location.reload();
	  $("#ajax_loader").html(responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
	 };
});
</script>
</div>
<?php
include("footer.php");
?>
