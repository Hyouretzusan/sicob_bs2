<script>

function fixelement(element, message) {
alert(message);
element.focus();
}

function verifica(form) {
var passed = false;
if (form.usuario.value == "") {
fixelement(form.usuario, "Por favor, ingrese un usuario.");
}
else if (form.clave.value == "") {
fixelement(form.clave, "Por favor, ingrese una contrase\u00f1a.");
}
  
else {
passed = true;
}
return passed;
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<style>
html { background:#ffffff;
background: url(multimedia/9symphony.png) repeat;
}

#cabecera{
	background-color: #FFF;
	border-left: 0px solid #880000;
	border-right: 0px solid #880000;
	border-top: 0px solid #880000;
	border-bottom: 20px solid #880000;
	border-radius: 0px;
	font-family: Georgia, "Times New Roman", Times, serif;
}

#cuadropeque{
	background-color: #FFF;
	border-left: 2px solid #880000;
	border-right: 2px solid #880000;
	border-top: 2px solid #880000;
	border-bottom: 2px solid #880000;
	border-radius: 0px;
	font-family: Georgia, "Times New Roman", Times, serif;
	
}
#linea_derecha{
	border-right: 2px solid #880000;
	border-bottom: 2px solid #880000;
	font-family: Georgia, "Times New Roman", Times, serif;
}
	#linea{
	border-bottom: 2px solid #880000;
	font-family: Georgia, "Times New Roman", Times, serif;
}
	

	
</style>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inicio de Sesión</title>
</head>

<body><br />
<form name="form" method="post" action="sesion/validar.php" onsubmit = "return verifica(this)">
<table width="100%" border="0" bordercolor="" align="center" >
  <tr>
    <td><table width="100%" border="0" align="center" id="cabecera" >
      <tr>
        <td align="center"><img src="multimedia/logo_ministerio.gif" width="100%" height="74" /></td>
        <td><img src="multimedia/logo_gobernacion_2013.png" width="100%" height="150" /></td>
      </tr>
    </table></td>
  </tr>
 
  <tr>
    <td align="center" id="" ><h1 style="color:#880000">&nbsp;</h1>
      <p style="color:#880000">&nbsp;</p>
      <p style="color:#880000">&nbsp; </p>
      <h1 style="color:#880000"> SICOB BS </h1>
    <h4 style="color:#880000">Sistema de Control de Beneficios para Bienestar Social </h4></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle" id=""><table width="270px" border="0" id="cuadropeque" >
      <tr>
        <td colspan="2" align="center" valign="middle" id="linea"  >Inicio de Sesi&oacute;n</td>
      </tr>
      <tr>
        <td width="28%" align="center" valign="middle" id:"" >Usuario</td>
        <td width="72%" id=""><label for="nick_usuario" ></label>
          <input type="text" name="nick_usuario" id="nick_usuario" style="width:99%" /></td>
      </tr>
      <tr>
        <td align="center" valign="middle" id="">Contrase&ntilde;a</td>
        <td id=""><label for="clave_usuario"></label>
          <input type="password" name="clave_usuario" id="clave_usuario" style="width:99%" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="ingresar" id="ingresar" value="Ingresar" /></td>
      </tr>
    </table></td>
 
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor=""><strong>
      <marquee>
      2015 Direcci&oacute;n Regional de Salud del Estado Monagas
    </marquee></strong></td>
  </tr>
</table>

</form>

</body>
</html>