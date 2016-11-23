<?php 
$msj=$_GET['msj'];
if($msj=="no_password")
{
	$redir="inicio_sesion.php";
	$aviso="Contraseña no coincide...";
	?>
    <script>
confirm('HASTA LA VISTA BABY');
</script>
    <?php
}
if($msj=="no_usu")
{
	$redir="inicio_sesion.php";
	$aviso="Usuario Invalido...";
}
if($msj=="ok")
{
	$redir="index.php";
	$aviso="Hasta Pronto";
}
?><HEAD>
<META HTTP-EQUIV="Refresh" CONTENT="4; URL=<?php echo $redir; ?>">
</HEAD>

<br />
<br />
<br />
<br />
<table width="200" border="0" align="center">
  <tr>
    <td align="center"><?php if ($msj=="ok") {?><img src="multimedia/ok.png" width="286" height="205" /><?php } else { ?><img src="multimedia/denegado.png" width="150" height="180"/> <?php } ?></td>
  </tr>
  <tr>
   <td align="center"><?php echo $aviso; ?></td>
  </tr>
  <tr>
    <td align="center"><a href="<?php echo $redir; ?>">&gt;&gt;continuar&lt;&lt;</a></td>
  </tr>
</table>
