<?php 
include("../bdd/funciones_mysql.php");
conectar();
extract ($_GET);


/* function monto_carga($aniomonto){ */

		
	$sqlfact=mysql_query("select distinct cedula_fact from factura_trab where month(fecha_fact) = '$mesnomina' and year(fecha_fact) = '$anionomina' order by cedula_fact");
	$factnum = mysql_num_rows($sqlfact);
	
	for ($m = 1; $m<=$factnum ; $m++)
	{
	$consultafact = mysql_fetch_array($sqlfact);
	echo $consultafact['cedula_fact']."<br>";
	
	$sqlmonto=mysql_query("select monto_fact from factura_trab where month(fecha_fact) = '$mesnomina' and year(fecha_fact) = '$anionomina' and cedula_fact='$consultafact[cedula_fact]' order by cedula_fact");
	$montonum = mysql_num_rows($sqlmonto);
	$sumamonto=0;
	for ($n = 1; $n<=$montonum ; $n++)
	{
	$consultamonto = mysql_fetch_array($sqlmonto);
	$monto=$consultamonto['monto_fact'];
	$sumamonto=$sumamonto+$monto;
	
	}
	echo $sumamonto."<br>";
	}
	
/* } */

?>