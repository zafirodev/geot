<?php
require_once 'Excel/reader.php';
include("header.php");
//var_dump($_POST); 
//die();
if($_POST){
//tomo el valor de un elemento de tipo texto del formulario
//$cadenatexto = $_POST["cadenatexto"];
//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>";
//datos del arhivo
$nombre_archivo = $_FILES['userfile']['name'];
$destino="gm.xls"; 
$tipo_archivo = $_FILES['userfile']['type'];
//die($HTTP_POST_FILES['userfile']['type']);
$tamano_archivo = $_FILES['userfile']['size'];
//compruebo si las características del archivo son las que deseo 
//echo $tipo_archivo;
//die();
	if ($tipo_archivo != "application/vnd.ms-excel"){
		echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos XLS<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
	}else{
		if (copy($_FILES['userfile']['tmp_name'],$destino)){
		   echo "El archivo ha sido cargado correctamente.";
		}else{
		   echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		}
	}
}else{
	die("No hay Archivos Cargados");
}



// Test CVS
//die("entre");
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/
//$data->read($_POST['']);
$data->read('gm.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL ^ E_NOTICE);

///////for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	//for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
//	for ($j = 1; $j <= 3; $j++) {
////////		echo "\"".$data->sheets[0]['cells'][$i][3]."\",";
//	}
/////////	echo "\n";

/////////}
// esto es para ver la dir exacta///////////echo "<br><br><br><br>".$data->sheets[0]['cells'][3][3]."<br>";
//print_r($data);
//print_r($data->formatRecords);
?>
<!-- ++Begin Map Search Control Wizard Generated Code++ -->
  <!--
  // Created with a Google AJAX Search Wizard
  // http://code.google.com/apis/ajaxsearch/wizards.html
  -->

  <!--
  // The Following div element will end up holding the map search control.
  // You can place this anywhere on your page
  -->


  <!-- Maps Api, Ajax Search Api and Stylesheet
  // Note: If you are already using the Maps API then do not include it again
  //       If you are already using the AJAX Search API, then do not include it
  //       or its stylesheet again
  //
  // The Key Embedded in the following script tags is designed to work with
  // the following site:
  // http://www.gmcomunicaciones.com
  -->
  <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAASvDE0QpBvBhK6m8KAQTFRRS72yV0ZR0YeBuqhNeIbRqq1BUtHxQ9H-8ncVjlyFt38jaIPKTwvuiqYg" type="text/javascript"></script>
  <script src="http://www.google.com/uds/api?file=uds.js&v=1.0&source=uds-msw&key=ABQIAAAASvDE0QpBvBhK6m8KAQTFRRS72yV0ZR0YeBuqhNeIbRqq1BUtHxQ9H-8ncVjlyFt38jaIPKTwvuiqYg" type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/css/gsearch.css");
  </style>

  <!-- Map Search Control and Stylesheet -->
  <script type="text/javascript">
    window._uds_msw_donotrepair = true;
  </script>
  <script src="http://www.google.com/uds/solutions/mapsearch/gsmapsearch.js?mode=new" type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/solutions/mapsearch/gsmapsearch.css");
  </style>
    <style type="text/css">
    .gsmsc-mapDiv {
      height : 400px;
    }

    .gsmsc-idleMapDiv {
      height : 400px;
    }

    .mapsearch {
      width : 600px;
      padding: 4px;
      margin:0 auto 0 auto;
    }
  </style>
<!-- aca va el div -->
<?php  for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) { ?>
  <script type="text/javascript">
    function LoadMapSearchControl() {

      var options = {
            zoomControl : GSmapSearchControl.ZOOM_CONTROL_ENABLE_ALL,
            title : "Googleplex",
            url : "http://www.google.com/corporate/index.html",
            idleMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM,
            activeMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM
            }

      new GSmapSearchControl(
            document.getElementById("mapsearch<?php echo $i;?>"),
            "<?php echo $data->sheets[0]['cells'][$i][3];?>,buenos aires,argentina",
            options
            );

    }
    // arrange for this function to be called during body.onload
    // event processing             "<?php=$data->sheets[0]['cells'][$i][3]?>,buenos aires,argentina",
    GSearch.setOnLoadCallback(LoadMapSearchControl);
  </script>
 
<!-- ++End Map Search Control Wizard Generated Code++ -->

<!--<div id="map2" style="width: 500px; height: 300px"></div> -->
  <?php echo "<h3>Direccion: ".$data->sheets[0]['cells'][$i][3]."<br>Visita Tecnica Nro. : ".$data->sheets[0]['cells'][$i][1]."<br>Cliente Nro. : ".$data->sheets[0]['cells'][$i][2]."</h3>";?>
  <div class="mapsearch" id="mapsearch<?php echo $i;?>" >

    <span style="color:#676767;font-size:11px;margin:10px;padding:4px;">Loading...</span>
  </div>
<?php  } ?>

<?php
include("footer.php");
?>
