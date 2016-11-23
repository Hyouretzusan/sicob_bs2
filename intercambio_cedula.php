<?php
include("bdd/funciones_mysql.php");
conectar();

$stringbusqueda01="select cedula_fact, cedula_trab, codigo_fact from factura_trab where cedula_fact != cedula_trab";
$sqlbusqueda01=mysql_query($stringbusqueda01) or die ("Error 01: ".mysql_error());
$cantidadbusqueda01=mysql_num_rows($sqlbusqueda01);
$contador=0;
for($i=1; $i <= $cantidadbusqueda01; $i++)
{
	$campobusqueda01=mysql_fetch_array($sqlbusqueda01);
	$cedula_trab=$campobusqueda01['cedula_trab'];
	$cedula_fact=$campobusqueda01['cedula_fact'];
	$codigo_fact=$campobusqueda01['codigo_fact'];
	$stringbusqueda02="select * from trabajador where cedula_trab=".$cedula_trab;
	$sqlbusqueda02=mysql_query($stringbusqueda02) or die ("Error 02: ".mysql_error());
	$cantidadbusqueda02=mysql_num_rows($sqlbusqueda02);
	
	if($cantidadbusqueda02==0)
	{
		$stringbusqueda03="update factura_trab set cedula_fact='".$cedula_trab."', cedula_trab='".$cedula_fact."' where codigo_fact='".$codigo_fact."'";
		$sqlbusqueda03=mysql_query($stringbusqueda03) or die ("Error 03: ".mysql_error());
		$contador++;
	}
}
echo "Cambios realizados: ".$contador;



?>