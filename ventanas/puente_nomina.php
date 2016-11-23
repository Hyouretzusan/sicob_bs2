<?php 
include("../bdd/funciones_mysql.php");
conectar();
extract ($_POST); 

if (isset($_POST['buscar']))
{
	$gastopuente = $_POST['gasto'];
	$dependenciapuente = $_POST['dependencia'];
	$mespuente = $_POST['mes'];
	$aniopuente = $_POST['anio'];
	$analistapuente = $_POST['analista'];
}
	
	/* if($gastopuente == "Medicinas" or "Protesis" or "Lentes" or "Odontologia") */
	if (in_array($gastopuente, array("Medicinas", "Odontologia", "Lentes", "Protesis")))
	{
		include("../ventanas/nomina_parcial.php");
		$infoparcial = nomina_parcial($analistapuente, $gastopuente, $dependenciapuente, $mespuente, $aniopuente);
		}
	
	else if ($gastopuente == "Todas")
	{
		/* echo 'Funciona ELSE IF'; */
		include("../ventanas/nomina_total.php");
		$infototal = nomina_total($analistapuente, $dependenciapuente, $mespuente, $aniopuente);
		}	
?>
 
 