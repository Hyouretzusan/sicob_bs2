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
<input name="sec" type="hidden" value="ventanas/buscador_especifico" />
<fieldset id="cuerpobuscador" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>NOMINA</strong></legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
    <td width="33%" align="center"><select name="gasto" id="gasto" style="width:100px">
        <option value="0">Seleccionar</option>
        <option value="Medicinas/Odontologia">Medicinas/Odontologia</option>
        <option value="Lentes">Lentes</option>
        <option value="Protesis">Protesis</option>
        <option value="Obrero">Obrero</option>
        <option value="Especifico">Especifico</option>
        <option value="Centralizado">Centralizado</option>
      </select></td>

     <td width="33%" align="center"><select name="mes" id="mes" style="width:100px">
        <option value="0">Mes</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
      </select></td>
       <td width="34%">
      <input name="anio" type="number" id="anio" style="width:98%" size="20" /></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle">
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
if (isset($_GET[buscar]))
{
	$contador = '$_GET[seleccion]';
	if ($contador = 'nombre' or 'apellido' or 'cedula')
	{
$stringbuscartrab="select * from trabajador where $_GET[seleccion]_trab = '$_GET[criterio]'";
$sqlbuscartrab=mysql_query($stringbuscartrab) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscartrab=mysql_num_rows($sqlbuscartrab);
$stringbuscarfam="select * from familiar where $_GET[seleccion]_fam = '$_GET[criterio]'";
$sqlbuscarfam=mysql_query($stringbuscarfam) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscarfam=mysql_num_rows($sqlbuscarfam);
	}
	if ($contador = 'codigo')
	{
$stringbuscarfact="select * from factura_trab where $_GET[seleccion]_fact = '$_GET[criterio]'";
$sqlbuscarfact=mysql_query($stringbuscarfact) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscarfact=mysql_num_rows($sqlbuscarfact);
$stringbuscarfacf="select * from factura_fam where $_GET[seleccion]_facf = '$_GET[criterio]'";
$sqlbuscarfacf=mysql_query($stringbuscarfacf) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscarfacf=mysql_num_rows($sqlbuscarfacf);
	}
 /*if ($cuadrosbuscartrab>0)	
	{$condicional= "_trab";
	 $consul= $cuadrosbuscartrab;
	 $datos= $sqlbuscartrab;}
	 
	else if ($cuadrosbuscarfam>0)
	{$condicional= "_fam";
	 $consul= $cuadrosbuscarfam;
	 $datos= $sqlbuscarfam;}
	 
	else echo "La persona no se enc
	uentra registrada en el sistema"*/
?>
<?php if ($cuadrosbuscartrab > 0 or $cuadrosbuscarfam > 0)
 	{?>
<table width="750" border="1" align="center">
  <tr>
    <td width="44" align="center">Cedula</td>
    <td width="53" align="center">Nombre</td>
    <td width="53" align="center">Apellido</td>
    <td width="47" align="center">Codigo</td>
    <td width="105" align="center" valign="middle">Agregar Familiar</td>
    
    <td width="90" align="center" valign="middle">Incluir Factura</td>
    <td width="78" align="center">Modificar</td>
    <td width="78" align="center">Consumo</td>
    <td width="78" align="center">Carga Familiar</td>
  </tr>
  <?php /* IMPORTANTE: hay que crear un condicional para "agregar familiar", solo debe aparecer en la informacion de un trabajador */
  ?>
  
  <?php for ($a=1; $a<=$cuadrosbuscartrab;$a++)
	{
		$infot=mysql_fetch_array($sqlbuscartrab);
		
		 ?>
         
     
         
  <tr>
    <td align="center" valign="middle"><?php echo $infot[cedula_trab]; ?></td>
    <td align="center" valign="middle"><?php echo $infot[nombre_trab]; ?></td>
    <td align="center" valign="middle"><?php echo $infot[apellido_trab]; ?></td>
    <td align="center" valign="middle"><?php echo $infot[codigo_trab]; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/agregar_familiar&cedula=<?php echo $infot[cedula_trab]; ?>&nombre=<?php echo $infot[nombre_trab]; ?>&apellido=<?php echo $infot[apellido_trab]; ?>" title="Agregar Familiar a <?php echo $infot[cedula_trab]; ?>">Agregar Familiar</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/incluir_factura&cedula=<?php echo $infot[cedula_trab]; ?>&nombre=<?php echo $infot[nombre_trab]; ?>&apellido=<?php echo $infot[apellido_trab]; ?>&identificador=Trabajador" title="Agregar Consumo a <?php echo $infot[cedula_trab]; ?>">Incluir Factura</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_trabajador&cedula=<?php echo $infot[cedula_trab]; ?>" title="Modificar informacion de <?php echo $infot[cedula_trab]; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/consumos&cedula=<?php echo $infot[cedula_trab]; ?>" title="Revisar Facturas de <?php echo $infot[cedula_trab]; ?>">Ir a Consumos</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/carga_familiar&cedula=<?php echo $infot[cedula_trab]; ?>" title="Mostrar Familiares de <?php echo $infot[cedula_trab]; ?>">Familiares</a></td>
    
  </tr>
  <?php }?>
   <?php for ($b=1; $b<=$cuadrosbuscarfam;$b++)
	{
		$infof=mysql_fetch_array($sqlbuscarfam);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infof[cedula_fam]; ?></td>
    <td align="center" valign="middle"><?php echo $infof[nombre_fam]; ?></td>
    <td align="center" valign="middle"><?php echo $infof[apellido_fam]; ?></td>
    <td align="center" valign="middle"><?php echo $infof[codigo_fam]; ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/incluir_factura&cedula=<?php echo $infof[cedula_fam]; ?>&nombre=<?php echo $infof[nombre_fam]; ?>&apellido=<?php echo $infof[apellido_fam]; ?>&parentesco=<?php echo $infof[parentesco_fam]; ?>&identificador=Familiar" title="Agregar Consumo a <?php echo $infot[cedula_trab]; ?>">Incluir Factura</a></td>
    
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/modificar_familiar&cedula=<?php echo $infof[cedula_fam]; ?>" title="Modificar informacion de <?php echo $infot[cedula_fam]; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/consumos&cedula=<?php echo $infof[cedula_fam]; ?>" title="Revisar Facturas de <?php echo $infof[cedula_fam]; ?>">Ir a Consumos</a></td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <?php }?>
</table>
<?php }?>

<?php if ($cuadrosbuscarfact > 0)
	{?>
<br />
<br />
<br />
<table width="800" border="1" align="center">
  <tr>
    <td align="center">Codigo</td>
    <td align="center">Nombre</td>
    <td align="center">Observacion</td>
    <td align="center">Fecha</td>
    <td align="center">Monto</td>
    <td align="center">Tipo de Gasto</td>
    <td>Cedula</td>
    
   
    <td align="center">Identificador</td>
    <td align="center">Modificar</td>
    <td align="center">Eliminar</td>
  </tr>
  <?php 
  ?>
  <?php for ($c=1; $c<=$cuadrosbuscarfact;$c++)
	{
		$infofact=mysql_fetch_array($sqlbuscarfact);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infofact[codigo_fact]; ?></td>
    <td align="center" valign="middle"><?php echo $infofact[nombre_fact]; ?></td>
    <td align="center" valign="middle"><?php echo $infofact[observacion_fact]; ?></td>
    <td align="center" valign="middle"><?php echo $infofact[fecha_fact]; ?></td>
    <td align="center" valign="middle"><?php echo $infofact[monto_fact]; ?></td>
    <td align="center" valign="middle"><?php echo $infofact[tipogasto_fact]; ?></td>
    
    
   
    <td align="center" valign="middle"><?php echo $infofact[cedula_trab]; ?></td>
   
    <td align="center" valign="middle"><?php echo $infofact[identificador]; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_factura&codigo=<?php echo $infofact[codigo_fact]; ?>&fac=<?php echo $infofact[nombre_fact]; ?>&ide=<?php echo $infofact[identificador]; ?>&monto=<?php echo $infofact[monto_fact]; ?>&cedula=<?php echo $infofact[cedula_trab]; ?>" title="Modificar informacion de <?php echo $infofact[nombre_fact]; ?>">Editar</a></td>
    <td align="center" valign="middle">&nbsp;</td>
    
  </tr>
  <?php }?>
  
  </table>
  
<?php } else if(($cuadrosbuscarfact == 0 and $cuadrosbuscartrab == 0 and $cuadrosbuscarfam == 0) ) { ?>
		<script>
		alert("La persona y/o factura ingresada no se encuentra registrada en el sistema");</script>
        <?php }?>	

<?php	

}
?>