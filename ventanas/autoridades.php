<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET['mod_autoridad'])) 
{
	
	
	$stringmodificarautoridad="UPDATE autoridades SET nombre_autoridades = '$_GET[nombre_autoridades]' WHERE id_autoridades = '$_GET[id_autoridades]'";
		$sqlmodificarautoridad = mysql_query($stringmodificarautoridad) or die ("ERROR: linea 11 ".mysql_error());
			?>
		<script>
		alert("Autoridades Actualizadas");</script>
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
<input name="sec" type="hidden" value="ventanas/autoridades" />
<fieldset id="cuerpomodificarautoridad" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>AUTORIDADES</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
   
  <tr>
    <td width="31%"><strong>Autoridad</strong></td>
    <td width="69%"><select name="id_autoridades" id="id_autoridades" style="width:99%">
        <option value="0">Seleccione Autoridad</option>
        <option value="1">Director</option>
        <option value="2">Jefe de Personal</option>
        <option value="3">Administrador</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Nombre Completo</strong></td>
    <td>
      <input type="text" maxlength="50" name="nombre_autoridades" id="nombre_autoridades" style="width:98%" required="required" /></td>
  </tr>
 
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="mod_autoridad" id="mod_autoridad" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>