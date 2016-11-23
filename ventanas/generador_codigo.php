<?php 

extract ($_GET);
 
 function generador_codigo($nocedula){
	 
	 $buscacedula = mysql_query("select * from trabajador where cedula_trab = '$nocedula'");
 $infocedula = mysql_fetch_array($buscacedula);
 $buscahijos = mysql_query("select * from familiar where cedula_trab = '$nocedula' and parentesco_fam = 'Hijo/a'");
 $tienehijos = mysql_num_rows($buscahijos);
 $idhijos = rand(0,100);
	 
	 $dependencia = $infocedula['dependencia_trab'];
	 
	 if ($dependencia == "Centralizado")
	 { $inicial = "C";}
	 
	 if ($dependencia == "Obrero")
	 { $inicial = "O";}
	 
	 if ($dependencia == "Especifico")
	 { $inicial = "E";}
	 
	 if ($dependencia == "Contratado Especifico")
	 { $inicial = "CE";}
	 
	 if ($dependencia == "Contratado Centralizado")
	 { $inicial = "CC";}
	 
	 if ($dependencia == "Contratado Obrero")
	 { $inicial = "CO";}
	 
	 
	 
	 $codigoninio =  $inicial."-".$nocedula."-".$idhijos;
	  /* echo "$codigoninio"; */ 
	 
	 return $codigoninio;
	 }