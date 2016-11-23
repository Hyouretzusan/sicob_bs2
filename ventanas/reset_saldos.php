<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);
/* FALTA LA FUNCION PARA EXPORTAR LA INFORMACION A LAS TABLAS DE RESPALDO */
	
if(isset($_GET['reset_montos'])) 
{
	
	$consultarmontos = "SELECT * from beneficios ORDER by id";
	$buscarmontos = mysql_query($consultarmontos) or die ("ERROR: linea 11 ".mysql_error()) ;
	$idmontos = mysql_num_rows ($buscarmontos);
	
	  for ($id=1; $id<=$idmontos; $id++)
	  {
		  $usarmontos = mysql_fetch_array($buscarmontos);
		  
		  if ($usarmontos['id'] == 1)
		  {
			  $salmedod = $usarmontos['monto'];
			  
		  }
		  if ($usarmontos['id'] == 2)
		  {
			  $sallen = $usarmontos['monto'];
			 
		  }
		  if ($usarmontos['id'] == 3)
		  {
			  $salprot = $usarmontos['monto'];
			  
		  }
		    if ($usarmontos['id'] == 4)
		  {
			  $salmed = $usarmontos['monto'];
			  
		  }
	  }
	
	$resetmontostrab="UPDATE trabajador SET salmed_trab = '$salmed', salmedod_trab = '$salmedod', sallen_trab = '$sallen', salprot_trab = '$salprot'";
		$sqlresetmontostrab = mysql_query($resetmontostrab) or die ("ERROR: linea 40 ".mysql_error());
	
	$resetmontosfam="UPDATE familiar SET salmed_fam = '$salmed', salmedod_fam = '$salmedod', sallen_fam = '$sallen', salprot_fam = '$salprot'";
		$sqlresetmontosfam = mysql_query($resetmontosfam) or die ("ERROR: linea 44 ".mysql_error());	
		
		
			?>
	<script>
		alert ("Los saldos han sido reiniciados");</script> <?php	
		
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
#cuerporesetmontos
{
	width:auto
}
</style>
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
<input name="sec" type="hidden" value="ventanas/reset_saldos" />
<fieldset id="cuerporesetmontos" style="background-color:#FFF">

 <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>RESET DE SALDOS</strong>
 
 </legend>
 
 <table width="50%" border="0" id="cuadro">
   
  <tr>
   <td colspan="2" align="center"> <legend style="font-size:10pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"> Este men&uacute; reiniciar&aacute; los saldos en Medicinas, Lentes y Pr&oacute;tesis de los beneficiarios a sus valores originales en la base de datos. Una vez hecho esto <strong>NO PODR&Aacute; REVERTIR EL PROCESO</strong>.
     </legend>
     <legend style="font-size:10pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"></legend></td>
      </td>
 
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="reset_montos" id="reset_montos" value="Reset" onclick="return confirm('¿Esta realmente seguro?');" />
    </td>
    </tr>
 </table>
</fieldset></form></center>