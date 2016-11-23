<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET['enviar_modtrab']))
	{
		$cedulavieja= $_GET['cedula_anterior'];
		$stringinfovieja= mysql_query("select * from trabajador where cedula_trab = '".$cedulavieja."'");
		$infovieja= mysql_fetch_array($stringinfovieja);
		
		$stringmodificartrabfact="UPDATE factura_trab SET cedula_trab = '$_GET[cedula_trab]' WHERE factura_trab.cedula_trab = '$cedulavieja' AND factura_trab.cedula_fact = '$cedulavieja'";
		$sqlmodificartrabfact=mysql_query($stringmodificartrabfact) or die ("ERROR: Linea 10".mysql_error());
		$stringmodificartrabfam="UPDATE familiar SET cedula_trab = '$_GET[cedula_trab]' WHERE familiar.cedula_trab = '$cedulavieja'";
		$sqlmodificartrabfam=mysql_query($stringmodificartrabfam) or die ("ERROR: Linea 12".mysql_error());
		$stringmodificartrabajador="UPDATE trabajador SET cedula_trab = '$_GET[cedula_trab]', apellido_trab = '$_GET[apellido_trab]', nombre_trab = '$_GET[nombre_trab]', sexo_trab = '$_GET[sexo_trab]', fecing_trab = '$_GET[fecing_trab]', cargo_trab = '$_GET[cargo_trab]', dependencia_trab = '$_GET[dependencia_trab]', codigo_trab = '$_GET[codigo_trab]', fecnac_trab = '$_GET[fecnac_trab]', numero_cuenta = '$_GET[numero_cuenta]' WHERE trabajador.cedula_trab = '$cedulavieja'";
		$sqlmodificartrabajador=mysql_query($stringmodificartrabajador) or die ("ERROR: Linea 14".mysql_error());
		
		?>
		<script>
		alert("Trabajador Modificado Exitosamente");</script>
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
#cuerpomodificartrabajador
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/trabajador/modificar_trabajador" />
<fieldset id="cuerpomodificartrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>MODIFICAR TRABAJADOR</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
   <tr>
    <td width="31%"><strong>Cedula Anterior</strong></td>
    <td width="69%"><input name="cedula_anterior" type="text" id="cedula_anterior" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['cedula']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Cedula Nueva</strong></td>
    <td width="69%"><input name="cedula_trab" type="text" maxlength="11" id="cedula_trab" style="width:98%;height:100%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_trab" type="text" maxlength="40" id="apellido_trab" style="width:98%" size="20" required="required"  /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td>
      <input type="text" maxlength="40" name="nombre_trab" id="nombre_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Sexo</strong></td>
    <td>
      <select name="sexo_trab" id="sexo_trab" style="width:99%">
        <option value="0">Seleccione Sexo</option>
        <option value="Femenino">Femenino</option>
        <option value="Masculino">Masculino</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ingreso</strong></td>
    <td>
      <input name="fecing_trab" type="date" id="fecing_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Cargo</strong></td>
    <td>
      <input type="text" maxlength="50" name="cargo_trab" id="cargo_trab" style="width:98%" required="required" /></td>
  </tr>
 <tr>
    <td><strong>Dependencia</strong></td>
    <td>
      <select name="dependencia_trab" id="dependencia_trab" style="width:99%">
        <option value="0">Seleccione Dependencia</option>
        <option value="Especifico">Especifico</option>
        <option value="Contratado Especifico">Contratado Especifico</option>
        <option value="Obrero">Obrero</option>
        <option value="Contratado Obrero">Contratado Obrero</option>
        <option value="Centralizado">Centralizado</option>
        <option value="Contratado Centralizado">Contratado Centralizado</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td>
      <input type="text" maxlength="20" name="codigo_trab" id="codigo_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento</strong></td>
    <td>
      <input name="fecnac_trab" type ="date" id="fecnac_trab" style="width:98%" required="required"  /></td>
  </tr>
 
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_modtrab" id="enviar_modtrab" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>