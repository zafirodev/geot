<?php
include("header.php");
$db = new MySQL();
$query = "SELECT stock.*,u.Descripcion AS unidades,r.Descripcion AS rubros FROM stock inner join unidad as u ON stock.UnidadID = u.ID INNER JOIN rubro AS r ON stock.RubroID = r.ID";		  
$result1 =  $db->consulta($query);
$Cant=$db->num_rows($result1);// obtenemos la cantidad de registros encontrados.

$query3 = "SELECT stockempleado.*,
				p.NombreApellido as nombre,
				s.Descripcion as articulo,
				s.NroSerie as serie,
				r.Descripcion AS rubros,
				u.Descripcion AS unidades 		 
			FROM stockempleado 
				inner join stock as s 
					on stockempleado.ArticuloID = s.ID 
				inner join personal as p 
					on stockempleado.EmpleadoID = p.ID 
				inner join unidad as 
					u ON s.UnidadID = u.ID 
				INNER JOIN rubro AS r 
					ON s.RubroID = r.ID 
			ORDER BY p.NombreApellido,s.Descripcion";		  
$result3 =  $db->consulta($query3);
$Cant3=$db->num_rows($result3);// stock por empleado

$query4 = "SELECT sum(stockempleado.Cantidad) as cant,
				stockempleado.ArticuloID,
				s.Descripcion as articulo,
				s.NroSerie as serie,
				r.Descripcion AS rubros,
				u.Descripcion AS unidades, p.NombreApellido AS empleado 		 
			FROM stockempleado 
				inner join stock as s 
					on stockempleado.ArticuloID = s.ID 
				inner join unidad as 
					u ON s.UnidadID = u.ID 
				INNER JOIN rubro AS r 
					ON s.RubroID = r.ID 
				inner join personal AS p
					ON p.ID=stockempleado.EmpleadoID
			group BY stockempleado.ArticuloID 
			ORDER BY p.NombreApellido,s.Descripcion";		  
$result5 =  $db->consulta($query4);
$Cant5=$db->num_rows($result5);// stock en calle.

?>
<div id="submenu">
<ul>
<li><a href="#" id="lg">Listar Stock en BASE</a></li>
<li><a href="#" id="le">Listar Stock por Empleado</a></li>
<li><a href="#" id="lc">Listar Stock en Calle</a></li>
</ul>
</div>
<div id="general" style="display: none;">
	<p align="center">Se encontraron <?php echo $Cant; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
	<table border="2" align="center">
	<thead>
		<tr>
			<th style="display:none">ID Articulo</th>
			<th><select id="descstockg" class="filtrog"><option value="0">Descripción</option><?php
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Numero de Serie</th>
			<th><select id="rubstockg" class="filtrog"><option value="0">Rubro</option><?php
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
			<th>Fecha de Modificacion</th>
		</tr>
	</thead>	
		<?php 
		while ($result2 = $db->fetch_array($result1)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
		$html = $html.'<td style="display:none;">'.$result2['ID'].'</td>';
		$html = $html.'<td>'.$result2['Descripcion'].'</td>';
		$html = $html.'<td>'.$result2['NroSerie'].'</td>';
		$html = $html.'<td>'.$result2['rubros'].'</td>';
		$html = $html.'<td>'.$result2['Cantidad'].'</td>';
		$html = $html.'<td>'.$result2['unidades'].'</td>';
		$html = $html.'<td>'.afecha($result2['FechaModif']).'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>
</div>
<div id="empleado" style="display: none;">
	<p align="center">Se encontraron <?php echo $Cant; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
   
	<table border="2" align="center">
		<thead>
		<tr>
			<th> <select id="empstock" class="filtro"><option value="0">Empleado</option><?php
		$db = new MySQL();
		$query="select ID,NombreApellido from personal where PuestoID = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
		}
		?>
										</select>	</th>
			<th style="display:none;">ID Articulo</th>
			<th><select id="descstock" class="filtro"><option value="0">Descripcion</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Numero de Serie</th>
			<th><select id="rubstock" class="filtro"><option value="0">Rubro</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
			<th>Fecha de Modificacion</th>
		</tr>
		</thead>
		<?php 
		while ($result4 = $db->fetch_array($result3)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
		$html = $html.'<td>'.$result4['nombre'].'</td>';
		$html = $html.'<td style="display:none;">'.$result4['ArticuloID'].'</td>';
		$html = $html.'<td>'.$result4['articulo'].'</td>';
		$html = $html.'<td>'.$result4['serie'].'</td>';
		$html = $html.'<td>'.$result4['rubros'].'</td>';
		$html = $html.'<td>'.$result4['Cantidad'].'</td>';
		$html = $html.'<td>'.$result4['unidades'].'</td>';
		$html = $html.'<td>'.afecha($result4['FechaModifica']).'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>
</div>
<div id="calle" style="display: none;">
	<p align="center">Se encontraron <?php echo $Cant5; ?> Registros<br><a onClick='imprimir();' href='#'><img src="img/print.jpg"></a></p>
	<br>
	<table border="2" align="center">
		<thead>
		<tr>
        	
		<th> <select id="empstockc" class="filtroc"><option value="0">Empleado</option><?php
		$db = new MySQL();
		$query="select ID,NombreApellido from personal where PuestoID = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
		}
		?>
										</select>	</th> 
<th style="display:none;">ID Articulo</th>
			<th><select id="descstockc" class="filtroc"><option value="0">Descripcion</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from stock";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Numero de Serie</th>
			<th><select id="rubstockc" class="filtroc"><option value="0">Rubro</option><?php
		$db = new MySQL();
		$query="select ID,Descripcion from rubro where Activo = 1 ";
		$result =  $db->consulta($query);
		while($result2=$db->fetch_array($result)){
			echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
		}
		?>
										</select></th>
			<th>Cantidad</th>
			<th>Unidad</th>
		</tr>
		</thead>
		
<?php 
		while ($result6 = $db->fetch_array($result5)){// listamos de primero a ultimo
		$html = '<tr class="odd">';
	$html=$html.'<tr> <td>'.$result6['empleado'].'</td>';
		$html = $html.'<td>'.$result6['articulo'].'</td>';
		$html = $html.'<td>'.$result6['serie'].'</td>';
		$html = $html.'<td>'.$result6['rubros'].'</td>';
		$html = $html.'<td>'.$result6['cant'].'</td>';
		$html = $html.'<td>'.$result6['unidades'].'</td>';
		$html = $html.'</tr>';	
		echo $html;
		}
		?>
	</table>
</div>


<script type="text/javascript">
// esperamos que el DOM cargue
$(document).ready(function() {
	    $("#lg").click(function(event){
    event.preventDefault();
    $("#general").show(600);
	$("#empleado").css("display", "none");
	$("#calle").css("display", "none");
	});
	    $("#le").click(function(event){
    event.preventDefault();
    $("#empleado").show(600);
	$("#general").css("display", "none");
	$("#calle").css("display", "none");
	});
		$("#lc").click(function(event){
    event.preventDefault();
    $("#calle").show(600);
	$("#general").css("display", "none");
	$("#empleado").css("display", "none");
	});

	$("select.filtro").change(function(){
		$("#empleado").load("ajax/listastockemp.php?" + new Date().getTime() + "&EmpleadoID="+$("#empstock").val()+"&Rubro="+$("#rubstock").val()+"&Desc="+$("#descstock").val());
								   });
	
	$("select.filtroc").change(function(){
		$("#calle").load("ajax/listastockcalle.php?" + new Date().getTime() + "&EmpleadoID="+$("#empstockc").val()+"&Rubro="+$("#rubstockc").val()+"&Desc="+$("#descstockc").val());
								   });
	$("select.filtrog").change(function(){
		$("#general").load("ajax/listastockgen.php?" + new Date().getTime() + "&Rubro="+$("#rubstockg").val()+"&Desc="+$("#descstockg").val());
								   });
		
});

</script>
<?php
include("footer.php");
?>
