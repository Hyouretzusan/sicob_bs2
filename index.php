<?php include("sesion.php"); 
date_default_timezone_set("America/Caracas");
$mes = date("M");
switch($mes) {
		case "Jan" : $mesv="Enero";
					break;
		case "Feb" : $mesv="Febrero";
					break;
		case "Mar" : $mesv="Marzo";
					break;
		case "Apr" : $mesv="Abril";
					break;
		case "May" : $mesv="Mayo";
					break;
		case "Jun" : $mesv="Junio";
					break;
		case "Jul" : $mesv="Julio";
					break;
		case "Aug" : $mesv="Agosto";
					break;
		case "Sep" : $mesv="Septiembre";
					break;
		case "Oct" : $mesv="Octubre";
					break;
		case "Nov" : $mesv="Noviembre";
					break;
		case "Dec" : $mesv="Diciembre";
			}

	$fechasina=date ("d "). "de ".$mesv. " de ".date ("Y")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SICOB BS</title>

<style>
html { background:#ffffff;
background: url(multimedia/9symphony.png) repeat;
}

#cabecera{
	background-color: #f4f4f4;/*#f4f4f4*/
	border-left: 0px solid #880000;
	border-right: 0px solid #880000;
	border-top: 0px solid #880000;
	border-bottom: 20px solid #880000;
	border-radius: 0px;
	font-family:Calibri;
}
h4 {
	margin: 10px 0 5px 10px;
	color: #000000;
	font-family:Calibri;
}
body {
	font-family: Calibri;
	background: #FFF;
	margin: 40px auto;
	width: 90%;
	border-radius: 10px;
}
</style>

<link href="css/dcaccordion.css" rel="stylesheet" type="text/css" />
<!--<link href="css/estiloSAOS.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type='text/javascript' src='javascript/jquery.cookie.js'></script>
<script type='text/javascript' src='javascript/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='javascript/jquery.dcjqaccordion.2.7.min.js'></script>
<script type="text/javascript">
$(document).ready(function($){
					$('#accordion-2').dcAccordion({
						eventType: 'click',
						autoClose: true,
						saveState: false,
						disableLink: true,
						speed: 'fast',
						showCount: false,
						autoExpand: true,
						cookie	: 'dcjq-accordion-1',
						classExpand	 : 'dcjq-current-parent'
					});
					
					
});

function show5(){
	if (!document.layers&&!document.all&&!document.getElementById)
	return
	var Digital=new Date()
	var hours=Digital.getHours()
	var minutes=Digital.getMinutes()
	var seconds=Digital.getSeconds()
	var dn="AM" 
	if (hours>12){
	dn="PM"
	hours=hours-12
	}
	if (hours==0)
	hours=12
	if (minutes<=9)
	minutes="0"+minutes
	if (seconds<=9)
	seconds="0"+seconds
	//change font size here to your desire
	myclock="<face='Calibri' ><b>"+hours+":"+minutes+":"
	+seconds+" "+dn+"</b></font>"
	if (document.layers){
	document.layers.liveclock.document.write(myclock)
	document.layers.liveclock.document.close()
	}
	else if (document.all)
	liveclock.innerHTML=myclock
	else if (document.getElementById)
	document.getElementById("liveclock").innerHTML=myclock
	setTimeout("show5()",1000)
	}
</script>
<link href="css/graphite.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<link type="text/css" href="estilo.css" rel="stylesheet" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>

<body onLoad="show5()">
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="2" align="center" valign="middle"><table width="100%" border="0" align="center" id="cabecera">
      <tr>
        <td width="51%" align="center" valign="middle" bgcolor="#FFFFFF"><img src="multimedia/logo_ministerio.gif" width="100%" height="74" /></td>
        <td width="49%" align="center" valign="middle" bgcolor="#FFFFFF"><img src="multimedia/logo_gobernacion_2013.png" width="100%" height="150" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#FFFFFF"><strong style=" font-family: 'Calibri'; font-size: 18px; color: #000000; text-align: right"><?php echo "Bienvenido: <br>".$nombrea."  ".$cargoa;?></strong></td>
        <td align="right" valign="middle" bgcolor="#FFFFFF"><strong style=" font-family: 'Calibri'; font-size: 18px; color: #000000; text-align: right"><?php echo $fechasina; ?><br>

                            <span id='liveclock'></span>
                    </strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="20%" style="background-color:#FFF"> <div class="graphite demo-container" style="text-align:left">
<ul class="accordion" id="accordion-2">
  <li><a href="index.php" style="border-top: 2px solid #880000; border-top-left-radius:0px; border-top-right-radius:0px;"><img src="multimedia/house_2.png" alt="" width="30" height="30" />&nbsp;Inicio</a></li>
  <li><a href="?sec=ventanas/buscador"><img src="multimedia/search.png" alt="" width="20" height="20" />&nbsp;&nbsp;Buscador</a></li>

 
    <li><a href="#"><img src="multimedia/casco.png" alt="" width="30" height="30" />&nbsp;Trabajador</a>
      <ul>
            <li><a href="?sec=ventanas/trabajador/registrar_trabajador">Registrar Trabajador</a>
           <li><a href="?sec=ventanas/gasto_mensual2">Gasto Mensual Carga Familiar</a></li>
      </ul>
    </li>
    <li><a href="?sec=ventanas/buscador_nomina"><img src="multimedia/coins.png" alt="" width="30" height="30" />&nbsp;Nómina</a>
    </li>
    
    

	<?php 
	if($tipoa=='Administrador')
	{
	?>
    <li><a href="#"><img src="multimedia/man_brown.png" alt="" width="30" height="30" />&nbsp;Usuarios*</a>
      <ul>
    <li><a href="?sec=ventanas/usuario/registrar_usuario">Registrar Usuario</a></li>
    <li><a href="?sec=ventanas/usuario/lista_usuario">Lista de  Usuarios</a></li>

</ul>
</li>


    
<li><a href="?sec=ventanas/autoridades"><img src="multimedia/man_black.png" alt="" width="30" height="30" />&nbsp;&nbsp;Autoridades*</a></li>
<li><a href="?sec=ventanas/reset_saldos"><img src="multimedia/reset.png" alt="" width="30" height="30" />&nbsp;&nbsp;Reset de Saldos*</a></li>
<li><a href="?sec=ventanas/montos"><img src="multimedia/money.png" alt="" width="30" height="30" />&nbsp;&nbsp;Actualizar Montos*</a></li>
<?php 
	}
	?>

<li><a href="?sec=sesion/salir" style="border-bottom-left-radius:0px;border-bottom-right-radius:0px;"><img src="multimedia/exit_go.png" alt="" width="30" height="30" />Cerrar Sesi&oacute;n</a></li>
</ul>
</div>
    <div align="center"></div>
    <div align="justify"></div></td>
    <td width="80%" align="left" valign="top" style="background-color:#FFF"><?php 
if(empty($_GET['sec'])) 
{
include("inicio.php"); 
}
else if(file_exists("$_GET[sec].php"))
{
//include('$sec.php'); 
include("$_GET[sec].php"); 
}
else if(file_exists("$_GET[sec].html")) 
include("$_GET[sec].html"); 
else 
include("construccion.php");
?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><strong><marquee>
      2015 Direcci&oacute;n Regional de Salud del Estado Monagas
    </marquee></strong></td>
  </tr>
</table>

</body>
</html>