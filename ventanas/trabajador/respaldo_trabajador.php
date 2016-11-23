<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);
/* FALTA CONECTAR ESTA FUNCION A LA PANTALLA DE RESET */

function salvavidas() 
{
	
	$buscartablatrab = "SELECT * from sicob.trabajador ORDER by cedula_trab";
	$extraertablatrab = mysql_query($buscartablatrab) or die ("ERROR: linea 11 ".mysql_error()) ;
	$cantidadtablatrab = mysql_num_rows ($extraertablatrab);
	
	  for ($i=1; $i<=$cantidadtablatrab; $i++)
	  {
		  $salvartablat = mysql_fetch_array($extraertablatrab);
		  
		  $cedula_trab = $salvartablat['cedula_trab'];
		  $nombre_trab = $salvartablat['nombre_trab'];
		  $apellido_trab = $salvartablat['apellido_trab'];
		  $codigo_trab = $salvartablat['codigo_trab'];
		  $sexo_trab = $salvartablat['sexo_trab'];
		  $fecing_trab = $salvartablat['fecing_trab'];
		  $fecnac_trab = $salvartablat['fecnac_trab'];
		  $cargo_trab = $salvartablat['cargo_trab'];
		  $dependencia_trab = $salvartablat['dependencia_trab'];
		  $identificador_trab = $salvartablat['identificador_trab'];
		  $salmedod_trab = $salvartablat['salmedod_trab'];
		  $sallen_trab = $salvartablat['sallen_trab'];
		  $salprot_trab = $salvartablat['salprot_trab'];		 
		  
		  $exportartablat="insert into respaldo_trab (cedula_trab, apellido_trabr, nombre_trabr, sexo_trabr, fecing_trabr, cargo_trabr, dependencia_trabr, codigo_trabr, fecnac_trabr, salmedod_trabr, sallen_trabr, salprot_trabr, identificador_trabr) values ('$cedula_trab','$apellido_trab','$nombre_trab', '$sexo_trab', '$fecing_trab', '$cargo_trab','$dependencia_trab','$codigo_trab', '$fecnac_trab', '$salmedod_trab', '$sallen_trab', '$salprot_trab', '$identificador_trab')";
		
		  $sqlexportartablat = mysql_query($exportartablat) or die ("ERROR: linea 34 ".mysql_error());
		
	  }
	
		$buscartablafam = "SELECT * from sicob.familiar ORDER by cedula_trab";
	$extraertablafam = mysql_query($buscartablafam) or die ("ERROR: linea 39 ".mysql_error()) ;
	$cantidadtablafam = mysql_num_rows ($extraertablafam);
	
	  for ($j=1; $j<=$cantidadtablafam; $j++)
	  {
		  $salvartablaf = mysql_fetch_array($extraertablafam);
		  
		  $cedula_trab = $salvartablaf['cedula_trab'];
		  $cedula_fam = $salvartablaf['cedula_fam'];
		  $nombre_fam = $salvartablaf['nombre_fam'];
		  $apellido_fam = $salvartablaf['apellido_fam'];
		  $codigo_fam = $salvartablaf['codigo_fam'];
		  $sexo_fam = $salvartablaf['sexo_fam'];
		  $fecnac_fam = $salvartablaf['fecnac_fam'];
		  $parentesco_fam = $salvartablaf['parentesco_fam'];
		  $patologia_fam = $salvartablaf['patologia_fam'];
		  $discapacidad_fam = $salvartablaf['discapacidad_fam'];
		  $identificador_fam = $salvartablaf['identificador_fam'];
		  $salmedod_fam = $salvartablaf['salmedod_fam'];
		  $sallen_fam = $salvartablaf['sallen_fam'];
		  $salprot_fam = $salvartablaf['salprot_fam'];		 
		  
		  $exportartablaf="insert into respaldo_fam (cedula_fam, apellido_famr, nombre_famr, sexo_famr, parentesco_famr, patologia_famr, discapacidad_famr, codigo_famr, fecnac_famr, salmedod_famr, sallen_famr, salprot_famr, cedula_trab, identificador_famr) values ('$cedula_fam','$apellido_fam','$nombre_fam','$sexo_fam','$parentesco_fam','$patologia_fam','$discapacidad_fam','$codigo_fam','$fecnac_fam', '$salmedod_fam', '$sallen_fam', '$salprot_fam', '$cedula_trab', '$identificador_fam')";
		
		  $sqlexportartablaf = mysql_query($exportartablaf) or die ("ERROR: linea 63 ".mysql_error());
		
	  }
	
}	
 ?>