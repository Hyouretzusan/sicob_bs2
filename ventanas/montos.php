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
    #cuerpomodificarbeneficios
    {
        width:auto
    }
</style>

<script>

function fixelement(element, message) {
alert(message);
element.focus();
}

function verifica(form) {
var passed = false;
if (form.id_beneficios.value == 0) {
fixelement(form.id_beneficios, "Por favor, seleccione un beneficio.");
}
else if (form.monto_beneficios.value == "") {
fixelement(form.monto_beneficios, "Por favor, ingrese un monto.");
}
  
else {
passed = true;
}
return passed;
}

</script>

<center>
<form name="inserta" id="inserta" method="get" onsubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/montos" />
<fieldset id="cuerpomodificarbeneficios" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>MONTOS</strong></legend>
 
 <table width="50%" border="0" id="cuadro">
  <tr>
  <td colspan="2" align="center"> <legend style="font-size:10pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"> Este men&uacute; modificar&aacute; los montos de los beneficios en Medicinas, Lentes y/o Pr&oacute;tesis en la base de datos; y ajustar&aacute; los saldos de TODOS los beneficiarios en el sistema. Una vez hecho esto <strong>NO PODR&Aacute; REVERTIR EL PROCESO</strong>.
     </legend>
     <legend style="font-size:10pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"></legend></td>
      </td>
  </tr>
  <tr>
    <td width="31%"><strong>Beneficio</strong></td>
    <td width="69%"><select name="id_beneficios" id="id_beneficios" style="width:99%">
        <option value="0">Seleccione Beneficio</option>
        <option value="4">Medicinas</option>
        <option value="1">Odontologia</option>
        <option value="2">Lentes</option>
        <option value="3">Protesis</option>
      </select></td>
  </tr>
  <tr>
    <td><strong>Monto Nuevo</strong></td>
    <td>
      <input type="text" name="monto_beneficios" id="monto_beneficios" style="width:98%" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="required"/></td>
  </tr>
 
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="mod_montos" id="mod_montos" value="Enviar" onclick="return confirm('¿Esta realmente seguro?');" />
    </td>
    </tr>
 </table>
</fieldset></form></center>
    
<?php 

if(isset($_GET['mod_montos'])) 
{
    $stringconsultarmontos = "SELECT monto FROM beneficios WHERE id = '$_GET[id_beneficios]'";
    $sqlconsultarmontos = mysql_query($stringconsultarmontos) or die ("ERROR: linea 93 ".mysql_error());
    $infomontos = mysql_fetch_array($sqlconsultarmontos);
    $montoviejo = $infomontos['monto'];
    $montonuevo = $_GET['monto_beneficios'];
    $diferenciamonto = $montonuevo - $montoviejo;
	
    $stringmodificarmontos = "UPDATE sicob.beneficios SET monto = '$_GET[monto_beneficios]' WHERE beneficios.id = '$_GET[id_beneficios]'";
    $sqlmodificarmontos = mysql_query($stringmodificarmontos) or die ("ERROR: linea 100 ".mysql_error());
		
    if($_GET['id_beneficios'] == 1)
    {
        $stringmontotrab = "SELECT * FROM trabajador";
        $sqlmontotrab = mysql_query($stringmontotrab) or die ("ERROR: linea 106 ".mysql_error());
        $numtrab = mysql_num_rows($sqlmontotrab);
		
        for ($a=1; $a<=$numtrab;$a++)
        {
            $infomontotrab = mysql_fetch_array($sqlmontotrab);
            $actualizarmontotrab = $diferenciamonto + $infomontotrab['salmedod_trab'];
            $cedulatrab = $infomontotrab['cedula_trab'];
            $nuevomontotrab = "UPDATE trabajador SET salmedod_trab = '".$actualizarmontotrab."' WHERE cedula_trab = '".$cedulatrab."'";
            $sqlnuevomontotrab=mysql_query($nuevomontotrab) or die("ERROR: linea 114 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 01
        }
		
        $stringmontofam = "SELECT * FROM familiar";
        $sqlmontofam = mysql_query($stringmontofam) or die ("ERROR: linea 119 ".mysql_error());
        $numfam = mysql_num_rows($sqlmontofam);
		
        for ($b=1; $b<=$numfam;$b++)
        {
            $infomontofam = mysql_fetch_array($sqlmontofam);
            $actualizarmontofam = $diferenciamonto + $infomontofam['salmedod_fam'];
            $cedulafam = $infomontofam['cedula_fam'];//Error 01
            $nuevomontofam = "UPDATE familiar SET salmedod_fam = '".$actualizarmontofam."' WHERE cedula_fam = '".$cedulafam."'";
            $sqlnuevomontofam=mysql_query($nuevomontofam) or die("ERROR: linea 128 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 02
        }
    }
		
    if($_GET['id_beneficios'] == '2')
    {
        $stringmontotrab = "SELECT * FROM trabajador";
        $sqlmontotrab = mysql_query($stringmontotrab) or die ("ERROR: linea 135 ".mysql_error());
        $numtrab = mysql_num_rows($sqlmontotrab);
		
        for ($a=1; $a<=$numtrab;$a++)
        {
            $infomontotrab = mysql_fetch_array($sqlmontotrab);
            $actualizarmontotrab = $diferenciamonto + $infomontotrab['sallen_trab'];
            $cedulatrab = $infomontotrab['cedula_trab'];
            $nuevomontotrab = "UPDATE trabajador SET sallen_trab = '".$actualizarmontotrab."' WHERE cedula_trab = '".$cedulatrab."'";
            $sqlnuevomontotrab=mysql_query($nuevomontotrab) or die("ERROR: linea 143 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 03
        }
		
        $stringmontofam = "SELECT cedula_fam, sallen_fam FROM familiar";
        $sqlmontofam = mysql_query($stringmontofam) or die ("ERROR: linea 148 ".mysql_error());
        $numfam = mysql_num_rows($sqlmontofam);
		
        for ($b=1; $b<=$numfam;$b++)
        {
            $infomontofam = mysql_fetch_array($sqlmontofam);
            $actualizarmontofam = $diferenciamonto + $infomontofam['sallen_fam'];
            $cedulafam = $infomontofam['cedula_fam'];
            $nuevomontofam = "UPDATE familiar SET sallen_fam = '".$actualizarmontofam."' WHERE cedula_fam = '".$cedulafam."'";
            $sqlnuevomontofam=mysql_query($nuevomontofam) or die("ERROR: linea 156 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 04
        }

    }
		
    if($_GET['id_beneficios'] == '3')
    {
        $stringmontotrab = "SELECT cedula_trab, salprot_trab FROM trabajador";
        $sqlmontotrab = mysql_query($stringmontotrab) or die ("ERROR: linea 165 ".mysql_error());
        $numtrab = mysql_num_rows($sqlmontotrab);
		
        for ($a=1; $a<=$numtrab;$a++)
        {
            $infomontotrab = mysql_fetch_array($sqlmontotrab);
            $actualizarmontotrab = $diferenciamonto + $infomontotrab['salprot_trab'];
            $cedulatrab = $infomontotrab['cedula_trab'];
            $nuevomontotrab = "UPDATE trabajador SET salprot_trab = '".$actualizarmontotrab."' WHERE cedula_trab = '".$cedulatrab."'";
            $sqlnuevomontotrab=mysql_query($nuevomontotrab) or die("ERROR: linea 173 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 05
        }
		
        $stringmontofam = "SELECT cedula_fam, salprot_fam FROM familiar";
        $sqlmontofam = mysql_query($stringmontofam) or die ("ERROR: linea 178 ".mysql_error());
        $numfam = mysql_num_rows($sqlmontofam);
		
        for ($b=1; $b<=$numfam;$b++)
        {
            $infomontofam = mysql_fetch_array($sqlmontofam);
            $actualizarmontofam = $diferenciamonto + $infomontofam['salprot_fam'];
            $cedulafam = $infomontofam['cedula_fam'];
            $nuevomontofam = "UPDATE familiar SET salprot_fam = '".$actualizarmontofam."' WHERE cedula_fam = '".$cedulafam."'";
            $sqlnuevomontofam=mysql_query($nuevomontofam) or die("ERROR: linea 186 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 06
        }
		
    }
	   if($_GET['id_beneficios'] == 4)
    {
        $stringmontotrab = "SELECT * FROM trabajador";
        $sqlmontotrab = mysql_query($stringmontotrab) or die ("ERROR: linea 194 ".mysql_error());
        $numtrab = mysql_num_rows($sqlmontotrab);
		
        for ($a=1; $a<=$numtrab;$a++)
        {
            $infomontotrab = mysql_fetch_array($sqlmontotrab);
            $actualizarmontotrab = $diferenciamonto + $infomontotrab['salmed_trab'];
            $cedulatrab = $infomontotrab['cedula_trab'];
            $nuevomontotrab = "UPDATE trabajador SET salmed_trab = '".$actualizarmontotrab."' WHERE cedula_trab = '".$cedulatrab."'";
            $sqlnuevomontotrab=mysql_query($nuevomontotrab) or die("ERROR: linea 203 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 07
        }
		
        $stringmontofam = "SELECT * FROM familiar";
        $sqlmontofam = mysql_query($stringmontofam) or die ("ERROR: linea 207 ".mysql_error());
        $numfam = mysql_num_rows($sqlmontofam);
		
        for ($b=1; $b<=$numfam;$b++)
        {
            $infomontofam = mysql_fetch_array($sqlmontofam);
            $actualizarmontofam = $diferenciamonto + $infomontofam['salmed_fam'];
            $cedulafam = $infomontofam['cedula_fam'];//Error 01
            $nuevomontofam = "UPDATE familiar SET salmed_fam = '".$actualizarmontofam."' WHERE cedula_fam = '".$cedulafam."'";
            $sqlnuevomontofam=mysql_query($nuevomontofam) or die("ERROR: linea 216 ".mysql_error());//A Claudio se le olvida ejecutar la consulta 08
        }
    }
	
    ?>
    <script>
        alert("Monto Actualizado");
    </script>
    <?php
}
?>