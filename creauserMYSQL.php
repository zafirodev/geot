<?php 
$usuario="root";
$pass="pass";
$usuarioacrear="pablo";
$passacrear="Pasm2180R";

mysql_connect("localhost",$usuario,$pass);
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.clientes TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT on geotdb.empresas TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.estados TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.gasto_ot TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT on geotdb.localidades TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.mov_stock TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.ot TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.permiso TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.personal TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.provincias TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT on geotdb.puesto TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.rubro TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.personal TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.servicio_empresa TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.servicios TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.stock TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.stockempleado TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.unidad TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
//mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE on geotdb.usuario TO '$usuarioacrear'@'%' IDENTIFIED BY '$passacrear'");
mysql_query("FLUSH PRIVILEGES");
