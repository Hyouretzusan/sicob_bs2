<?php 
include("bdd/funciones_mysql.php");
conectar();
include ("ventanas/generadorcodigo_contratados.php");
$nocodigo = generadorcodigo_contratados($_POST['tiene_codigo']);
extract ($_POST); ?>

<script> function quierocodigo(codigo){
	
	var codigo_trab = document.all.codigo_trab.value;
	
	if (codigo.value== 'si')
	{ 
	document.all.codigo_trab.readOnly=false;
	
	document.all.codigo_trab.style.backgroundColor="#fff";
	
	document.all.codigo_trab.value="";} 
    
    else
    {
	document.all.codigo_trab.readOnly=true;
	
	document.all.codigo_trab.style.backgroundColor="#ff9";
	
	document.all.codigo_trab.value="<?php echo $nocodigo; ?>";}
    
}
    </script>
<?php 
extract ($_GET);

if(isset($_GET['enviar_trab']))
	{
	$salida=false;
	
	$revisarsiencuentra=mysql_query("select * from trabajador order by cedula_trab");

	$cantidadtasarevision=mysql_num_rows($revisarsiencuentra);
	
	for($j=1;$j<=$cantidadtasarevision;$j++)
	{
		$campotrab=mysql_fetch_array($revisarsiencuentra);
		$cedula_trab=$campotrab['cedula_trab'];
		$apellido_trab=$campotrab['apellido_trab'];
		$nombre_trab=$campotrab['nombre_trab'];
		
		if(($cedula_trab==$_GET['cedula_trab']) and ($apellido_trab==$_GET['apellido_trab']))
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
		$salmedod_trab = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 2)
			{
		$sallen_trab = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 3)
			{
		$salprot_trab = $asignarmontos['monto'];
			}
			if ($asignarmontos['id'] == 4)
			{
		$salmed_trab = $asignarmontos['monto'];
			}
		}
		
		$stringingresartrabajador="insert into trabajador (cedula_trab, apellido_trab, nombre_trab, sexo_trab, fecing_trab, cargo_trab, dependencia_trab, codigo_trab, fecnac_trab, salmedod_trab, sallen_trab, salprot_trab, salmed_trab, identificador_trab) values ('$_GET[cedula_trab]','$_GET[apellido_trab]','$_GET[nombre_trab]', '$_GET[sexo_trab]', '$_GET[fecing_trab]', '$_GET[cargo_trab]','$_GET[dependencia_trab]','$_GET[codigo_trab]', '$_GET[fecnac_trab]', '$salmedod_trab', '$sallen_trab', '$salprot_trab', '$salmed_trab', 'Trabajador')";
		
		$sqlingresartrabajador=mysql_query($stringingresartrabajador) or die ("ERROR: ".mysql_error());
		?>
		<script>
		alert("Trabajador Registrado");</script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("El trabajador <?php echo $_GET['nombre_trab'] ?> <?php echo $_GET['apellido_trab'] ?> ya se encuentra registrado");
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
#cuerpoagregartrabajador
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/trabajador/registrar_trabajador" />
<fieldset id="cuerpoagregartrabajador" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>REGISTRAR TRABAJADOR</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula_trab" type="text" maxlength="11" id="cedula_trab" style="width:98%;height:100%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Apellido</strong></td>
    <td>
      <input name="apellido_trab" type="text" maxlength="40" id="apellido_trab" style="width:98%" size="20" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td>
      <input type="text" maxlength="40" name="nombre_trab" id="nombre_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Sexo</strong></td>
    <td>
      <select name="sexo_trab" id="sexo_trab" style="width:99%">
        <option value="0">Seleccione Sexo</option>
        <option value="Femenino">Femenino</option>
        <option value="Masculino">Masculino</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ingreso</strong></td>
    <td>
      <input name="fecing_trab" type="date" id="fecing_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Cargo</strong></td>
    <td>
      <input type="text" maxlength="50" name="cargo_trab" id="cargo_trab" style="width:98%" required="required" /></td>
  </tr>
 <tr>
    <td><strong>Dependencia</strong></td>
    <td>
      <select name="dependencia_trab" id="dependencia_trab" style="width:99%">
        <option value="0">Seleccione Dependencia</option>
        <option value="Especifico">Especifico</option>
        <option value="Contratado Especifico">Contratado Especifico</option>
        <option value="Obrero">Obrero</option>
        <option value="Contratado Obrero">Contratado Obrero</option>
        <option value="Centralizado">Centralizado</option>
      <option value="Contratado Centralizado">Contratado Centralizado</option>
      </select>
      </td>
  </tr>
   <tr>
    <td><strong>&iquest;Posee Codigo?</strong></td>
    <td><p>
      <label>
        <input type="radio" name="tiene_codigo" value="si" id="tiene_codigo_0" onclick="quierocodigo(this)"/>
        Si</label>
      
      <label>
        <input type="radio" name="tiene_codigo" value="no" id="tiene_codigo_1" onclick="quierocodigo(this)" />
        No</label>
     
    </p></td>
  </tr>
  <tr>
    <td><strong>Codigo</strong></td>
    <td>
      <input type="text" maxlength="20" name="codigo_trab" id="codigo_trab" style="width:98%" required="required" /></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento</strong></td>
    <td>
      <input name="fecnac_trab" type ="date" id="fecnac_trab" style="width:98%" required="required"   /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_trab" id="enviar_trab" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>