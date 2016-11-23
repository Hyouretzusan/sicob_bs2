<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET['editar_usuario']))
	{
	    $usuarioviejo= $_GET['nick_anterior'];
		$stringmodificarusuario="update usuario set nombre_usuario = '$_GET[nombre_usuario]', apellido_usuario = '$_GET[apellido_usuario]', tipo_usuario = '$_GET[tipo_usuario]', nick_usuario = '$_GET[nick_usuario]' where nick_usuario = '$usuarioviejo'";
		$sqlmodificarusuario=mysql_query($stringmodificarusuario) or die ("Error Linea 10 ".mysql_error());
		?>
		<script>
		alert("Usuario Actualizado"); 
		window.history.go(-2);</script>
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
#cuerpoagregarusuario
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/usuario/modificar_usuario" />
<fieldset id="cuerpomodificarusuario" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>MODIFICAR USUARIO</strong>
 
 </legend>
 
 <table width="60%" border="0" id="cuadro">
 <tr>
    <td><strong>Nick Anterior</strong></td>
    <td>
      <input name="nick_anterior" type="text" id="nick_anterior" value="<?php echo $_GET['usuario']?>" style="width:98%; background:#FF9" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Nombre</strong></td>
    <td width="69%"><input name="nombre_usuario" maxlength="20" type="text" id="nombre_usuario" style="width:98%;height:100%" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_usuario" maxlength="20" type="text" id="apellido_usuario" style="width:98%" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Nick de Usuario</strong></td>
    <td>
      <input name="nick_usuario" maxlength="20" type="text" id="nick_usuario" style="width:98%" /></td>
  </tr>
  <tr>
    <td><strong>Contrase&ntilde;a</strong></td>
    <td>
      <input type="password" maxlength="20" name="clave_usuario" id="clave_usuario" style="width:98%"  /></td>
  </tr>
  <tr>
    <td><strong>Tipo de Usuario</strong></td>
    <td>
      <select name="tipo_usuario" id="tipo_usuario" style="width:99%">
        <option value="0">Escoja tipo de Usuario</option>
        <option value="Administrador">Administrador</option>
        <option value="Limitado">Limitado</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="editar_usuario" id="editar_usuario" value="Enviar" />
    </td>
    </tr>
 </table>
 </fieldset> </form>  </center>