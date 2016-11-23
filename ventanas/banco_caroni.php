<?php 
include("bdd/funciones_mysql.php");
conectar();

extract ($_GET);

$STRINGMUNICIPIO="select distinct dependencia_trab from trabajador order by dependencia_trab";

$SQLMUNICIPIO=mysql_query($STRINGMUNICIPIO) or die ("ERROR AL SELECCIONAR LOS DATOS". mysql_error());

$FILASMUNICIPIO=mysql_num_rows($SQLMUNICIPIO);

/*$STRINGDESDEAS="select distinct desde_asignaciones from asignaciones";

$SQLDESDEAS=mysql_query($STRINGDESDEAS) or die ("ERROR AL SELECCIONAR LOS DATOS". mysql_error());

$FILASDESDEAS=mysql_num_rows($SQLDESDEAS);*/

?>
<html>
<head>
 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    

   

<link rel="stylesheet" type="text/css" href="estilo.css"/>
<script type="text/javascript">
  $(document).ready(function() {
    $("#submit").click(function() {
      $.get("", $("#inserta").serialize(), function(data) {
        //data es la respuesta del servidor
      });
    });
  });
</script>
<script>
<!--
form.nombre_aut.disabled=true;

function fixElement(element, message) {
alert(message);
element.focus();
}

function verifica(form) {
var passed = false;

if (form.nombre_archivo.value == "")
fixElement(form.nombre_archivo, "Por favor, ingrese un nombre para el archivo txt.");
else if (form.mescn.value == "0")
fixElement(form.mescn, "Por favor, seleccione el mes.");
else if (form.aniocn.value == "")
fixElement(form.aniocn, "Por favor, ingrese el año.");
else if (form.municipiocn.value == "0")
fixElement(form.municipiocn, "Por favor, seleccione una dependencia.");

else if(form.fechacn.value != "")
{
var fecha=form.fechacn.value.split("/"); 
   if(fecha.length==3) 
   { 
	  if(parseInt(fecha[0]) > 1 || parseInt(fecha[0])<1)
      {
         alert('El dia de la fecha ingresada no es correcto, debe ser el primer dia del mes');
         return false;
      } 
     
      /*if(parseInt(fecha[1])>12 || (parseInt(fecha[1])<1))
      {
         alert('El mes de la fecha ingresada no es correcto');
         return false;
      } 
      // con esto compruebo que esté correctamente formada y verifico años bisiestos. 
      var mifecha = new Date(fecha[2],fecha[1]-parseInt(1),fecha[0])
      if(parseInt(fecha[0])!=parseInt(mifecha.getDate())) 
      { 
         alert('La fecha introducida no es correcta'); 
         return false; 
      }*/
	  else {
		passed = true;
		}
	  	  
   }
   else 
      alert('El formato de la fecha debe ser dia/mes/año'); 	
}

else 
passed = true;
  
return passed;
}

-->
</script>

</head>
<body>


<div style="height:auto; border:none">

<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)" action="ventanas/procesamiento.php" target="_blank">
<!--<input type="hidden" name="sec" id="sec" value="ventanas/banco_caroni">-->

<div >
  <br>
  <fieldset id="cuerpo">
    <legend><strong>BANCO CARON&Iacute;</strong></legend>
  <br>
    
  <table width="95%" border="0" align="left">
    <tr align="left">
      <td width="86"><strong>Fecha:</strong></td>
      <td width="149"><select name="mescn" id="mescn" style="width:160px">
        <option value="0"><< Seleccione >> </option>
        <option value="01">ENERO</option>
        <option value="02">FEBRERO</option>
        <option value="03">MARZO</option>
        <option value="04">ABRIL</option>
        <option value="05">MAYO</option>
        <option value="06">JUNIO</option>
        <option value="07">JULIO</option>
        <option value="08">AGOSTO</option>
        <option value="09">SEPTIEMBRE</option>
        <option value="10">OCTUBRE</option>
        <option value="11">NOVIEMBRE</option>
        <option value="12">DICIEMBRE</option>
        </select></td>
      <td width="2" rowspan="4" align="left" style=" vertical-align: middle">&nbsp;</td>
      <td width="272" rowspan="4" align="left" style=" vertical-align: middle">
  <input name="procesar" type="submit" style="background-image:url(multimedia/icono_txt.png); width:40px; height:40px; color:#000; " value="TXT"><strong>CREAR ARCHIVO TXT</strong><br><br>  <input type="submit" name="procesar" id="procesar" style="background-image:url(multimedia/icono_pdf.png); width:40px; height:40px; color:#000;" value="PDF">  <strong>CREAR ARCHIVO PDF</strong></td>
      </tr>
    <tr align="left">
      <td><strong>A&ntilde;o:</strong></td>
      <td><input type="text" name="aniocn" id="aniocn" value="" style="width:156px"/></td>
    </tr>
    <tr align="left">
      <td><strong>Dependencia:</strong></td>
      <td><select name="municipiocn" style="width:160px">
      <option value="0"><< Seleccione >> </option>
        <?php for($am=1; $am<=$FILASMUNICIPIO; $am++)
		{
			$CAMPOMUNICIPIO=mysql_fetch_array($SQLMUNICIPIO);
			$VALORMUNICIPIO=$CAMPOMUNICIPIO['dependencia_trab'];
			?>
        <option value="<?php echo $VALORMUNICIPIO; ?>"> <?php echo $VALORMUNICIPIO; ?></option>
        <?php 
  
  }?>
        </select></td>
      </tr>
    <tr align="left">
      <td valign="top"><strong>Nombre del archivo: </strong>
        </td>
      <td valign="top"><span style="text-align:left"><strong>
        <input name="nombre_archivo" id="nombre_archivo" type="text" style="width:156px"/>
        </strong></span></td>
      </tr>
    <tr align="left">
    <td colspan="4">&nbsp;</td>
      </tr>
  </table>
</fieldset>
</div>
</form>
<br>

</center>

</div>

            

</body>
</html>
