<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->

</SCRIPT>

<?php 
include("bdd/funciones_mysql.php");
include("ventanas/eliminar_deshabilitar.php");
conectar();
extract ($_GET);

if(isset($_GET['eliminar']) and $_GET['eliminar']==1)
{
	eliminar_facturas_todo($_GET['cedula']);
	eliminar_familiares($_GET['cedula']);
	eliminar_trabajador($_GET['cedula']);
}

else if(isset($_GET['eliminar']) and $_GET['eliminar']==0)
{
	eliminar_facturas($_GET['cedula']);
	eliminar_familiar($_GET['cedula']);
}
else if(isset($_GET['eliminar']) and $_GET['eliminar']==2)
{
	eliminar_factura($_GET['codigo']);
}
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
<input name="sec" type="hidden" value="ventanas/buscador" />
<input name="cedula" type="hidden" value="<?php echo $_GET['cedula'] ?>" />
<fieldset id="cuerpobuscador" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>BUSCADOR</strong> </legend>
 <table width="50%" border="0" id="cuadro">
  <tr>
    <td width="69%"><input name="criterio" type="text" id="criterio" style="width:98%; height:auto" size="20" /></td>
     <td width="31%" align="center"><select name="seleccion" id="seleccion" style="width:100px">
        
        <option value="cedula">Cedula</option>
        <option value="codigo">Codigo (Beneficiario)</option>
        <option value="factura">Codigo (Factura)</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
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
	$contador = $_GET['seleccion'];
	
	if ($contador == 'cedula' or $contador == 'codigo')
	{
$stringbuscartrab="select * from trabajador where $_GET[seleccion]_trab = '$_GET[criterio]'";
$sqlbuscartrab=mysql_query($stringbuscartrab) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscartrab=mysql_num_rows($sqlbuscartrab);
$stringbuscarfam="select * from familiar where $_GET[seleccion]_fam = '$_GET[criterio]'";
$sqlbuscarfam=mysql_query($stringbuscarfam) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscarfam=mysql_num_rows($sqlbuscarfam);
	}
	if ($contador == 'factura')
	{
$stringbuscarfact="select * from factura_trab where codigo_fact = '$_GET[criterio]'";
$sqlbuscarfact=mysql_query($stringbuscarfact) or die ("Error: Linea 100 ".mysql_error());
$cuadrosbuscarfact=mysql_num_rows($sqlbuscarfact);
/* $stringbuscarfacf="select * from factura_fam where $_GET[seleccion]_facf = '$_GET[criterio]'";
$sqlbuscarfacf=mysql_query($stringbuscarfacf) or die ("Error en busqueda ".mysql_error());
$cuadrosbuscarfacf=mysql_num_rows($sqlbuscarfacf); */
	}
 /*if ($cuadrosbuscartrab>0)	
	{$condicional= "_trab";
	 $consul= $cuadrosbuscartrab;
	 $datos= $sqlbuscartrab;}
	 
	else if ($cuadrosbuscarfam>0)
	{$condicional= "_fam";
	 $consul= $cuadrosbuscarfam;
	 $datos= $sqlbuscarfam;}
	 
	else echo "La persona no se encuentra registrada en el sistema"*/
?>
<?php if ($cuadrosbuscartrab > 0 or $cuadrosbuscarfam > 0)
 	{?>
<table width="806" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="44" align="center">Cedula</td>
    <td width="53" align="center">Nombre</td>
    <td width="53" align="center">Apellido</td>
    <td width="47" align="center">Dependencia</td>
    <td width="47" align="center">Parentesco</td>
    <td width="105" align="center" valign="middle">Registrar Familiar</td>
    
    <td width="90" align="center" valign="middle">Registrar Factura</td>
    <td width="78" align="center">Modificar</td>
    <td width="78" align="center">Eliminar</td>
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
    <td align="center" valign="middle"><?php echo $infot['cedula_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['nombre_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['apellido_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['dependencia_trab']; ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/registrar_familiar&cedula=<?php echo $infot['cedula_trab']; ?>&nombre=<?php echo $infot['nombre_trab']; ?>&apellido=<?php echo $infot['apellido_trab']; ?>&dependencia=<?php echo $infot['dependencia_trab']; ?>" title="Agregar Familiar a <?php echo $infot['cedula_trab']; ?>">Registrar Familiar</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/registrar_factura&cedula=<?php echo $infot['cedula_trab']; ?>&nombre=<?php echo $infot['nombre_trab']; ?>&apellido=<?php echo $infot['apellido_trab']; ?>&identificador=Trabajador&dependencia=<?php echo $infot['dependencia_trab']; ?>" title="Agregar Consumo a <?php echo $infot['cedula_trab']; ?>">Registrar Factura</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_trabajador&cedula=<?php echo $infot['cedula_trab']; ?>" title="Modificar informacion de <?php echo $infot['cedula_trab']; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar este trabajador?','?sec=ventanas/buscador&cedula=<?php echo $infot['cedula_trab']; ?>&eliminar=1')" title="Eliminar informacion de <?php echo $infot['cedula_trab']; ?>">Eliminar</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/consumos&cedula=<?php echo $infot['cedula_trab']; ?>" title="Revisar Facturas de <?php echo $infot['cedula_trab']; ?>">Ir a Consumos</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/carga_familiar&cedula=<?php echo $infot['cedula_trab']; ?>" title="Mostrar Familiares de <?php echo $infot['cedula_trab']; ?>">Familiares</a></td>
    
  </tr>
  <?php }?>
   <?php for ($b=1; $b<=$cuadrosbuscarfam;$b++)
	{
		$infof=mysql_fetch_array($sqlbuscarfam);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infof['cedula_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['nombre_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['apellido_fam']; ?></td>
    
    <td align="center" valign="middle"><?php echo $infof['dependencia_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['parentesco_fam']; ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/registrar_factura&cedula=<?php echo $infof['cedula_fam']; ?>&nombre=<?php echo $infof['nombre_fam']; ?>&apellido=<?php echo $infof['apellido_fam']; ?>&dependencia=<?php echo $infof['dependencia_fam']; ?>&parentesco=<?php echo $infof['parentesco_fam']; ?>&identificador=Familiar" title="Agregar Consumo a <?php echo $infof['cedula_fam']; ?>">Registrar Factura</a></td>
    
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/modificar_familiar&cedula=<?php echo $infof['cedula_fam']; ?>" title="Modificar informacion de <?php echo $infof['cedula_fam']; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar este familiar?','?sec=ventanas/buscador&cedula=<?php echo $infof['cedula_fam']; ?>&eliminar=0')" title="Eliminar informacion de <?php echo $infof['cedula_fam']; ?>">Eliminar</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/consumos&cedula=<?php echo $infof['cedula_fam']; ?>" title="Revisar Facturas de <?php echo $infof['cedula_fam']; ?>">Ir a Consumos</a></td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <?php }?>
</table>
<?php }?>

<?php if (isset($cuadrosbuscarfact) and $cuadrosbuscarfact > 0)
	{?>
<br />
<br />
<br />
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">Codigo</td>
    <td align="center">Nombre</td>
    <td align="center">Observacion</td>
    <td align="center">Fecha</td>
    <td align="center">Monto</td>
    <td align="center">Tipo de Gasto</td>
    <td align="center">Cedula</td>
    
   
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
    <td align="center" valign="middle"><?php echo $infofact['codigo_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['nombre_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['observacion_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['fecha_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['monto_fact']; ?></td>
    <td align="center" valign="middle"><?php echo $infofact['tipogasto_fact']; ?></td>
    
    
   
    <td align="center" valign="middle"><?php echo $infofact['cedula_fact']; ?></td>
   
    <td align="center" valign="middle"><?php echo $infofact['identificador']; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_factura&codigo=<?php echo $infofact['codigo_fact']; ?>&fac=<?php echo $infofact['nombre_fact']; ?>&identificador=<?php echo $infofact['identificador']; ?>&mon=<?php echo $infofact['monto_fact']; ?>&cedula=<?php echo $infofact['cedula_fact']; ?>" title="Modificar informacion de <?php echo $infofact['nombre_fact']; ?>">Editar</a></td>
    <td align="center" valign="middle"><a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar esta factura?','?sec=ventanas/buscador&codigo=<?php echo $infofact['codigo_fact']; ?>&eliminar=2')" title="Eliminar informacion de <?php echo $infofact['codigo_fact']; ?>">Eliminar</a></td>
    
  </tr>
  <?php }?>
  
  </table>
  
<?php } if ($cuadrosbuscartrab == 0 and $cuadrosbuscarfam == 0 and $cuadrosbuscarfact == 0){ ?>
		<script>
		alert("La persona y/o factura ingresada no se encuentra registrada en el sistema");</script>
        <?php }?>	

<?php	

}
?>