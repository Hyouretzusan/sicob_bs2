<?php 
/* extract ($_POST); */

function nomina_total($analistatotal, $dependenciatotal, $mestotal, $aniototal)
{
	
header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=nomina_total.xls");
?>

<style>
#cuadro 
{
 
	 border-bottom:2px; 
	 border-bottom-color:#880000;
	 border-left:2px; border-left-color:#880000; 
	 border-right:2px; 
	 border-right-color:#880000; 
	 border-top:2px; 
	 border-top-color:#880000;
	 border-radius:10px;
	 background-color:#FFF;
}
#cuerpobuscador
{
	width:auto
}
</style>
 <center>
<br>
<br>
<br>
</center>

<?php 

	$dependencianomina = $dependenciatotal;
	$mesnomina = $mestotal;
	$anionomina = $aniototal;
	$analistanomina = $analistatotal;
	$mesnominaver = str_replace(1,'Enero',
	str_replace(2,'Febrero',
	str_replace(3,'Marzo',
	str_replace(4,'Abril',
	str_replace(5,'Mayo',
	str_replace(6,'Junio',
	str_replace(7,'Julio',
	str_replace(8,'Agosto',
	str_replace(9,'Septiembre',
	str_replace(10,'Octubre',
	str_replace(11,'Noviembre',
	str_replace(12,'Diciembre',
	$_GET['mes']))))))))))));
	
	
	
	

$sqlfact=mysql_query("select distinct cedula_trab from factura_trab where month(fecha_fact) = '".$mesnomina."' and year(fecha_fact) = '".$anionomina."' and apellido_fact = '".$dependencianomina."' and dependencia_fact = '".$dependencianomina."' order by cedula_trab") or die ("Error linea 60 ".mysql_error());
	
	$factnum = mysql_num_rows($sqlfact);

 if ($factnum > 0)
 
 	{?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="9"><strong>N&oacute;mina Total del Personal <?php echo $dependencianomina; ?>,  <?php echo $mesnominaver ?> del <?php echo $anionomina?></strong></td>
  </tr>
</table>

    <br>
<table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="53" align="center">Cedula</td>
    <td width="53" align="center">Nombre</td>
    <td width="53" align="center">Apellido</td>
    <td width="53" align="center">Codigo</td>
    <td width="105" align="center" valign="middle">Cargo</td>    
    <td width="90" align="center" valign="middle">Medicinas</td>
    <td width="90" align="center" valign="middle">Odontologia</td>
    <td width="90" align="center" valign="middle">Lentes</td>
    <td width="90" align="center" valign="middle">Protesis</td>
    <td width="90" align="center">Total </td>
    <td width="100" align="center">Firma</td>
  </tr>
  
  <?php for ($m=1; $m<=$factnum;$m++)
	{
		
		$consultafact = mysql_fetch_array($sqlfact);
		$cedula_distinta = $consultafact['cedula_trab'];
		
		$stringbuscartrab = "select * from trabajador where cedula_trab = '".$cedula_distinta."' ";
		$sqlbuscartrab = mysql_query($stringbuscartrab) or die ("Error linea 96 ".mysql_error());
		$infot = mysql_fetch_array($sqlbuscartrab);
	
	$sqlmontomed=mysql_query("select monto_fact from factura_trab where month(fecha_fact) = '".$mesnomina."' and year(fecha_fact) = '".$anionomina."' and cedula_trab='".$infot['cedula_trab']."' and tipogasto_fact = 'Medicinas' ") or die ("Error linea 99".mysql_error());
	$montonum_med = mysql_num_rows($sqlmontomed);
	$sumamontomed=0;
	for ($n = 1; $n<=$montonum_med ; $n++)
	{
	$consultamontomed = mysql_fetch_array($sqlmontomed);
	$montomed = $consultamontomed['monto_fact'];
	$sumamontomed = $sumamontomed+$montomed;
	}	
	
	$sqlmontoodo=mysql_query("select monto_fact from factura_trab where month(fecha_fact) = '".$mesnomina."' and year(fecha_fact) = '".$anionomina."' and cedula_trab='".$infot['cedula_trab']."' and tipogasto_fact = 'Odontologia' ") or die ("Error linea 109".mysql_error());
	$montonum_odo = mysql_num_rows($sqlmontoodo);
	$sumamontoodo=0;
	for ($x = 1; $x<=$montonum_odo ; $x++)
	{
	$consultamontoodo = mysql_fetch_array($sqlmontoodo);
	$montoodo = $consultamontoodo['monto_fact'];
	$sumamontoodo = $sumamontoodo+$montoodo;
	}	
	
	$sqlmontolen=mysql_query("select monto_fact from factura_trab where month(fecha_fact) = '".$mesnomina."' and year(fecha_fact) = '".$anionomina."' and cedula_trab='".$infot['cedula_trab']."' and tipogasto_fact = 'Lentes' ") or die ("Error linea 119".mysql_error());
	$montonum_len = mysql_num_rows($sqlmontolen);
	$sumamontolen=0;
	for ($y = 1; $y<=$montonum_len ; $y++)
	{
	$consultamontolen = mysql_fetch_array($sqlmontolen);
	$montolen = $consultamontolen['monto_fact'];
	$sumamontolen = $sumamontolen+$montolen;
	}	
	
	$sqlmontoprot=mysql_query("select monto_fact from factura_trab where month(fecha_fact) = '".$mesnomina."' and year(fecha_fact) = '".$anionomina."' and cedula_trab='".$infot['cedula_trab']."' and tipogasto_fact = 'Protesis' ") or die ("Error linea 129".mysql_error());
	$montonum_prot = mysql_num_rows($sqlmontoprot);
	$sumamontoprot=0;
	for ($z = 1; $z<=$montonum_prot ; $z++)
	{
	$consultamontoprot = mysql_fetch_array($sqlmontoprot);
	$montoprot = $consultamontoprot['monto_fact'];
	$sumamontoprot = $sumamontoprot+$montoprot;
	}	

		 ?>
         
  <tr>
    <td align="center" valign="middle" style="color:#000; vertical-align:middle; text-align:center;mso-number-format:'#,##0'"><?php echo $infot['cedula_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['nombre_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['apellido_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['codigo_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['cargo_trab']; ?></td>
    <td align="center" valign="middle"><?php echo number_format($sumamontomed,2,',','.');?></td>
    <td align="center" valign="middle"><?php echo number_format($sumamontoodo,2,',','.');?></td>
    <td align="center" valign="middle"><?php echo number_format($sumamontolen,2,',','.');?></td>
    <td align="center" valign="middle"><?php echo number_format($sumamontoprot,2,',','.');?></td>
    <td align="center" valign="middle"><?php $totalmonto = $sumamontomed + $sumamontoodo + $sumamontolen + $sumamontoprot;
	echo number_format($totalmonto,2,',','.');  ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    
  </tr>
  <?php }?>
</table>
	<p>
    <br>
	<?php }
			
	$stringbuscardirector = "select * from autoridades where id_autoridades = 1";
	$sqlbuscardirector = mysql_query($stringbuscardirector) or die (mysql_error());
	$infodirector = mysql_fetch_array($sqlbuscardirector);
	
	$stringbuscarjeferrhh = "select * from autoridades where id_autoridades = 2";
	$sqlbuscarjeferrhh = mysql_query($stringbuscarjeferrhh) or die (mysql_error());
	$infojeferrhh = mysql_fetch_array($sqlbuscarjeferrhh);
	
	$stringbuscaradministrador = "select * from autoridades where id_autoridades = 3";
	$sqlbuscaradministrador = mysql_query($stringbuscaradministrador) or die (mysql_error());
	$infoadministrador = mysql_fetch_array($sqlbuscaradministrador);
	
	$stringbuscaranalista = "select * from usuario where nick_usuario = '".$analistanomina."'";
	$sqlbuscaranalista = mysql_query($stringbuscaranalista) or die (mysql_error());
	$infoanalista = mysql_fetch_array($sqlbuscaranalista);
	
	
	 ?>
	 <table width="200" border="0" align="center">
	
<table width="100%" border="0" align="center">
 	<tr>
    <td  border="0" align="center" colspan="2">__________________</td>
    <td  border="0" align="center" colspan="2">__________________</td>
    <td  border="0" align="center" colspan="2">__________________</td>
    <td  border="0" align="center" colspan="2">__________________</td>
  </tr>
  	<tr>
     <td  border="0" align="center" colspan="2"><?php echo $infodirector['nombre_autoridades']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo $infojeferrhh['nombre_autoridades']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo $infoadministrador['nombre_autoridades']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo $infoanalista['nombre_usuario']." ".$infoanalista['apellido_usuario'];?>
     </td>
     </tr>
     <tr>
     <td height="20" colspan="2" align="center"  border="0"><?php echo $infodirector['autoridad']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo $infojeferrhh['autoridad']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo $infoadministrador['autoridad']; ?>
     </td>
     <td  border="0" align="center" colspan="2"><?php echo 'Analista'; ?>
     </td>
     </td>
     
     </tr>
     </table>
     <?php
	
			}
?>