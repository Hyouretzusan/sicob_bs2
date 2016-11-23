<?php 
include("bdd/funciones_mysql.php");
conectar();

$stringfecha="select cedula_fam, YEAR(fecnac_fam), MONTH(fecnac_fam), DAY(fecnac_fam) from familiar where cedula_fam = '$cualquiera'";
$sqlfecha=mysql_query($stringfecha) or die ('ERROR AL VER DIA, MES, AÑO'.mysql_error());
$cantidadfecha=mysql_num_rows($sqlfecha);

for($i=1; $i<=$cantidadfecha; $i++)
{
	$campofecha=mysql_fetch_array($sqlfecha);
	$diabd=$campofecha['DAY(fecnac_fam)'];
	$mesbd=$campofecha['MONTH(fecnac_fam)'];
	$aniobd=$campofecha['YEAR(fecnac_fam)'];
	$cedula_familiar=$campofecha['cedula_fam'];
	echo $cedula_familiar.'---->'.$diabd.'/'.$mesbd.'/'.$aniobd.'<br>';
}


?>