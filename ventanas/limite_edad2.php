<?php 
date_default_timezone_set("America/Caracas");
/* include("bdd/funciones_mysql.php");
conectar(); */
extract ($_GET);
 
 function limite_prueba(){
	 echo 'AQUI IRIA OPERACIONES Y FUNCIONES XDXDXDXD NAAAHHH';
	 }
	 
 function limite_edad($cualquiera){
	/*  $stringfechaactual="select YEAR(now), MONTH(now), DAY(now)"; */
	 $sqlfechaactual=mysql_query($stringfechaactual);
	 $diaactual = date("d");
	 $mesactual = date ("m");
	 $anioactual = date ("Y");
	 $identificador = $_GET['identificador'];
 if ($identificador =='Familiar')
{
 $buscahijos= mysql_query("select * from familiar where cedula_fam = '$cualquiera'");
 $infohijos= mysql_fetch_array($buscahijos);
 $hayhijos= mysql_num_rows($buscahijos);
 
 	if($infohijos['parentesco_fam'] == 'Hijo/a' and $infohijos['patologia_fam'] == 'No' and $infohijos['discapacidad_fam'] == 'No')

		{
	$stringfecha="SELECT fecnac_fam, CURDATE(), (YEAR(CURDATE())-YEAR(fecnac_fam)) -(RIGHT(CURDATE(),5)<RIGHT(fecnac_fam,5)) AS edad FROM familiar WHERE cedula_fam = '$cualquiera'";
$sqlfecha=mysql_query($stringfecha) or die ('ERROR AL VER DIA, MES, AÑO'.mysql_error());
$cantidadfecha=mysql_num_rows($sqlfecha);
$campofecha=mysql_fetch_array($sqlfecha);



/* for($i=1; $i<=$cantidadfecha; $i++)
{
	$campofecha=mysql_fetch_array($sqlfecha);
	$diabd=$campofecha['DAY(fecnac_fam)'];
	$mesbd=$campofecha['MONTH(fecnac_fam)'];
	$aniobd=$campofecha['YEAR(fecnac_fam)'];
	$cedula_familiar=$campofecha['cedula_fam'];
	echo $cedula_familiar.'---->'.$diabd.'/'.$mesbd.'/'.$aniobd.'<br>';
}
	$diahijos = $diaactual - $diabd;
	$meshijos = $mesactual - $mesbd;
	$aniohijos = $anioactual - $aniobd;
	
	echo 'DIA TOTAL: '.$diahijos.' MES TOTAL: '.$meshijos.' A&Ntilde;O TOTAL: '.$aniohijos;
	
		if($diahijos >= 0 and $meshijos >= 0 and $aniohijos > 25) */	
		
		if($campofecha > 25)
		    {
			?>
			<script>
		alert("El ciudadano ha superado el limite de edad establecido para recibir beneficios");
        </script>
			<?php 
			}
		
		}
		else if($infohijos['parentesco_fam'] != Hijo/a or $infohijos['patologia_fam'] = Si or $infohijos['discapacidad_fam'] = Si)
	 	{
			/* hay algun comando que me envie directo a la factura? o aqui incluyo las operaciones de incluir factura?*/
		}
}
 }
 
 
 ?>