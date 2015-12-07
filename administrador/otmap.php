<?php
include("header.php");
?>
<div class="formularios">
<form action="verotmaps.php" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="MAX_FILE_SIZE" value="100000">
    <br>
    <br>
    <b>Cargar Órdenes Tecnicas: </b>
    <br>
    <input name="userfile" type="file">
    <br>
    <input type="submit" value="Cargar">
</form> 
</div>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAASvDE0QpBvBhK6m8KAQTFRRS72yV0ZR0YeBuqhNeIbRqq1BUtHxQ9H-8ncVjlyFt38jaIPKTwvuiqYg" type="text/javascript"></script> 
<?php
include("footer.php");
?>
