<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET[enviar_facf]))
	{
	$salida=false;
	
	$revisarsiencuentra=mysql_query("select * from factura_fam order by codigo_facf");
	$cantidadtasarevision=mysql_num_rows($revisarsiencuentra);
	
	for($j=1;$j<=$cantidadtasarevision;$j++)
	{
		$campofact=mysql_fetch_array($revisarsiencuentra);
		$codigo_facf=$campofacf['codigo_facf'];
		$fecha_facf=$campofacf['fecha_facf'];
		$nombre_facf=$campofacf['nombre_facf'];
		
		if(($codigo_facf==$_GET[codigo_facf]) or ($nombre_facf==$_GET[nombre_facf]))
		{
			$salida=true;
		}
	}
		if($salida==false)
	{
		$stringfacturafamiliar="insert into factura_fam (codigo_facf, nombre_facf, observacion_facf, fecha_facf, monto_facf, tipogasto_facf) values ('$_GET[codigo_facf]','$_GET[nombre_facf]','$_GET[observacion_facf]','$_GET[fecha_facf]','$_GET[monto_facf]','$_GET[tipogasto_facf]')";
		$sqlfacturafamiliar=mysql_query($stringfacturafamiliar) or die ("ERROR: ".mysql_error());
		?>
		<script>
		alert("Factura Ingresada");</script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("La factura <?php echo $_GET[observacion_facf] ?> codigo <?php echo $_GET[codigo_facf] ?> se registro la fecha <?php echo $_GET[fecha_facf] ?> por un monto de <?php echo $_GET[monto_facf] ?>  ");
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
#cuerpofacturafamiliar
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/familiares/factura_familiar" />
<fieldset id="cuerpofacturafamiliar" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>INCLUIR FACTURA FAMILIAR</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
    <td width="31%"><strong>CEDULA FAMILIAR</strong></td>
    <td width="69%"><input name="CEDULA" type="text" id="CEDULA" style="width:98%; height:auto" size="20" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Codigo</strong></td>
    <td width="69%"><input name="codigo_facf" type="text" id="codigo_fact" style="width:98%; height:auto" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Institucion/Farmacia/Medico</strong></td>
    <td>
      <input name="nombre_facf" type="text" id="nombre_facf" style="width:98%" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Observacion</strong></td>
    <td>
    <label for="observacion_facf"></label>
      <textarea name="observacion_facf" id="observacion_facf" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td><strong>Fecha</strong></td>
    <td>
      <input type="date" name="fecha_facf" id="fecha_fam" style="width:98%"  /></td>
  </tr>
  <tr>
    <td><strong>Monto</strong></td>
    <td>
      <input type="text" name="monto_facf" id="monto_facf" style="width:98%"  /></td>
  </tr>
 <tr>
    <td><strong>Tipo de Gasto</strong></td>
    <td>
      <select name="tipogasto_facf" id="tipogasto_facf" style="width:99%">
        <option value="0">Escoja tipo de Gasto</option>
        <option value="1">Medicinas/Odontologia</option>
        <option value="2">Lentes</option>
        <option value="3">Protesis</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_facf" id="enviar_facf" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>