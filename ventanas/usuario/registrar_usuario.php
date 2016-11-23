<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

if(isset($_GET['enviar_usuario']))
	{
	$salida=false;
	
	$revisarsiencuentra=mysql_query("select * from usuario order by nombre_usuario");

	$cantidadtasarevision=mysql_num_rows($revisarsiencuentra);
	
	for($j=1;$j<=$cantidadtasarevision;$j++)
	{
		$campousuario=mysql_fetch_array($revisarsiencuentra);
		$usuario=$campousuario['nick_usuario'];
		$nombre_usuario=$campousuario['nombre_usuario'];
		
		if(($usuario==$_GET['nick_usuario']) or ($nombre_usuario==$_GET['nombre_usuario']))
		{
			$salida=true;
		}
	}
		if($salida==false)
	{
		$stringingresarusuario="insert into usuario (nombre_usuario, apellido_usuario, nick_usuario, clave_usuario, tipo_usuario) values ('$_GET[nombre_usuario]','$_GET[apellido_usuario]','$_GET[nick_usuario]','$_GET[clave_usuario]','$_GET[tipo_usuario]')";
		$sqlingresarusuario=mysql_query($stringingresarusuario) or die ("ERROR: ".mysql_error());
		?>
		<script>
		alert("Usuario Registrado");</script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("El usuario <?php echo $_GET['nick_usuario'] ?> y/o nombre <?php echo $_GET['nombre_usuario'] ?> ya se encuentran registrados");
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
#cuerpoagregarusuario
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/usuario/registrar_usuario" />
<fieldset id="cuerpoagregarusuario" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>REGISTRAR USUARIO</strong>
 
 </legend>
 
 <table width="60%" border="0" id="cuadro">
  <tr>
    <td width="31%"><strong>Nombre</strong></td>
    <td width="69%"><input name="nombre_usuario" maxlength="20" type="text" id="nombre_usuario" style="width:98%;height:100%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_usuario" maxlength="20" type="text" id="apellido_usuario" style="width:98%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Nick de Usuario</strong></td>
    <td>
      <input name="nick_usuario" maxlength="20" type="text" id="nick_usuario" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Contrase&ntilde;a</strong></td>
    <td>
      <input type="password" maxlength="20" name="clave_usuario" id="clave_usuario" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Tipo de Usuario</strong></td>
    <td>
      <select name="tipo_usuario" id="tipo_usuario" style="width:99%">
        <option value="0">Seleccione tipo de Usuario</option>
        <option value="Administrador">Administrador</option>
        <option value="Limitado">Limitado</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_usuario" id="enviar_usuario" value="Enviar" />
    </td>
    </tr>
 </table>
 </fieldset> </form>  </center>