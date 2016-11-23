<?php
	include("bdd/funciones_mysql.php");
	session_start();
	session_destroy();
	pasara("msj.php?msj=ok");	
?>