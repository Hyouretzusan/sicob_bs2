<?php
include("bdd/funciones_mysql.php");
conectar();

$stringbuscador01="select dependencia_trab, cedula_trab from trabajador order by cedula_trab asc";
$sqlbuscador01=mysql_query($stringbuscador01) or die ("Error 01: ".mysql_error());
$cantidadbuscador01=mysql_num_rows($sqlbuscador01);

for($i=1; $i<=$cantidadbuscador01; $i++)
{
	$campobuscador01=mysql_fetch_array($sqlbuscador01);
	$dependencia_trab=$campobuscador01['dependencia_trab'];
	$cedula_trab=$campobuscador01['cedula_trab'];
	
	$stringbuscador02="update familiar set dependencia_fam='".$dependencia_trab."' where cedula_trab=".$cedula_trab;
	$sqlbuscador02=mysql_query($stringbuscador02) or die ("Error 02: ".mysql_error());
	
	$stringbuscador03="update factura_trab set apellido_fact='".$dependencia_trab."' where cedula_trab=".$cedula_trab;
	$sqlbuscador03=mysql_query($stringbuscador03) or die ("Error 03: ".mysql_error());
}

echo "Cambios realizados XD";
?>