<?php
	session_start();
	$usuarioa=$_SESSION['usuario'];
	$clavea=$_SESSION['clave'];
	$nombrea=$_SESSION['nombre'];
	$cargoa=$_SESSION['cargo'];
	$tipoa=$_SESSION['tipo'];
	/* quitar /sicob_b de la linea 10 */
	if (empty($usuarioa))
	{	header("Location: /sicob_bs/inicio_sesion.php");
	}
?>