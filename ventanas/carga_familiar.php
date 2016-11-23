 <?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);
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
#cuerpocarga
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/carga_familiar" />
<fieldset id="cuerpocarga" style="background-color:#FFF; width:500px">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>CARGA FAMILIAR</strong></legend>
 
 

 <br />
 <br />
 <?php 

	
$stringbuscartrab="select * from trabajador where cedula_trab = '$_GET[cedula]' ";
$sqlbuscartrab=mysql_query($stringbuscartrab) or die ("Error: linea 41 ".mysql_error());
$cuadrosbuscartrab=mysql_num_rows($sqlbuscartrab);

$stringbuscarfam="select * from familiar where cedula_trab = '$_GET[cedula]'";
$sqlbuscarfam=mysql_query($stringbuscarfam) or die ("Error: linea 45 ".mysql_error());

$cuadrosbuscarfam=mysql_num_rows($sqlbuscarfam);
	
 if ($cuadrosbuscartrab > 0 or $cuadrosbuscarfam > 0)
 	{?>
<table width="750" border="1" align="center">
  <tr>
    <td width="44" align="center">Cedula</td>
    <td width="53" align="center">Nombre</td>
    <td width="53" align="center">Apellido</td>
    <td width="47" align="center">Codigo</td>
    <td width="78" align="center">Parentesco</td>
    
    
    <td width="90" align="center" valign="middle"><p>Informacion Completa</p></td>
    <td width="78" align="center">Modificar</td>
    <td width="78" align="center">Medicinas</td>
    <td width="78" align="center">Odontologia</td>
    <td width="78" align="center">Lentes</td>
    <td width="78" align="center">Protesis</td>
    </tr>
  
  <?php for ($a=1; $a<=$cuadrosbuscartrab;$a++)
	{
		$infot=mysql_fetch_array($sqlbuscartrab);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infot['cedula_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['nombre_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['apellido_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['codigo_trab']; ?></td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/ver_trabajador&cedula=<?php echo $infot['cedula_trab']; ?>" title="Verificar informacion de <?php echo $infot['cedula_trab']; ?>">Ver Datos</a></td>
    <td align="center" valign="middle"><a href="?sec=ventanas/trabajador/modificar_trabajador&cedula=<?php echo $infot['cedula_trab']; ?>" title="Modificar informacion de <?php echo $infot['cedula_trab']; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><?php echo $infot['salmed_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['salmedod_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['sallen_trab']; ?></td>
    <td align="center" valign="middle"><?php echo $infot['salprot_trab']; ?></td>
    </tr>
  <?php }?>
   <?php for ($b=1; $b<=$cuadrosbuscarfam;$b++)
	{
		$infof=mysql_fetch_array($sqlbuscarfam);
		
		 ?>
  <tr>
    <td align="center" valign="middle"><?php echo $infof['cedula_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['nombre_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['apellido_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['codigo_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['parentesco_fam']; ?></td>
    
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/ver_familiar&cedula=<?php echo $infof['cedula_fam']; ?>" title="Verificar informacion de <?php echo $infof['cedula_fam']; ?>">Ver Datos</a></td>
    
    <td align="center" valign="middle"><a href="?sec=ventanas/familiares/modificar_familiar&cedula=<?php echo $infof['cedula_fam']; ?>" title="Modificar informacion de <?php echo $infof['cedula_fam']; ?>">Editar Datos</a></td>
    <td align="center" valign="middle"><?php echo $infof['salmed_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['salmedod_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['sallen_fam']; ?></td>
    <td align="center" valign="middle"><?php echo $infof['salprot_fam']; ?></td>
    </tr>
  <?php }?>
</table>
<?php } else if($cuadrosbuscartrab == 0 and $cuadrosbuscarfam == 0 ) { ?>
		<script>
		alert("La Carga Familiar solicitada no se encuentra registrada en el sistema");</script>
        <?php }?>	
        
   </fieldset></form>
<br>
<br>
<br>
</center>