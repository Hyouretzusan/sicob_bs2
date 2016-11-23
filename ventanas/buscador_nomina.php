<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_POST);
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
<form name="inserta" id="inserta" method="post" onSubmit = "return verifica(this)"  action="ventanas/puente_nomina.php" target="_blank">

<fieldset id="cuerpobuscador" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>NOMINA</strong></legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
  <td align="center">Usuario</td>
    <td width="47%" align="center"><input name="analista" type="text" id="analista" style="width:98%;height:100%" size="20" required="required" /></td>
      </tr>

  <tr>
  <td align="center">Beneficio</td>
    <td width="47%" align="center"><select name="gasto" id="gasto" style="width:98%">
        <option value="0">Gasto</option>
        <option value="Medicinas">Medicinas</option>
        <option value="Odontologia">Odontologia</option>
        <option value="Lentes">Lentes</option>
        <option value="Protesis">Protesis</option>
        <option value="Todas">Todas</option>
     
      </select></td>
      </tr>
      <tr>
      <td align="center">Dependencia</td>
        <td width="47%" align="center"><select name="dependencia" id="dependencia" style="width:98%">
        <option value="0">Dependencia</option>
        <option value="Obrero">Obrero</option>
        <option value="Contratado Obrero">Contratado Obrero</option>
        <option value="Especifico">Especifico</option>
        <option value="Contratado Especifico">Contratado Especifico</option>
        <option value="Centralizado">Centralizado</option>
        <option value="Contratado Centralizado">Contratado Centralizado</option>
      </select>
    </td>
	</tr>
    <tr>
    <td align="center">Mes</td>
     <td width="33%" align="center"><select name="mes" id="mes" style="width:98%">
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
      </tr>
      <tr>
      <td align="center">A&ntilde;o
  </td>
       <td width="20%">
      <input name="anio" type="text" id="anio" style="width:98%" size="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="required" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="middle">
      <input type="submit" name="buscar" id="buscar" value="Descargar" onclick="" />
    </td>
    </tr>
 </table>
</fieldset></form>
<br>
<br>
<br>
</center>
 
 