<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET[enviar_fact]))
	{
	$salida=false;
	
	$revisarsiencuentra=mysql_query("select * from factura_trab order by codigo_fact");
	$cantidadtasarevision=mysql_num_rows($revisarsiencuentra);
	
	for($j=1;$j<=$cantidadtasarevision;$j++)
	{
		$campofact=mysql_fetch_array($revisarsiencuentra);
		$codigo_fact=$campofact['codigo_fact'];
		$fecha_fact=$campofact['fecha_fact'];
		$nombre_fact=$campofact['nombre_fact'];
		
		if(($codigo_fact==$_GET[codigo_fact]) or ($nombre_fact==$_GET[nombre_fact]))
		{
			$salida=true;
		}
	}
		if($salida==false)
	{
		$stringfacturatrabajador="insert into factura_trab (codigo_fact, nombre_fact, observacion_fact, fecha_fact, monto_fact, tipogasto_fact) values ('$_GET[codigo_fact]','$_GET[nombre_fact]','$_GET[observacion_fact]','$_GET[fecha_fact]','$_GET[monto_fact]','$_GET[tipogasto_fact]')";
		$sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: ".mysql_error());
		?>
		<script>
		alert("Factura Ingresada");</script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("La factura <?php echo $_GET[observacion_fact] ?> codigo <?php echo $_GET[codigo_fact] ?> se registro la fecha <?php echo $_GET[fecha_fact] ?> por un monto de <?php echo $_GET[monto_fact] ?>  ");
        </script>
		<?php
	}	
		
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
#cuerpofacturatrabajador
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/trabajador/factura_trabajador" />
<fieldset id="cuerpofacturatrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>INCLUIR FACTURA TRABAJADOR</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
    <td width="31%"><strong>Codigo</strong></td>
    <td width="69%"><input name="codigo_fact" type="text" id="codigo_fact" style="width:98%; height:auto" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Institucion/Farmacia/Médico</strong></td>
    <td>
      <input name="nombre_fact" type="text" id="nombre_fact" style="width:98%" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Observacion</strong></td>
    <td>
    <label for="observacion_fact"></label>
      <textarea name="observacion_fact" id="observacion_fact" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td><strong>Fecha</strong></td>
    <td>
      <input type="text" name="fecha_fact" id="fecha_trab" style="width:98%"  /></td>
  </tr>
  <tr>
    <td><strong>Monto</strong></td>
    <td>
      <input type="text" name="monto_fact" id="monto_fact" style="width:98%"  /></td>
  </tr>
 <tr>
    <td><strong>Tipo de Gasto</strong></td>
    <td>
      <select name="tipogasto_fact" id="tipogasto_fact" style="width:99%">
        <option value="0">Escoja tipo de Gasto</option>
        <option value="1">Medicinas/Odontologia</option>
        <option value="2">Lentes</option>
        <option value="3">Protesis</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_fact" id="enviar_fact" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>