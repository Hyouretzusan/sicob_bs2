<?php 

function eliminar_factura($codigo_factura)
{	
    $retribuirmonto=0;
    $stringconsultarfact="select * from factura_trab where codigo_fact ='".$codigo_factura."'";
    $sqlconsultarfact=mysql_query($stringconsultarfact) or die ('Error linea 6'.mysql_error());
    $infofact = mysql_fetch_array($sqlconsultarfact);
    $gasto = $infofact['tipogasto_fact'];
    $montoviejo = $infofact['monto_fact'];
    $cedulafact = $infofact['cedula_fact'];
    $idenfact = $infofact['identificador'];
    $cedulatrab = $infofact['cedula_trab'];
    if ($gasto == 'Odontologia' and $idenfact == 'Trabajador')
    {
        $stringsumarmonto = "select * from trabajador where cedula_trab = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 17'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salmedod_trab'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update trabajador set salmedod_trab = '".$retribuirmonto."' where cedula_trab ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 22'.mysql_error());
    }
	 if ($gasto == 'Medicinas' and $idenfact == 'Trabajador')
    {
        $stringsumarmonto = "select * from trabajador where cedula_trab = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 27'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salmed_trab'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update trabajador set salmed_trab = '".$retribuirmonto."' where cedula_trab ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 32'.mysql_error());
    }
    if ($gasto == 'Lentes' and $idenfact == 'Trabajador')
    {
        $stringsumarmonto = "select * from trabajador where cedula_trab = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 37'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['sallen_trab'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update trabajador set sallen_trab = '".$retribuirmonto."' where cedula_trab ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 42'.mysql_error());
    }
    if ($gasto == 'Protesis' and $idenfact == 'Trabajador')
    {
        $stringsumarmonto = "select * from trabajador where cedula_trab = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 47'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salprot_trab'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update trabajador set salprot_trab = '".$retribuirmonto."' where cedula_trab ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 52'.mysql_error());
    }
    if ($gasto == 'Odontologia' and $idenfact == 'Familiar')
    {
        $stringsumarmonto = "select * from familiar where cedula_fam = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 57'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salmedod_fam'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update familiar set salmedod_fam = '".$retribuirmonto."' where cedula_fam ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 62'.mysql_error());
    }
	if ($gasto == 'Medicinas' and $idenfact == 'Familiar')
    {
        $stringsumarmonto = "select * from familiar where cedula_fam = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 67'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salmed_fam'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update familiar set salmed_fam = '".$retribuirmonto."' where cedula_fam ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 72'.mysql_error());
    }
    if ($gasto == 'Lentes' and $idenfact == 'Familiar')
    {
        $stringsumarmonto = "select * from familiar where cedula_fam = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 77'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['sallen_fam'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update familiar set sallen_fam = '".$retribuirmonto."' where cedula_fam ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 82'.mysql_error());
    }
    if ($gasto == 'Protesis' and $idenfact == 'Familiar')
    {
        $stringsumarmonto = "select * from familiar where cedula_fam = '".$cedulafact."'";	
        $sqlsumarmonto = mysql_query($stringsumarmonto) or die ('Error linea 87'.mysql_error());
        $infotrab = mysql_fetch_array($sqlsumarmonto);
        $montoactual = $infotrab['salprot_fam'];
        $retribuirmonto = $montoviejo + $montoactual;
        $stringactualizarmonto = "update familiar set salprot_fam = '".$retribuirmonto."' where cedula_fam ='".$cedulafact."'";
        $sqlactualizarmonto = mysql_query($stringactualizarmonto) or die ('Error linea 92'.mysql_error());
    }
	
    $stringeliminarfact="delete from factura_trab where codigo_fact = '".$codigo_factura."'";
    $sqleliminarfact=mysql_query($stringeliminarfact) or die ('Error al eliminar la factura: linea 96'.mysql_error());
	
    ?>
    <script>
	alert('La factura ha sido eliminada'); window.history.go(-1);
    </script>
    <?php
}

function eliminar_facturas($cedula_factura)
{
		$stringeliminarfacturas = "delete from factura_trab where cedula_fact = '".$cedula_factura."'";
		$sqleliminarfacturas = mysql_query($stringeliminarfacturas) or die ('Error linea 108'.mysql_error());
}

function eliminar_facturas_todo($cedula_trabajador)
{
		$stringdesaparecerfacturas = "delete from factura_trab where cedula_trab = '".$cedula_trabajador."'";
		$sqldesaparecerfacturas = mysql_query($stringdesaparecerfacturas) or die ('Error linea 114'.mysql_error());
}

function eliminar_familiar($cedula_familiar)
{
		$stringactualizarhabdebfam="delete from familiar where cedula_fam = '".$cedula_familiar."'";
		$sqlactualizarhabdebfam=mysql_query($stringactualizarhabdebfam) or die ('Error al eliminar al familiar: linea 120'.mysql_error());
	
	?>
    <script>
	alert('El familiar ha sido eliminado');
	</script>
    <?php
}

function eliminar_familiares($cedula_trabajador)
{
		$stringdesaparecerfacturas = "delete from familiar where cedula_trab = '".$cedula_trabajador."'";
		$sqldesaparecerfacturas = mysql_query($stringdesaparecerfacturas) or die ('Error linea 132'.mysql_error());
}

function eliminar_trabajador($cedula_trabajador)
{
		$stringactualizarhabdebtrab="delete from trabajador where cedula_trab = '".$cedula_trabajador."'";
		$sqlactualizarhabdebtrab=mysql_query($stringactualizarhabdebtrab) or die ('Error al eliminar al trabajador: linea 138'.mysql_error());
	
	?>
    <script>
	alert('La persona ha sido eliminada');
	</script>
    <?php
}

function deshabilitar_familiares($cedula_familiar)
{
	
}

function deshabilitar_familiar($cedula_familiar)
{
	$stringverhabdebtrab = "select habdeb_fam from familiar where cedula_fam = '".$cedula_familiar."'";
	$sqlverhabdebtrab = mysql_query($stringverhabdebtrab) or die ('Error al revisar datos del familiar: '.mysql_error());
	$campohabdebtrab = mysql_fetch_array($sqlverhabdebtrab);
	$habdebtrab = $campohabdebtrab['habdeb_fam'];
	
	if($habdebtrab == 1)
	{
		$actualizarhabdebtrab = 0;
		?>
		<script>
        var mensaje = 'deshabilitado';
        </script>
    <?php
	}
	else
	{
		$actualizarhabdebtrab = 1;
		?>
        <script>
        var mensaje = 'habilitado';
        </script>
        <?php
	}
	
	$stringactualizarhabdebtrab = "update familiar set habdeb_fam='".$actualizarhabdebtrab."' where cedula_fam = '".$cedula_trabajador."'";
	$sqlactualizarhabdebtrab = mysql_query($stringactualizarhabdebtrab) or die ('Error al habilitar/deshabilitar al familiar: '.mysql_error());
	
	?>
    <script>
	alert('El familiar ha sido '+mensaje);
	</script>
    <?php
}

function deshabilitar_trabajador($cedula_trabajador)
{
	$stringverhabdebtrab = "select habdeb_trab from trabajador where cedula_trab = '".$cedula_trabajador."'";
	$sqlverhabdebtrab = mysql_query($stringverhabdebtrab) or die ('Error al revisar datos del trabajador: '.mysql_error());
	$campohabdebtrab = mysql_fetch_array($sqlverhabdebtrab);
	$habdebtrab = $campohabdebtrab['habdeb_trab'];
	
	if($habdebtrab==1)
	{
		$actualizarhabdebtrab=0;
		?>
		<script>
        var mensaje='deshabilitado';
        </script>
    <?php
	}
	else
	{
		$actualizarhabdebtrab=1;
		?>
        <script>
        var mensaje='habilitado';
        </script>
        <?php
	}
	
	$stringactualizarhabdebtrab="update trabajador set habdeb_trab='".$actualizarhabdebtrab."' where cedula_trab = '".$cedula_trabajador."'";
	$sqlactualizarhabdebtrab=mysql_query($stringactualizarhabdebtrab) or die ('Error al habilitar/deshabilitar al trabajador: '.mysql_error());
	
	?>
    <script>
	alert('La persona ha sido '+mensaje);
	</script>
    <?php
	
}

function deshabilitar_usuario($nick_usuario)
{
	
}

?>