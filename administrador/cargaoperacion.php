<?php
include('header.php');
if (isset($_GET['mod'])&&($_GET['mod']==1)){
$OtID=$_GET['OtID'];
$mod=1;} else {$mod=0;}
$db = new MySQL();
if ($mod==1)
{
$query="select * from ot where id=$OtID";
$resultOt =  $db->consulta($query);
while($resultOt2=$db->fetch_array($resultOt)){
$clienteID=$resultOt2['ClientesID'];
$visitaID=$resultOt2['NumeroVisita'];
$empresaID=$resultOt2['Servicio_EmpresaID'];
$FechaEmision=$resultOt2['FechaEmision'];
$FechaInstalacion=$resultOt2['FechaInstalacion'];
$comentarios=$resultOt2['Comentarios'];
$tecnico=$resultOt2['PersonalID'];
$estado=$resultOt2['EstadoID'];
}}
?>
<div id="frmaltaot" class="formularios" style="margin: 30px auto 0px; width: 900px; text-align: center; border: 0px none;">
		<form  id="altaot" class="altas" action="ajax/abmot.php" method="post" style="height:180px;">
			<h2 align="center"><?php if ($mod==1){echo "Editar OT";} else {echo "Nueva OT";}?></h2>
	<div id="datosot">		
			<p>Nro. de Cliente:</p> <input type="text" id="idcliente" name="idcliente" maxlength="8" <?php if ($mod==1){echo "value='$clienteID'";}?>/>
			<p>Nro. de Visita:</p> <input type="text" name="visita" id="visita"/ maxlength="8"  <?php if ($mod==1){echo "value='$visitaID'";}?>><br><br>
			<p>Empresa:</p> <select name="empresa" class="modifrubro">
										<?php
										$query="select * from empresas ";
										$result =  $db->consulta($query);
										if ($mod==1){
										while($result2=$db->fetch_array($result)){
											if ($result2['ID']==$empresaID){$empsel="selected";} else {$empsel="";}
											echo '<option value="'.$result2['ID'].'" '.$empsel.'>'.$result2['Descripcion'].'</option>';
										}}
										else {
										while($result2=$db->fetch_array($result)){
											
											echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
										}
										}
										?>
									</select>
			<p>Fecha de Emisión:</p> <input type="text"  readonly="readonly" id="FechaEmision" name="FechaEmision" class="fechadate" <?php if ($mod==1) {echo "value='$FechaEmision'";} else {echo "value='".date("Y-m-d")."'";}?>/><br><br>
			<p>Fecha de Instalación:</p> <input type="text"  readonly="readonly" id="FechaInstalacion" name="FechaInstalacion" class="fechadate"  <?php if ($mod==1) {if ($tecnico!=0){echo "value='$FechaInstalacion'";}}?> />
			<p>Comentarios:</p> <input type="text" name="comentarios"  <?php if ($mod==1) echo "value='$comentarios'";?>/><br><br>
			<p>Técnico:</p> <select <?php if ($mod==1 && $tecnico!=0) echo "disabled";?> id="tecnico" name="tecnico" class="modifrubro">
										<option value="0" selected="selected">Sin asignar</option>
										<?php
										$db = new MySQL();
										$query="select * from personal where PuestoID = 1 order by NombreApellido";
										$result =  $db->consulta($query);
										if ($mod==1){
											
										while($result2=$db->fetch_array($result)){
											if ($result2['ID']==$tecnico){$empsel="selected";} else {$empsel="";}
											echo '<option value="'.$result2['ID'].'" '.$empsel.'>'.$result2['NombreApellido'].'</option>';
										}} else
										{
										while($result2=$db->fetch_array($result)){
											echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
										}	
											
											
											
										}
										?>
									</select>
			<p>Estado de la OT:</p> <select name="estadoot" class="modifrubro">
										<?php
										$db = new MySQL();
										$query="select * from estados ";
										$result =  $db->consulta($query);
										if ($mod==1){
										while($result2=$db->fetch_array($result)){
											if ($result2['ID']==$estado){$empsel="selected";} else {$empsel="";}
											echo '<option value="'.$result2['ID'].'" '.$empsel.'>'.$result2['Descripcion'].'</option>';
										}}
										else {
										while($result2=$db->fetch_array($result)){
											echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
										}}	?>
									</select><br><br>
			<p><a href="#" id="mat" class="btn btn-primarya"><b> <?php if ($mod==1){echo "Lista de";} else {echo "Cargar";}?> Materiales </b></a></p>
	</div>
	<div id="materiales" style="display:none;">
		<p><a href="#" id="ot" class="btn btn-primarya"><b>Ocultar lista de materiales<br></b></a></p><br>
				<?php $nodispone="'El empleado no dispone de esa cantidad.'";
				if ($mod==1){
					//$db = new MySQL();
					$query="select stock.*,u.Descripcion tipounidad,o.Cantidad stockemp from stock inner join unidad as u on stock.UnidadID = u.ID inner join stockempleado as o on stock.ID = o.ArticuloID where Activo=1 and o.EmpleadoID=$tecnico";
					$result =  $db->consulta($query);

					while($result2=$db->fetch_array($result)){
						$query="select Cantidad from gasto_ot where OtID=$OtID and ArticuloID=".$result2['ID'];
						$resultm =  $db->consulta($query);
						if (mysqli_num_rows($resultm) > 0){
							while($resultm2=$db->fetch_array($resultm)){
								$cantidad=$resultm2['Cantidad'];
								$query="select sum(Cantidad) as cant from gasto_ot where OtID=$OtID and ArticuloID=".$result2['ID'];
								$cantidado=$db->consulta($query);
								$cantidado=$db->fetch_array($cantidado);
								$cantidado=$cantidado[0];
							}
						}else {
							$cantidad=""; $cantidado="0";
						}
							echo '<p>'.$result2['Descripcion'].':  </p><input type="text" value="" onblur="if (this.value>'.$result2['Cantidad'].'+'.$result2['stockemp'].') {alert('.$nodispone.'); this.focus(); die;}" name="'.$result2['ID'].'">  '.$result2['tipounidad'].' - Asignados: '.$cantidado.' - '.$result2['stockemp'].' disponibles.<br>';
					}
				}
				else
				{
					echo 'Debe dar de alta la OT y luego pasarla a cumplida para asignar materiales.';
				}
				?>
		
		
		
		<br>

		
	</div>
			<br>
 <input type="button" value="Guardar" onclick='valiform=0; if ($("#idcliente").val()==""||$("#idcliente").val()=="0") {alert ("Debe ingresar el Nro. de Cliente."); valiform=1;} else{ if ($("#visita").val()==""||$("#visita").val()=="0") {alert ("Debe ingresar el Nro. de Visita.");valiform=1;} else {if ($("#FechaEmision").val()=="") {alert ("Debe ingresar la Fecha de Emisión.");valiform=1;  } else {if (($("#FechaInstalacion").val()=="")&&($("#tecnico").val()!=0)) {alert ("Debe ingresar la Fecha de Instalación cuando la OT tiene un técnico asignado.");valiform=1;}}}} if (valiform==0){$("#tecnico").removeAttr("disabled");$("#altaot").submit();}' />
        

    <input type="hidden" name="mod" value="<?php if ($mod==1) echo '1';?>" />
    <input type="hidden" name="OtID" value="<?php if ($mod==1) echo $OtID;?>" />
       
		</form>
</div>
<div id="ajax_loader" style="margin-bottom:10px">
	<img id="loader_gif" src="img/239.gif" style=" display:none;"/>
</div>
<script>
$(document).ready(function(){
	$('.fechadate').datepick({
		 dateFormat: 'yy-mm-dd' 
	});
});
</script>
<script type="text/javascript">

function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 

// esperamos que el DOM cargue
$(document).ready(function() {
						   
		$("input:text").keypress(function(){
				return pulsar(event);});						   
						   
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

		$("#tecnico").change(function(event){ 
    event.preventDefault();
    $("#materiales").load("ajax/materialot.php?" + new Date().getTime() + "&empleado="+$("#tecnico").val(), function(){
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
	  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
<?php if ($mod==1){?>	if (responseText.substring(0,1)=="@") {
		alert(responseText.substring(1,responseText.length));
		location.href="listaoperacion.php";}
		else
		{alert(responseText); location.reload();} <?php } else { ?> alert(responseText); location.reload(); <?php } ?>
	 // $("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
	 };
});

</script>
</body>
</html>
