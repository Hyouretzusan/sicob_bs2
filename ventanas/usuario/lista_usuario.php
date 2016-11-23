<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

	if(isset($_GET['usuario1']))
	{ 
	
	$stringeliminarusuario = mysql_query("delete from usuario where usuario.nick_usuario = '$_GET[usuario1]' ") or die ("Error Linea 16 ".mysql_error());		
		?>
        
		<script>
		alert("Usuario Eliminado");
	</script>
		
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
#cuerpoconsumos
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/usuario/lista_usuario" />
<fieldset id="cuerpolista" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>LISTA DE USUARIOS</strong>
 
 	<?php

$stringbuscarusu= "select * from usuario order by nombre_usuario";
$sqlbuscarusu=mysql_query($stringbuscarusu) or die ("Error linea 57 ".mysql_error());
$cuadrosbuscarusu=mysql_num_rows($sqlbuscarusu);
 
 if ($cuadrosbuscarusu > 0)
	{?>
    
    <br/>
</legend><table width="750" border="1" align="center">
  <tr>
    <td align="center">Nombre</td>
    <td align="center">Apellido</td>
    <td align="center">Nick de Usuario</td>
    <td align="center">Tipo de Usuario</td>
    <td align="center">Modificar Usuario</td>
    <td align="center">Eliminar Usuario</td>
   
  </tr>
  
  <?php for ($c=1; $c<=$cuadrosbuscarusu;$c++)
	{
		$infousu=mysql_fetch_array($sqlbuscarusu);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infousu['nombre_usuario']; ?></td>
    <td align="center" valign="middle"><?php echo $infousu['apellido_usuario']; ?></td>
    <td align="center" valign="middle"><?php echo $infousu['nick_usuario']; ?></td>
    <td align="center" valign="middle"><?php echo $infousu['tipo_usuario']; ?></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/usuario/modificar_usuario&usuario=<?php echo $infousu['nick_usuario']; ?>" title="Modificar informacion de <?php echo $infousu['nick_usuario']; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"> <a href="javascript:decision('¿Esta realmente Seguro(a) de eliminar este usuario?',
'?sec=ventanas/usuario/lista_usuario&usuario1=<?php echo $infousu['nick_usuario']; ?>')" title="Eliminar a <?php echo $infousu['nick_usuario']; ?>">Eliminar</a>
    </td>
  </tr>
  <?php }?>
  
  </table>
  
<?php } else if($cuadrosbuscarusu == 0) { ?>
		<script>
		alert("No existen usuarios registrados en el sistema. Consulte al Departamento de Informatica");</script>
        <?php }?>	


</fieldset></form>
</center>