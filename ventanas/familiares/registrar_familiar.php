<?php 
include("bdd/funciones_mysql.php");
conectar();
include ("ventanas/generador_codigo.php");
$nocedula = generador_codigo($_GET['cedula']); ?>

<script> function quierocodigo(codigo){
	
	var cedula_fam = document.all.cedula_fam.value;
	
	if (codigo.value== 'si')
	{ document.all.cedula_fam.readOnly=false;
	document.all.codigo_fam.readOnly=false;
	document.all.cedula_fam.style.backgroundColor="#fff";
	document.all.codigo_fam.style.backgroundColor="#fff";
	document.all.cedula_fam.value="";
	document.all.codigo_fam.value="";} 
    
    else
    { document.all.cedula_fam.readOnly=true;
	document.all.codigo_fam.readOnly=true;
	document.all.cedula_fam.style.backgroundColor="#ff9";
	document.all.codigo_fam.style.backgroundColor="#ff9";
	document.all.cedula_fam.value="<?php echo $nocedula; ?>";
	document.all.codigo_fam.value="<?php echo $nocedula; ?>";}
    
}
    </script>
<?php 
/* include("bdd/funciones_mysql.php");
conectar(); */
/* include ("ventanas/generador_codigo.php");
$nocedula = generador_codigo($_GET['cedula']); */

include ("ventanas/limite_cargafam.php"); 
$cualquiera = limite_cargafam($_GET['cedula']);
extract ($_GET);
/*include ("ventanas/limite_edad3.php"); 
$laquesea = limite_edad3($_GET['*']);
extract ($_GET);*/


if(isset($_GET['enviar_fam']))
	{
	$salida=false;
	
	$revisarsiencuentra=mysql_query("select * from familiar order by cedula_fam");

	$cantidadtasarevision=mysql_num_rows($revisarsiencuentra);
	
	for($j=1;$j<=$cantidadtasarevision;$j++)
	{
		$campofam=mysql_fetch_array($revisarsiencuentra);
		$cedula_fam=$campofam['cedula_fam'];
		$apellido_fam=$campofam['apellido_fam'];
		$codigo_fam=$campofam['codigo_fam'];
		
		if(($cedula_fam==$_GET['cedula_fam']))
		{
			$salida=true;
		}
	}
		if($salida==false)
	{
		$revisarmontos = mysql_query ("select * from beneficios order by id");
		$ordenarmontos = mysql_num_rows ($revisarmontos);
		
		for($k=1;$k<=$ordenarmontos;$k++)
		{
			$asignarmontos=mysql_fetch_array($revisarmontos);
			if ($asignarmontos['id'] == 1)
			{
		$salmedod_fam = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 2)
			{
		$sallen_fam = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 3)
			{
		$salprot_fam = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 4)
			{
		$salmed_fam = $asignarmontos['monto'];
			}
		}
		
		$stringingresarfamiliar="insert into familiar (cedula_fam, apellido_fam, nombre_fam, sexo_fam, parentesco_fam, patologia_fam, discapacidad_fam, codigo_fam, fecnac_fam, salmedod_fam, sallen_fam, salprot_fam, salmed_fam, cedula_trab, identificador_fam, dependencia_fam) values ('$_GET[cedula_fam]','$_GET[apellido_fam]','$_GET[nombre_fam]','$_GET[sexo_fam]','$_GET[parentesco_fam]','$_GET[patologia_fam]','$_GET[discapacidad_fam]','$_GET[codigo_fam]','$_GET[fecnac_fam]', '$salmedod_fam', '$sallen_fam', '$salprot_fam','$salmed_fam' , '$_GET[cedula_trab]', 'Familiar','$_GET[dependencia_nomina]' )";
		
		$sqlingresarfamiliar=mysql_query($stringingresarfamiliar) or die ("ERROR: Linea 91".mysql_error());
		?>
		<script>
		alert("Familiar Registrado");</script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("El ciudadano/a <?php echo $_GET['nombre_fam'] ?> <?php echo $_GET['apellido_fam'] ?> ya se encuentra registrado");
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
#cuerpoagregarfamiliar
{
	width:auto
}
</style>

<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/familiares/registrar_familiar" />
<input name="cedula" type="hidden" value="<?php echo $_GET['cedula'] ?>" />
<fieldset id="cuerpoagregarfamiliar" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>REGISTRAR FAMILIAR</strong>
 
 <br />
 </legend>
 <table width="50%" border="0" id="cuadro">
  <tr>
  <td width="31%" align="right" valign="middle">&nbsp;</td>
  <td width="69%%" align="left" valign="middle"><h3><strong style="color:#880000">Datos Trabajador</strong></h3></td>

  </tr>
  <tr>
    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula_trab" type="text" id="cedula_trab" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['cedula']?>" size="20" readonly="readonly" /></td>
  </tr>
<tr>
    <td width="31%"><strong>Nombre</strong></td>
    <td width="69%"><input name="1" type="text" id="1" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['nombre']?>" size="20" readonly="readonly" /></td>
  </tr><tr>
    <td width="31%"><strong>Apellido</strong></td>
    <td width="69%"><input name="2" type="text" id="2" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['apellido']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Dependencia</strong></td>
    <td width="69%"><input name="dependencia_nomina" type="text" id="dependencia_nomina" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['dependencia']?>" size="20" readonly="readonly" /></td>
  </tr>
 </table><br />

 <table width="50%" border="0" id="cuadro">
  <tr>
  <td width="31%" align="right" valign="middle">&nbsp;</td>
  <td width="69%%" align="left" valign="middle"><h3><strong style="color:#880000">Datos Familiar</strong></h3></td>
  </tr>
  <tr>
    <td><strong>&iquest;Posee C.I?</strong></td>
    <td><p>
      <label>
        <input type="radio" name="tiene_cedula" value="si" id="tiene_cedula_0" onclick="quierocodigo(this)"/>
        Si</label>
      
      <label>
        <input type="radio" name="tiene_cedula" value="no" id="tiene_cedula_1" onclick="quierocodigo(this)" />
        No</label>
     
    </p></td>
  </tr>
  <tr>
    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula_fam" maxlength="21" type="text" id="cedula_fam" style="width:98%;height:100%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_fam" maxlength="40" type="text" id="apellido_fam" style="width:98%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td>
      <input type="text" name="nombre_fam" maxlength="40" id="nombre_fam" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Sexo</strong></td>
    <td>
      <select name="sexo_fam" id="sexo_fam" style="width:99%">
        <option value="0">Seleccione Sexo</option>
        <option value="Femenino">Femenino</option>
        <option value="Masculino">Masculino</option>
      </select></td>
  </tr>
   <tr>
    <td><strong>Parentesco</strong></td>
    <td>
      <select name="parentesco_fam" id="parentesco_fam" style="width:99%">
        <option value="0">Seleccione Parentesco</option>
        <option value="Madre">Madre</option>
        <option value="Padre">Padre</option>
        <option value="Esposo/a">Esposo/a</option>
        <option value="Hijo/a">Hijo/a</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Patologia</strong></td>
    <td>
      <select name="patologia_fam" id="parentesco_fam" style="width:99%">
        <option value="No">No</option>
        <option value="Si">Si</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Discapacidad</strong></td>
    <td>
      <select name="discapacidad_fam" id="discapacidad_fam" style="width:99%">
        <option value="No">No</option>
        <option value="Si">Si</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td>
      <input type="text" maxlength="50" name="codigo_fam" id="codigo_fam" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento</strong></td>
    <td>
      <input type="date" name="fecnac_fam" id="fecnac_fam" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_fam" id="enviar_fam" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>