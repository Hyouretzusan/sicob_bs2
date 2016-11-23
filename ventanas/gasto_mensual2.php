<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);
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
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/gasto_mensual2" />
<fieldset id="cuerpobuscador" style="background-color:#FFF; width:50%">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>GASTO MENSUAL</strong></legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
  <td align="center">C.I. Trabajador
  </td>
    <td width="47%" align="center"><input name="cedula_trab" type="text" id="cedula_trab" style="width:98%" size="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="required" /></td>
      </tr>
      <tr>
    <td align="center">Mes</td>
     <td width="33%" align="center"><select name="mes" id="mes" style="width:98%">
        <option value="">Mes</option>
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6">Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
      </select></td>
      </tr>
      <tr>
      <td align="center">A&ntilde;o
  </td>
       <td width="20%">
      <input name="anio" type="text" id="anio" style="width:98%" size="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="required" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="middle">
      <input type="submit" name="buscar" id="buscar" value="Buscar" />
    </td>
    </tr>
 </table>
</fieldset></form>
<br>
<br>
<br>
</center>

<?php 
if (isset($_GET['buscar']))
{
	$cedulanomina = $_GET['cedula_trab'];
	$mesnomina = $_GET['mes'];
	$anionomina = $_GET['anio'];
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

$stringbuscarfact=mysql_query("select * from factura_trab where month(fecha_fact) = '$mesnomina' and year(fecha_fact) = '$anionomina' and cedula_trab = '$cedulanomina' order by fecha_fact") or die ("Error: Linea 95".mysql_error());
	$cuadrosbuscarfact = mysql_num_rows($stringbuscarfact);
$stringbuscartrab=mysql_query("select * from trabajador where cedula_trab = '$cedulanomina'");
	$cuadrosbuscartrab=mysql_num_rows($stringbuscartrab);
	$stringbuscarfam=mysql_query("select * from familiar where cedula_trab = '$cedulanomina'");
	$cuadrosbuscarfam=mysql_num_rows($stringbuscarfam);
	$cuadroscarga=$cuadrosbuscarfam + $cuadrosbuscartrab;
	

/* si sale mal, poner monto_carga aqui */

 if ($cuadrosbuscarfact > 0)
 	{?>
<br />
<table width="750" border="1" align="center">

  <tr>
    <td width="51" align="center">Codigo</td>
    <td width="102" align="center">Inst/Farm/Med</td>
    <td width="87" align="center">Observacion</td>
    <td width="47" align="center">Fecha</td>
    <td width="41" align="center">Monto</td>
    <td width="98" align="center">Tipo de Gasto</td>
    <td width="49" align="center">Cedula</td>
    <td width="86" align="center">Identificador</td>
    <td width="67" align="center">Modificar</td>
    <td width="58" align="center">Eliminar</td>
  </tr>
  
  <?php for ($c=1; $c<=$cuadrosbuscarfact;$c++)
	{
		$infofact=mysql_fetch_array($stringbuscarfact);
		$montomen = $infofact['monto_fact'];
	$sumamontomen = $sumamontomen+$montomen;
	
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infofact['codigo_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['nombre_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['observacion_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['fecha_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['monto_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['tipogasto_fact']; ?></td>
    <?php if ($infofact['cedula_trab'] != 0) {?>
    <td align="center" valign="middle"><?php echo $infofact['cedula_fact']; ?></td>
    <?php }?>
    <td align="center" valign="middle"><?php echo $infofact['identificador']; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_factura&codigo=<?php echo $infofact['codigo_fact']; ?>&fac=<?php echo $infofact['nombre_fact']; ?>&identificador=<?php echo $infofact['identificador']; ?>&mon=<?php echo $infofact['monto_fact']; ?>&cedula=<?php echo $infofact['cedula_fact']; ?>" title="Modificar informacion de <?php echo $infofact['cedula_fact']; ?>">Editar</a></td>
     <td align="center" valign="middle"><a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar esta factura?','?sec=ventanas/consumos&codigo=<?php echo $infofact['codigo_fact']; ?>&eliminar=2')" title="Eliminar informacion de <?php echo $infofact['codigo_fact']; ?>">Eliminar</a></td>
    
  </tr>
  <?php }
	
?>
  
 </table>
  
 <table width="200" border="1" align="center">
  <tr>
    <td width="83" align="center">Total mes <strong><?php echo $mesnominaver ?></strong> </td>
    <td width="101" align="center"><?php echo $sumamontomen;?></td>
  </tr>
</table>

<?php 
}
if ($cuadroscarga > 0)
 	{?>
<br />
<table width="700" border="1" align="center">

  <tr>
    <td width="117" align="center">Nombre</td>
    <td width="126" align="center">Apellido</td>
    <td width="93" align="center">Cedula</td>
    <td width="93" align="center">Parentesco</td>
    <td width="114" align="center">Saldo Medicinas</td>
    <td width="114" align="center">Saldo Odontologia</td>
    <td width="98" align="center">Saldo Lentes</td>
    <td width="98" align="center">Saldo Protesis</td>
  </tr>
  
  <?php
		$infotrab=mysql_fetch_array($stringbuscartrab);
		
		 ?>
           <tr>
    <td align="center" valign="middle"><?php echo $infotrab['nombre_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infotrab['apellido_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infotrab['cedula_trab']; ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><?php echo $infotrab['salmed_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infotrab['salmedod_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infotrab['sallen_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infotrab['salprot_trab']; ?></td>
   
  </tr>
  <?php
  for ($y=1; $y<=$cuadrosbuscarfam; $y++)
	{
		$infofam=mysql_fetch_array($stringbuscarfam);
		
		 ?>
           <tr>
    <td align="center" valign="middle"><?php echo $infofam['nombre_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['apellido_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['cedula_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['parentesco_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['salmed_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['salmedod_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['sallen_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infofam['salprot_fam']; ?></td>
   
  </tr>
   <?php }?>
  
 </table>
 
<?php }
	}?>
