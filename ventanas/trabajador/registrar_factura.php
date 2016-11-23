<?php 
include("bdd/funciones_mysql.php");
conectar();
include ("ventanas/limite_edad3.php");

extract ($_GET);

if(isset($_GET['parentesco']) and $_GET['parentesco'] == 'Hijo/a')
{$visibilidad = 'block';}
if(isset($_GET['parentesco']) and $_GET['parentesco'] != 'Hijo/a')
{$visibilidad = 'none';}


if(isset($_GET['enviar_fact']))
	{
	$salida=false;
	
	$revisarfactura=mysql_query("select * from factura_trab where codigo_fact = '$_GET[codigo_fact]'");
	
	$existefactura=mysql_num_rows($revisarfactura);
	
	/* for($j=1;$j<=$existefactura;$j++)
	{
		$campofact=mysql_fetch_array($revisarfactura);
		$codigo_fact=$revisarcodigo['codigo_fact'];
		$fecha_fact=$revisarfactura['nombre_fact']; */
		
		/* if(($codigo_fact==$_GET[codigo_fact]) and ($nombre_fact==$_GET[nombre_fact])) */
		
		if (($existefactura>=1))
		{
			$salida=true;
		}
		else if (($existefactura==0))
		{
			$salida=false;
		}
		if($salida==false)
	{
		if($_GET['identificador'] == 'Familiar')
{$sqlfam = mysql_query("select cedula_trab from familiar where cedula_fam ='$_GET[cedula1]'");
	$consultafam = mysql_fetch_array($sqlfam);
	$cedula_nomina = $consultafam['cedula_trab'];}
	
		else if($_GET['identificador'] == 'Trabajador')
{$cedula_nomina = $_GET['cedula1']; }
		
		$stringfacturatrabajador="insert into factura_trab (identificador, codigo_fact, nombre_fact, observacion_fact, fecha_fact, monto_fact, tipogasto_fact, cedula_fact, cedula_trab, apellido_fact, dependencia_fact) values ('$_GET[identificador]','$_GET[codigo_fact]','$_GET[nombre_fact]','$_GET[observacion_fact]','$_GET[fecha_fact]','$_GET[monto_fact]','$_GET[tipogasto_fact]','$_GET[cedula1]','".$cedula_nomina."', '$_GET[dependencia_nomina]', '$_GET[dependencia_nomina]')";
	}
	else if ($salida==true)
	{
		?>
		<script>
		alert("La factura <?php echo $_GET['codigo_fact'] ?> se encuentra registrada en el sistema");
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
#cuerpofacturatrabajador
{
	width:auto
}
</style>

<?php 
		$resta = 0;
	if ($_GET['identificador'] == "Trabajador") 
	{	$resta = $_GET['monto_fact'];
		$cedula1 = $_GET['cedula1'];
	
		if  ($_GET['tipogasto_fact'] == "Medicinas")
		{ $consultasalmed = mysql_query("select salmed_trab from trabajador where cedula_trab = '".$cedula1."'");
		$salmed = mysql_fetch_array($consultasalmed);
		
		  $salmedresta = $salmed['salmed_trab'] - $resta;
		  
		  if ($salmedresta < 0)
		  { 
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php  		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 103 ".mysql_error());
		  $restarsalmed = "UPDATE trabajador SET salmed_trab = '".$salmedresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalmed = mysql_query($restarsalmed) or die ("ERROR: Linea 105 ".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Odontologia")
		{ $consultasalmedod = mysql_query("select salmedod_trab from trabajador where cedula_trab = '".$cedula1."'");
		$salmedod = mysql_fetch_array($consultasalmedod);
		
		  $salmedodresta = $salmedod['salmedod_trab'] - $resta;
		  
		  if ($salmedodresta < 0)
		  { 
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php  		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 127".mysql_error());
		  $restarsalmedod = "UPDATE trabajador SET salmedod_trab = '".$salmedodresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalmedod = mysql_query($restarsalmedod) or die ("ERROR: Linea 129".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Lentes")
		{ $consultasallen = mysql_query("select sallen_trab from trabajador where cedula_trab = '".$cedula1."'");
		$sallen = mysql_fetch_array($consultasallen);
		  $sallenresta = $sallen['sallen_trab'] - $resta;
		  
		  if ($sallenresta < 0)
		  { 
		    ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php 		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 150".mysql_error());
		  $restarsallen = "UPDATE trabajador SET sallen_trab = '".$sallenresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsallen = mysql_query($restarsallen) or die ("ERROR: Linea 152".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Protesis")
		{ $consultasalprot = mysql_query("select salprot_trab from trabajador where cedula_trab = '".$cedula1."'");
		$salprot = mysql_fetch_array($consultasalprot);
		  $salprotresta = $salprot['salprot_trab'] - $resta;
		  
		  if ($salprotresta < 0)
		  { 
		    ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php 		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: ".mysql_error());
		  $restarsalprot = "UPDATE trabajador SET salprot_trab = '".$salprotresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalprot = mysql_query($restarsalprot) or die ("ERROR: ".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  
		  	}
		}
	}
	
	if ($_GET['identificador'] == "Familiar") 
{	$resta = $_GET['monto_fact'];
		$cedula1 = $_GET['cedula1'];
	
		if  ($_GET['tipogasto_fact'] == "Medicinas")
		{ $consultasalmed = mysql_query("select salmed_fam from familiar where cedula_fam = '".$cedula1."'");
		$salmed = mysql_fetch_array($consultasalmed);
		
		  $salmedresta = $salmed['salmed_fam'] - $resta;
		  
		  if ($salmedresta < 0)
		  { 
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php  		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 204".mysql_error());
		  $restarsalmed = "UPDATE familiar SET salmed_fam = '".$salmedresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalmed = mysql_query($restarsalmed) or die ("ERROR: Linea 206".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Odontologia")
		{ $consultasalmedod = mysql_query("select salmedod_fam from familiar where cedula_fam = '".$cedula1."'");
		$salmedod = mysql_fetch_array($consultasalmedod);
		
		  $salmedodresta = $salmedod['salmedod_fam'] - $resta;
		  
		  if ($salmedodresta < 0)
		  { 
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php  		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 228".mysql_error());
		  $restarsalmedod = "UPDATE familiar SET salmedod_fam = '".$salmedodresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalmedod = mysql_query($restarsalmedod) or die ("ERROR: Linea 230".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Lentes")
		{ $consultasallen = mysql_query("select sallen_fam from familiar where cedula_fam = '".$cedula1."'");
		$sallen = mysql_fetch_array($consultasallen);
		  $sallenresta = $sallen['sallen_fam'] - $resta;
		  
		  if ($sallenresta < 0)
		  { 
		    ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php 		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 251".mysql_error());
		  $restarsallen = "UPDATE familiar SET sallen_fam = '".$sallenresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsallen = mysql_query($restarsallen) or die ("ERROR: Linea 253".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  	}
		}
		if  ($_GET['tipogasto_fact'] == "Protesis")
		{ $consultasalprot = mysql_query("select salprot_fam from familiar where cedula_fam = '".$cedula1."'");
		$salprot = mysql_fetch_array($consultasalprot);
		  $salprotresta = $salprot['salprot_fam'] - $resta;
		  
		  if ($salprotresta < 0)
		  { 
		    ?>
		<script>
		alert("Ha alcanzado el monto maximo");</script>
		<?php 		  
		   }
		  else
		  	{
		  $sqlfacturatrabajador=mysql_query($stringfacturatrabajador) or die ("ERROR: Linea 274".mysql_error());
		  $restarsalprot = "UPDATE familiar SET salprot_fam = '".$salprotresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalprot = mysql_query($restarsalprot) or die ("ERROR: Linea 276".mysql_error());
		  ?>
		<script>
		alert("Factura Registrada");</script>
		<?php
		  
		  	}
		}
	}
	?>
    <center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/trabajador/registrar_factura" />

<input name="cedula" type="hidden" value="<?php echo $_GET['cedula']?>" />
<input name="nombre" type="hidden" value="<?php echo $_GET['nombre']?>" />
<input name="apellido" type="hidden" value="<?php echo $_GET['apellido']?>" />


<fieldset id="cuerpofacturatrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>REGISTRAR FACTURA</strong></legend>
 
 <table width="50%" border="0" id="cuadro">
 
 <tr>
 
    <td colspan="2"><strong></strong>
      <table width="600" border="0">
        <tr>
          
     <td align="center" valign="middle"><a href="?sec=ventanas/consumos&cedula=<?php echo $_GET['cedula']; ?>" title="Revisar Facturas de <?php echo $infot['cedula_trab']; ?>">Ir a Consumos</a></td>
     
        </tr>
    </table></td>
    </tr>
 
   <tr>
     <td colspan="2"><div id="uno" style="display:<?php echo $visibilidad ?>;"><table width="100%" border="0">
       <tr>
   <td width="32%" align="center"><strong style="text-decoration:blink; color:#880000"><?php echo $cualquiera = limite_edad3($_GET['cedula']); ?></strong></td>
 </tr>
     </table></div></td>
     </tr>
 <tr>

    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula1" type="text" id="cedula1" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['cedula']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Nombre</strong></td>
    <td width="69%"><input name="" type="text" id="" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['nombre']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Apellido</strong></td>
    <td width="69%"><input name="" type="text" id="" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['apellido']?>" size="20" readonly="readonly" /></td>
  </tr>
   <tr>
    <td width="31%"><strong>Dependencia</strong></td>
    <td width="69%"><input name="dependencia_nomina" type="text" id="dependencia_nomina" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['dependencia']?>" size="20" readonly="readonly" /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="right"><table width="60%" border="0" >
      <tr>
        <td align="center" valign="middle" width="25%"><strong>Medicinas</strong></td>
        <td align="center" valign="middle" width="25%"><strong>Odontologia</strong></td>
        <td align="center" valign="middle" width="25%"><strong>Lentes</strong></td>
        <td align="center" valign="middle" width="25%"><strong>Protesis</strong></td>
      
      <?php 	
	  if (isset ($_GET['cedula']))
	  {$enviarcedula = $_GET['cedula'];}
	  
	  else if  ($_GET['cedula1'])
	  {$enviarcedula = $_GET['cedula1'];}
	  
		 $buscarsaldotrab = mysql_query("select * from trabajador where cedula_trab = '".$enviarcedula."'");
		 $haysaldotrab = mysql_num_rows($buscarsaldotrab);
		 
		 if ($haysaldotrab > 0)
		{$mostrarsaldotrab = mysql_fetch_array($buscarsaldotrab);}
		
		 $buscarsaldofam = mysql_query("select * from familiar where cedula_fam = '".$enviarcedula."'");
		 $haysaldofam = mysql_num_rows($buscarsaldofam); 
		 
		 if ($haysaldofam > 0)
		{$mostrarsaldofam = mysql_fetch_array($buscarsaldofam);}
		
		?>
      
      </tr>
      <tr>
        <td align="center"><input type="text" style="height:auto;background:#FF9" value="
		<?php
		
	 	if ($haysaldotrab > 0)
		{echo $mostrarsaldotrab['salmed_trab'];}
		
		if ($haysaldofam > 0)
		{echo $mostrarsaldofam['salmed_fam'];}
		
		?>
        " size="20" readonly="readonly" />
        </td>
        <td align="center"><input type="text" style="height:auto;background:#FF9" value="
		<?php
		
	 	if ($haysaldotrab > 0)
		{echo $mostrarsaldotrab['salmedod_trab'];}
		
		if ($haysaldofam > 0)
		{echo $mostrarsaldofam['salmedod_fam'];}
		
		?>
        " size="20" readonly="readonly" />
        </td>
        <td align="center"><input type="text" style="height:auto;background:#FF9" value="
		  <?php
		
		if ($haysaldotrab > 0)
		{echo $mostrarsaldotrab['sallen_trab'];}
		
		if ($haysaldofam > 0)
		{echo $mostrarsaldofam['sallen_fam'];}
		
		?>
        " size="20" readonly="readonly" />
        </td>
        <td align="center"><input name="" type="text" id="" style="height:auto;background:#FF9" value="
		<?php
	 	
		if ($haysaldotrab > 0)
		{echo $mostrarsaldotrab['salprot_trab'];}
		
		if ($haysaldofam > 0)
		{echo $mostrarsaldofam['salprot_fam'];}
		
		?>
        " size="20" readonly="readonly" />
        </td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td><strong>Tipo de Factura</strong></td>
    <td>
      <input name="identificador" type="text" id="identificador" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['identificador']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Codigo</strong></td>
    <td width="69%"><input name="codigo_fact" type="text" maxlength="20" id="codigo_fact" style="width:98%; height:auto" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Institucion/Farmacia/Medico</strong></td>
    <td>
      <input name="nombre_fact" type="text" maxlength="50" id="nombre_fact" style="width:98%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Observacion</strong></td>
    <td>
    <label for="observacion_fact"></label>
      <textarea name="observacion_fact" maxlength="200" id="observacion_fact" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td><strong>Fecha</strong></td>
    <td>
      <input type="date" name="fecha_fact" id="fecha_fact" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Monto</strong></td>
    <td>
      <input type="text" name="monto_fact" id="monto_fact" style="width:98%" required="required" /></td>
  </tr>
 <tr>
    <td><strong>Tipo de Gasto</strong></td>
    <td>
      <select name="tipogasto_fact" id="tipogasto_fact" style="width:99%">
        <option value="0">Seleccione tipo de Gasto</option>
        <option value="Medicinas">Medicinas</option>
        <option value="Odontologia">Odontologia</option>
        <option value="Lentes">Lentes</option>
        <option value="Protesis">Protesis</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_fact" id="enviar_fact" value="Enviar" />
    </td>
    </tr>
 </table>
 <input name="dependencia" type="hidden" value="<?php echo $_GET['dependencia']?>" />
</fieldset></form></center>

    
	<input name="" type="hidden" value="ventanas/consumos" />