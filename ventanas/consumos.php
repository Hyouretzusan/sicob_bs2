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

if(isset($_GET['eliminar']) and $_GET['eliminar']==2)
{
	eliminar_factura($_GET['codigo']);
        echo 'Hola';
}
if(isset($_GET['volver']))
{ ?>
	<script> history.go(-1) </script>
   <?php
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
#cuerpoconsumos
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/consumos" />
<input name="cedula" type="hidden" value="<?php echo $_GET['cedula']?>" />
<fieldset id="cuerpoconsumo" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>CONSUMOS</strong></legend>
 

<?php

$stringbuscarfact= "select * from factura_trab where cedula_fact = '$_GET[cedula]'";
$sqlbuscarfact=mysql_query($stringbuscarfact) or die ("Error: Linea 59 ".mysql_error());
$cuadrosbuscarfact=mysql_num_rows($sqlbuscarfact);
 
/* ?>
<table width="750" border="0" align="center">
<td align="center"><a href="javascript:decision('Volver a la pantalla anterior?')">Volver</a></td>
</table>
<?php */ 
if ($cuadrosbuscarfact > 0)
	{?><br />
<table width="750" border="1" align="center">

  <tr>
    <td align="center">Codigo</td>
    <td align="center">Inst/Farm/Med</td>
    <td align="center">Observacion</td>
    <td align="center">Fecha</td>
    <td align="center">Monto</td>
    <td align="center">Beneficio</td>
    <td align="center">Cedula</td>
    <td align="center">Identificador</td>
    <td align="center">Modificar</td>
    <td align="center">Eliminar</td>
  </tr>
  
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
    <?php if ($infofact['cedula_trab'] != 0) {?>
    <td align="center" valign="middle"><?php echo $infofact['cedula_fact']; ?></td>
    <?php }?>
    <td align="center" valign="middle"><?php echo $infofact['identificador']; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_factura&codigo=<?php echo $infofact['codigo_fact']; ?>&fac=<?php echo $infofact['nombre_fact']; ?>&identificador=<?php echo $infofact['identificador']; ?>&mon=<?php echo $infofact['monto_fact']; ?>&cedula=<?php echo $infofact['cedula_fact']; ?>&gastoviejo=<?php echo $infofact['tipogasto_fact'] ?>" title="Modificar informacion de <?php echo $infofact['cedula_fact']; ?>">Editar</a></td>
     <td align="center" valign="middle"><a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar esta factura?','?sec=ventanas/consumos&codigo=<?php echo $infofact['codigo_fact']; ?>&eliminar=2')" title="Eliminar informacion de <?php echo $infofact['codigo_fact']; ?>">Eliminar</a></td>
    
  </tr>
  <?php }?>
  
  </table>
  
<?php 
		} 
		/* else if($cuadrosbuscarfact == 0) { ?>
		<script>
		alert("La persona y/o factura ingresada no se encuentra registrada en el sistema");</script>
        <?php } */?>
        	


</fieldset></form>
</center>