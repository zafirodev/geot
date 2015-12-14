<?php
clearstatcache();
include("header.php");
header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header("Cache-Control: post-check=0, pre-check=0", false);
header( "Pragma: no-cache" );
header('Content-type: text/html; charset=utf-8');
?>

<div id="submenu">
    <ul>
        <li><a href="#" id="aru">Rubros y Unidades de medida</a></li>
        <li><a href="#" id="as">Alta de Stock en BASE</a></li>
        <li><a href="#" id="acts">Actualizacion de stock en BASE</a></li>
        <li><a href="#" id="ase">Alta de stock Empleado</a></li>
        <li><a href="#" id="acte">Actualizacion de stock Empleado</a></li>
        <li><a href="#" id="tras">Traspasar stock entre Empleados</a></li>
    </ul>
</div>
<div id="altasru" style="display: none; padding-top: 80px;">
    <div id="frmaltarubro" class="formularios">
        <div id="verrubros" align="center">Ver RUBROS disponibles</div><br />
        <div id="listarubros" style="color:#FFF; display:none;"><?php
            clearstatcache();
            $db = new MySQL();
            $query="select * from rubro where Activo=1";
            $result =  $db->consulta($query);

            while($result2=$db->fetch_array($result)){
                echo '* '.$result2[1].'<br>';
            }?><br /></div>
        <div onLoad="if ('Navigator' == navigator.appName)document.forms[0].reset();">
            <form id="altarubro" class="altas" action="ajax/abmrubro.php" method="post" style="height:50px;">
                <p>Nuevo RUBRO:</p> <input type="text"  name="rdescripcion" /> <input type="submit" value="Guardar" /> <div id="ajax_loader"><img id="loader_gif" src="img/239.gif" style=" display:none;"/></div>
            </form>		<form  id="modrubro" class="altas" action="ajax/abmrubromod.php" method="post" style="height:50px;">
                <p>Modificar RUBRO: </p> <select name="rdescant" class="modifrubro" autocomplete="off">
                    <?php
                    clearstatcache();
                    $db = new MySQL();
                    $query="select * from rubro where Activo=1 order by Descripcion";
                    $result =  $db->consulta($query);

                    while($result2=$db->fetch_array($result)){
                        echo '<option value="'.$result2['Descripcion'].'">'.$result2['Descripcion'].'</option>';
                    }
                    ?></select>
                a: <input type="text"  name="rdescripcionm" />
                <input type="submit" value="Modificar" /> <div id="ajax_loader"><img id="loader_gif" src="img/loader.gif" style=" display:none;"/>						            </div></form>
        </div>
    </div>

    <div id="frmaltaunidad" class="formularios">

        <div id="verunidades" align="center">Ver UNIDADES disponibles</div><br />
        <div id="listaunidades" style="color:#FFF; display:none;"><?php
            $db = new MySQL();
            $query="select * from unidad where Activo=1";
            $result =  $db->consulta($query);

            while($result2=$db->fetch_array($result)){
                echo '* '.$result2[1].'<br>';
            }?><br /></div>
        <div>
            <form id="altaunidad" class="altas" action="ajax/abmunidad.php" method="post" style="height:50px;">
                <p>Nueva UNIDAD de medida:</p> <input type="text"  name="udescripcion" /> <input type="submit" value="Guardar" /> <div id="ajax_loader"><img id="loader_gif" src="img/loader.gif" style=" display:none;"/></div>
            </form>
            <form  id="modunidad" class="altas" action="ajax/abmunidadmod.php" method="post" style="height:50px;">
                <p>Modificar UNIDAD de medida: </p> <select name="udescant" class="modifrubro"><?php
                    $db = new MySQL();
                    $query="select * from unidad where Activo=1";
                    $result =  $db->consulta($query);

                    while($result2=$db->fetch_array($result)){
                        echo '<option value="'.$result2['Descripcion'].'">'.$result2['Descripcion'].'</option>';
                    }
                    ?></select>
                a: <input type="text" name="udescripcionm" />
                <input type="submit" value="Modificar" /> <div id="ajax_loader"><img id="loader_gif" src="img/loader.gif" style=" display:none;"/></div></form>

        </div>
    </div>
</div>
<div id="altasforms" style="display: none; padding-top: 80px;">
    <div id="frmaltaarticulo" class="formularios">
        <form  id="altaarticulo"  class="altas" action="ajax/abmarticulo.php" method="post">
            <h3 align="center">Nuevo Articulo</h3>
            <p>Descripcion:</p> <input type="text" id="descripcion" name="descripcion" />
            <p>Rubro:</p> <select name="rubro" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from rubro where Activo=1 order by Descripcion";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
                }
                ?>
            </select><br><br>
            <p>Cantidad:</p> <input type="text" name="cantidad" id="cantidad"/>
            <p>Unidad:</p> <select name="unidad" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from unidad where Activo=1";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['Descripcion'].'</option>';
                }
                ?>
            </select><br><br>
            <p>Nro.Serie:</p> <input type="text" name="serie" />
            <input type="button" value="Guardar" name="actualiza" onclick='if($("#descripcion").val()==""){alert("Debe ingresar una descripción para el artículo."); } if(parseInt($("#cantidad").val())>0){$("#altaarticulo").submit();} else {alert("Debe ingresar una cantidad para el artículo."); }'/>
        </form>
    </div>
</div>
<div id="actualizar" style="display: none; text-align: center; margin: 135px 0px 10px 25%;">
    <div id="frmactualizaarticulo" class="formularios" style="margin: 0; padding: 0;">
        <form  id="actualizaarticulo" class="altas" action="ajax/abmarticulo.php" method="post" style="height:180px;">
            <h3 align="center">Actualizar Stock</h3>
            <p>Articuls Disponibles:</p> <select name="articulo" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select stock.*,u.Descripcion tipounidad from stock inner join unidad as u on stock.UnidadID = u.ID where Activo=1";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['Cantidad']." ".$result2['tipounidad']." de ".$result2['Descripcion'].'</option>';
                }
                ?>
            </select><br><br>
            <p>Agregar:</p> <input type="text" name="cantidadactualiza" id="cantidadactualiza" />
            <input type="button" value="Actualizar" name="actualizagm" onclick=' if((parseInt($("#cantidadactualiza").val())>0)||(parseInt($("#cantidadactualiza").val())<0)){$("#actualizaarticulo").submit();} else {alert("Debe ingresar una cantidad para actualizar el stock.");}'/>
        </form>
    </div>
</div>
<div id="actualizarempleado" style="display: none;">
    <div id="frmactualizaarticulo" class="formularios">
        <form  id="actualizaarticuloe" class="altas" action="ajax/abmarticulo.php" method="post" style="height:210px;">
            <h2 align="center">Actualizar Stock de Empleado</h2>
            <p>Tecnico:</p> <select id="actstemp" name="tecnico" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from personal where PuestoID = 1 order by NombreApellido";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
                }
                ?>
            </select>
            <p>Disponible en Base:</p> <select id="actstempart" name="articulo" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select stock.*,u.Descripcion tipounidad from stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado on stock.ID=stockempleado.ArticuloID where Activo=1 and EmpleadoID=(select ID from personal where PuestoID=1 order by NombreApellido limit 1)";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['Cantidad']." ".$result2['tipounidad']." de ".$result2['Descripcion'].'</option>';
                }
                ?>
            </select><div id="stempart" style="color:#FFF"></div>
            <p>Agregar la Cantidad de:</p> <input type="text" id="cantidadactualizae" name="cantidadactualizae" />
            <input type="button" value="Actualizar" name="actempleado" onclick='if((parseInt($("#cantidadactualizae").val())>0)||(parseInt($("#cantidadactualizae").val())<0)){$("#actualizaarticuloe").submit();} else {alert("Debe ingresar una cantidad para actualizar el stock."); }'/>

        </form>
    </div>
</div>
<div id="altastockempleado" style="display: none;">
    <div id="frmactualizaarticulo" class="formularios">
        <form  id="altaarticuloe" class="altas" action="ajax/abmarticulo.php" method="post">
            <h2 align="center">Alta Stock de Empleado</h2>
            <p>Articulo:</p> <select name="articulo" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select stock.*,u.Descripcion tipounidad from stock inner join unidad as u on stock.UnidadID = u.ID where Activo=1";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['Cantidad']." ".$result2['tipounidad']." de ".$result2['Descripcion'].'</option>';
                }
                ?>
            </select>
            <p>Cantidad:</p> <input type="text" id="cantidade" name="cantidade"   /><br><br>
            <p>Técnico:</p> <select name="tecnico" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from personal where PuestoID = 1 order by NombreApellido";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
                }
                ?>
            </select>
            <input type="button" value="Actualizar" name="altastockempleado" onclick='if((parseInt($("#cantidade").val())>0)||(parseInt($("#cantidade").val())<0)){$("#altaarticuloe").submit();} else {alert("Debe ingresar una cantidad para actualizar el stock.");} '/>

        </form>
    </div>


</div>
<div id="traspasoemp" style="display: none;">
    <div id="frmtraspaso" class="formularios"
        <form id="traspasar" class="altas" action="ajax/abmarticulo.php" method="post" style="height:210px;">
            <h2 align="center">Traspasar stock entre Empleados</h2>
            <p>De Técnico:</p> <select id="traspstemp" name="traspstemp" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from personal where PuestoID = 1 order by NombreApellido";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
                }
                ?>
            </select>
            <p>A Técnico:</p> <select id="traspstemp2" name="traspstemp2" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select * from personal where PuestoID = 1 order by NombreApellido";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['NombreApellido'].'</option>';
                }
                ?>
            </select><br><br>
            <p>Articulo:</p> <select id="traspstempart" name="traspstempart" class="modifrubro">
                <?php
                $db = new MySQL();
                $query="select stock.*,u.Descripcion tipounidad, stockempleado.Cantidad cant from stock inner join unidad as u on stock.UnidadID = u.ID left join stockempleado on stock.ID=stockempleado.ArticuloID where Activo=1 and EmpleadoID=(select ID from personal where PuestoID=1 order by NombreApellido limit 1)";
                $result =  $db->consulta($query);

                while($result2=$db->fetch_array($result)){
                    echo '<option value="'.$result2['ID'].'">'.$result2['cant']." ".$result2['tipounidad']." de ".$result2['Descripcion'].'</option>';
                }
                ?>
            </select>
            <p>Cantidad:</p> <input type="text" id="cantidadtrasp" name="cantidadtrasp" />
            <input type="button" value="Traspasar" name="traspempleado" onclick='traspact=0; if(parseInt($("#cantidadtrasp").val())<1||$("#cantidadtrasp").val()==""){alert("Debe ingresar una cantidad para traspasar."); traspact=1;} if ($("#traspstemp").val()==$("#traspstemp2").val()){alert("Los tecnicos deben ser distintos."); traspact=1;}  if (traspact==0){$("#traspasar").submit();}
                                        '/> <br />

        </form>
    </div>
</div>

<div id="ajax_loader" style="margin-bottom:10px">
    <img id="loader_gif" src="img/loader.gif" style=" display:none;"/>
</div>
<script type="text/javascript">

    function pulsar(e) {
        tecla = (document.all) ? e.keyCode :e.which;
        return (tecla!=13);
    }

    // esperamos que el DOM cargue
    $(document).ready(function() {

        $("input:text").keypress(function(){
            return pulsar(event);});

        $("#stempart").load("ajax/stockempart.php?" + new Date().getTime() + "&EmpleadoID="+$("#actstemp").val()+"&ArticuloID="+$("#actstempart").val());


        $("#actstemp").change(function(){
            $("#actstempart").load("ajax/stockemp.php?" + new Date().getTime() + "&EmpleadoID="+$("#actstemp").val(), function(){
                $("#stempart").load("ajax/stockempart.php?" + new Date().getTime() + "&EmpleadoID="+$("#actstemp").val()+"&ArticuloID="+$("#actstempart").val());}); });

        $("#traspstemp").change(function(){
            $("#traspstempart").load("ajax/stockemptr.php?" + new Date().getTime() + "&EmpleadoID="+$("#traspstemp").val(), function(){
                $("#stempart").load("ajax/stockempart.php?" + new Date().getTime() + "&EmpleadoID="+$("#actstemp").val()+"&ArticuloID="+$("#actstempart").val());}); });

        $("#actstempart").change(function(){
            $("#stempart").load("ajax/stockempart.php?" + new Date().getTime() + "&EmpleadoID="+$("#actstemp").val()+"&ArticuloID="+$("#actstempart").val());   });


        $("#verrubros").click(function(event){
            event.preventDefault();
            $("#listarubros").toggle(600);
            if ($(this).html()=='Ver RUBROS disponibles')
            {$(this).html('Ocultar RUBROS disponibles');} else
            {$(this).html('Ver RUBROS disponibles');}
        });
        $("#verunidades").click(function(event){
            event.preventDefault();
            $("#listaunidades").toggle(600);
            if ($(this).html()=='Ver UNIDADES disponibles')
            {$(this).html('Ocultar UNIDADES disponibles');} else
            {$(this).html('Ver UNIDADES disponibles');}
        });
        $("#aru").click(function(event){
            event.preventDefault();
            $("#altasru").show(600);
            $("#altasforms").css("display", "none");
            $("#actualizar").css("display", "none");
            $("#traspasoemp").css("display", "none");
            $("#actualizarempleado").css("display", "none");
            $("#altastockempleado").css("display", "none");
        });
        $("#as").click(function(event){
            event.preventDefault();
            $("#altasforms").show(600);
            $("#altasru").css("display", "none");
            $("#actualizar").css("display", "none");
            $("#traspasoemp").css("display", "none");
            $("#actualizarempleado").css("display", "none");
            $("#altastockempleado").css("display", "none");
        });
        $("#acts").click(function(event){
            event.preventDefault();
            $("#actualizar").show(600);
            $("#altasru").css("display", "none");
            $("#altasforms").css("display", "none");
            $("#actualizarempleado").css("display", "none");
            $("#traspasoemp").css("display", "none");
            $("#altastockempleado").css("display", "none");
        });
        $("#acte").click(function(event){
            event.preventDefault();
            $("#altasru").css("display", "none");
            $("#actualizarempleado").show(600);
            $("#altasforms").css("display", "none");
            $("#actualizar").css("display", "none");
            $("#altastockempleado").css("display", "none");
            $("#traspasoemp").css("display", "none");
        });
        $("#ase").click(function(event){
            event.preventDefault();
            $("#altastockempleado").show(600);
            $("#altasru").css("display", "none");
            $("#altasforms").css("display", "none");
            $("#actualizar").css("display", "none");
            $("#traspasoemp").css("display", "none");
            $("#actualizarempleado").css("display", "none");
        });

        $("#tras").click(function(event){
            event.preventDefault();
            $("#traspasoemp").show(600);
            $("#altasru").css("display", "none");
            $("#altastockempleado").css("display", "none");
            $("#altasforms").css("display", "none");
            $("#actualizar").css("display", "none");
            $("#actualizarempleado").css("display", "none");
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
            alert(responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
            //location.reload();
            window.location.href=window.location.href + '?' + new Date().getTime();
            // $("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"

        };

    });

</script>
<?php
include("footer.php");
?>

