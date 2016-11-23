

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
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<fieldset id=cuerpoañadirusuario>

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#000" align="center"><strong>AÑADIR USUARIO</strong>
 
 </legend>
 <table width="100%" border="1" id="cuadro">
  <tr>
    <td width="24%">Nombre</td>
    <td width="76%"><label for="añadir_nombre"></label>
      <input type="text" name="añadir_nombre" id="añadir_nombre" style="width:100%" /></td>
  </tr>
  <tr>
    <td>Apellido</td>
    <td><label for="añadir_apellido"></label>
      <input type="text" name="añadir_apellido" id="añadir_apellido" style="width:100%" /></td>
  </tr>
  <tr>
    <td>Nick de Usuario</td>
    <td><label for="añadir_nick"></label>
      <input type="text" name="añadir_nick" id="añadir_nick" style="width:100%" /></td>
  </tr>
  <tr>
    <td>Contraseña</td>
    <td><label for="añadir_contraseña" ></label>
      <input type="text" name="añadir_contraseña" id="añadir_contraseña" style="width:100%"  /></td>
  </tr>
  <tr>
    <td>Tipo de Usuario</td>
    <td><label for="añadir_tipousuario"></label>
      <input type="text" name="añadir_tipousuario" id="añadir_tipousuario"style="width:100%"  /></td>
  </tr>
</table>

 
 
 
 
 
 
 </fieldset> </form>  </center>