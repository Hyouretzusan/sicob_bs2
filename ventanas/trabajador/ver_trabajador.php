<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

/* if(isset($_GET['enviar_modtrab']))
	{ */
		$cedulatrab= $_GET['cedula'];
		$stringvertrabajador="SELECT * from trabajador WHERE cedula_trab = '".$cedulatrab."'";
		$sqlvertrabajador=mysql_query($stringvertrabajador) or die ("ERROR: ".mysql_error());
		$infot = mysql_fetch_array($sqlvertrabajador);
		/* ?>
		<script>
		alert("Trabajador Actualizado");</script>
		<?php */
	/* } */

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
<input name="sec" type="hidden" value="ventanas/trabajador/ver_trabajador" />
<fieldset id="cuerpomodificartrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>DATOS TRABAJADOR</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
   <tr>
    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula_anterior" type="text" id="cedula_anterior" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['cedula']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <!--<td width="31%">&nbsp;</td>-->
    <!--<td width="69%"><input name="cedula_trab" type="text" id="cedula_trab" style="width:98%;height:100%" size="20" /></td>-->
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_trab" type="text" id="apellido_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['apellido_trab']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td>
      <input type="text" name="nombre_trab" id="nombre_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['nombre_trab']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td><strong>Sexo</strong></td>
    <td>
      <input type="text" name="sexo_trab" id="sexo_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['sexo_trab']?>" size="20" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ingreso</strong></td>
    <td>
      <input name="fecing_trab" type="date" id="fecing_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['fecing_trab']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td><strong>Cargo</strong></td>
    <td>
      <input type="text" name="cargo_trab" id="cargo_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['cargo_trab']?>" size="20" readonly="readonly"  /></td>
  </tr>
 <tr>
    <td><strong>Dependencia</strong></td>
    <td>
      <input type="text" name="dependencia_trab" id="dependencia_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['dependencia_trab']?>" size="20" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td>
      <input type="text" name="codigo_trab" id="codigo_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['codigo_trab']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento</strong></td>
    <td>
      <input name="fecnac_trab" type ="date" id="fecnac_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['fecnac_trab']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <a href="?sec=ventanas/carga_familiar&cedula=<?php echo $infot['cedula_trab']; ?>">Menu Anterior</a>
    </td>
    </tr>
 </table>
</fieldset></form></center>