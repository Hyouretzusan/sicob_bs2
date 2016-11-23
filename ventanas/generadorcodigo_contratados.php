<?php 

 extract ($_POST);
 
 function generadorcodigo_contratados($nocodigo)
 {
	 $existecodigo = 0;
	 do
	 {
	$primeracuarta = rand(1000,9999);
	$segundacuarta = rand(1000,9999);
	$terceracuarta = rand(1000,9999);
	
	$codigocontratado = "C-".$primeracuarta."-".$segundacuarta."-".$terceracuarta;
	  
	$revisarcodigo = mysql_query("select codigo_trab from trabajador where codigo_trab = '".$codigocontratado."' "); 
	$existecodigo = mysql_num_rows($revisarcodigo);
	 }
	 while ($existecodigo > 0);
	 
	 return $codigocontratado; 
 }
	 
	 