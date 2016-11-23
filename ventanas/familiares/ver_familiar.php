<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

/* if(isset($_GET['enviar_modtrab']))
	{ */
		$cedulafam= $_GET['cedula'];
		$stringverfamiliar="SELECT * from familiar WHERE cedula_fam = '".$cedulafam."'";
		$sqlverfamiliar=mysql_query($stringverfamiliar) or die ("ERROR: Linea 10".mysql_error());
		$infot = mysql_fetch_array($sqlverfamiliar);
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
<input name="sec" type="hidden" value="ventanas/familiares/ver_familiar" />
<fieldset id="cuerpomodificartrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>DATOS FAMILIAR</strong>
 
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
      <input name="apellido_fam" type="text" id="apellido_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['apellido_fam']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td>
      <input type="text" name="nombre_fam" id="nombre_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['nombre_fam']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td><strong>Sexo</strong></td>
    <td>
      <input type="text" name="sexo_fam" id="sexo_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['sexo_fam']?>" size="20" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><strong>Parentesco</strong></td>
    <td>
      <input name="parentesco_fam" type="text" id="parentesco_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['parentesco_fam']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td><strong>Patologia</strong></td>
    <td>
      <input type="text" name="patologia_fam" id="patologia_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['patologia_fam']?>" size="20" readonly="readonly"  /></td>
  </tr>
 <tr>
    <td><strong>Discapacidad</strong></td>
    <td>
      <input type="text" name="discapacidad_fam" id="discapacidad_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['discapacidad_fam']?>" size="20" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td>
      <input type="text" name="codigo_fam" id="codigo_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['codigo_fam']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento</strong></td>
    <td>
      <input name="fecnac_fam" type ="date" id="fecnac_fam" style="width:98%;height:100%;background:#FF9" value="<?php echo $infot['fecnac_fam']?>" size="20" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <a href="?sec=ventanas/carga_familiar&cedula=<?php echo $infot['cedula_trab']; ?>">Menu Anterior</a>
    </td>
    </tr>
 </table>
</fieldset></form></center>