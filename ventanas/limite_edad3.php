<?php 
date_default_timezone_set("America/Caracas");
/* include("bdd/funciones_mysql.php");
conectar(); */
extract ($_GET);
 
 /*function limite_prueba(){
	 echo 'AQUI IRIA OPERACIONES Y FUNCIONES XDXDXDXD NAAAHHH';
	 }*/
	 
 function limite_edad3($laquesea){
	/*  $stringfechaactual="select YEAR(now), MONTH(now), DAY(now)"; 
	 $sqlfechaactual=mysql_query($stringfechaactual);*/
	 $diaactual = date("d");
	 $mesactual = date ("m");
	 $anioactual = date ("Y");
	 $identificador = $_GET['identificador'];
 if ($identificador =='Familiar')
{
 $buscahijos= mysql_query("select * from familiar where cedula_fam = '".$laquesea."'") or die ('Error linea 20'.mysql_error());
 $infohijos= mysql_fetch_array($buscahijos);
 $hayhijos= mysql_num_rows($buscahijos);
 
 	if($infohijos['parentesco_fam'] == 'Hijo/a' and $infohijos['patologia_fam'] == 'No' and $infohijos['discapacidad_fam'] == 'No')

		{
	$stringfecha="select YEAR(fecnac_fam), MONTH(fecnac_fam), DAY(fecnac_fam) from familiar WHERE cedula_fam = '$laquesea'";
$sqlfecha=mysql_query($stringfecha) or die ('ERROR AL VER DIA, MES, AÑO'.mysql_error());
$cantidadfecha=mysql_num_rows($sqlfecha);

for($i=1; $i<=$cantidadfecha; $i++)
{
	$campofecha=mysql_fetch_array($sqlfecha);
	$diabd=$campofecha['DAY(fecnac_fam)'];
	$mesbd=$campofecha['MONTH(fecnac_fam)'];
	$aniobd=$campofecha['YEAR(fecnac_fam)'];
	$cedula_familiar=$campofecha['cedula_fam'];
	
}
	$diahijos = $diaactual - $diabd;
	$meshijos = $mesactual - $mesbd;
	$aniohijos = $anioactual - $aniobd;
	
	
	
		if($diahijos < 0)
		{$mesactual = $mesactual - 1;}
		
		if($meshijos < 0)
		{$anioactual = $anioactual - 1;}
		
		$edad = $anioactual - $aniobd;
		
		if($edad > 24)	
		    {
			echo 'EDAD: '.$edad;?>
			<script>
		alert("El ciudadano ha superado el limite de edad establecido para recibir beneficios"); 
		window.history.back();
        </script>
			<?php 
			}
		
		}
		else if($infohijos['parentesco_fam'] != 'Hijo/a' or $infohijos['patologia_fam'] = Si or $infohijos['discapacidad_fam'] = Si)
	 	{
			/* hay algun comando que me envie directo a la factura? o aqui incluyo las operaciones de incluir factura?*/
		}
}?>
 <input name="edad" type="hidden" value="<?php echo 'EDAD: '.$aniohijos;?>" /> <?php }
 
 
 ?> 