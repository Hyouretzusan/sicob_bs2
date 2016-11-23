<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);

		/* VERIFICO LOS SALDOS MAXIMOS PERMITIDOS PARA CADA BENEFICIO */
		$stringbeneficiosmed =  mysql_query("select * from beneficios where id='4' ") or die ('ERROR: Linea 7'.mysql_error());
		$fetchbeneficiosmed = mysql_fetch_array($stringbeneficiosmed);
		$beneficiomed = $fetchbeneficiosmed['monto'];
		
		$stringbeneficiosodo =  mysql_query("select * from beneficios where id='1' ") or die ('ERROR: Linea 11'.mysql_error());
		$fetchbeneficiosodo = mysql_fetch_array($stringbeneficiosodo);
		$beneficioodo = $fetchbeneficiosodo['monto'];
		
		$stringbeneficioslen =  mysql_query("select * from beneficios where id='2' ") or die ('ERROR: Linea 15'.mysql_error());
		$fetchbeneficioslen = mysql_fetch_array($stringbeneficioslen);
		$beneficiolen = $fetchbeneficioslen['monto'];
		
		$stringbeneficiosprot =  mysql_query("select * from beneficios where id='3' ") or die ('ERROR: Linea 19'.mysql_error());
		$fetchbeneficiosprot = mysql_fetch_array($stringbeneficiosprot);
		$beneficioprot = $fetchbeneficiosprot['monto'];

 if ($_GET['identificador'] == "Trabajador")
		
		 { 
		 $stringbuscartrabajador = mysql_query("select * from trabajador where cedula_trab = '$_GET[cedula]'") or die ('ERROR: Linea 20'.mysql_error());
		/*  PIDO SALDOS ACTUALES DEL TRABAJADOR */
		 $muestrabuscar = mysql_fetch_array($stringbuscartrabajador);
		 $echonombre = $muestrabuscar['nombre_trab'];
		 $echoapellido = $muestrabuscar['apellido_trab'];
		 $medactual = $muestrabuscar['salmed_trab'];
		 $odoactual = $muestrabuscar['salmedod_trab'];
		 $lenactual = $muestrabuscar['sallen_trab'];
		 $protactual = $muestrabuscar['salprot_trab'];
		 
		 }
		 
	 else if ($_GET['identificador'] == "Familiar")
		
		 {
		 $stringbuscarfamiliar = mysql_query("select * from familiar where cedula_fam = '$_GET[cedula]'") or die ('ERROR: Linea 21'.mysql_error());
		/*  PIDO SALDOS ACTUALES DEL FAMILIAR */
		 $muestrabuscar = mysql_fetch_array($stringbuscarfamiliar);
		 $echonombre = $muestrabuscar['nombre_fam'];
		 $echoapellido = $muestrabuscar['apellido_fam'];
		 $medactual = $muestrabuscar['salmed_fam'];
		 $odoactual = $muestrabuscar['salmedod_fam'];
		 $lenactual = $muestrabuscar['sallen_fam'];
		 $protactual = $muestrabuscar['salprot_fam'];
			 
		 }

if(isset($_GET['enviar_modfact']))
	{
		/* VERIFICO EL CODIGO VIEJO Y EL BENEFICIO VIEJO */
		$codigoviejo= $_GET['codigo_anterior'];
		$beneficioviejo = $_GET['gasto_viejo'];	 
		
			 /* CREO EL QUERY DE MODIFICACION PERO TODAVIA NO LO EJECUTO */
		 $stringmodificarfactura="UPDATE factura_trab SET codigo_fact = '$_GET[codigo_fact]', nombre_fact = '$_GET[nombre_fact]', identificador = '$_GET[identificador]', observacion_fact = '$_GET[observacion_fact]', fecha_fact = '$_GET[fecha_fact]', monto_fact = '$_GET[monto_fact]', tipogasto_fact = '$_GET[tipogasto_fact]' WHERE codigo_fact = '".$codigoviejo."'";
		
	 
	 if ($_GET['identificador'] == "Trabajador") 
	{	
		/* VERIFICO EL MONTO VIEJO, EL MONTO ACTUAL, Y LA CEDULA DEL TRABAJADOR */
		$suma = $_GET['mon'];
		$resta = $_GET['monto_fact'];
		$cedula1 = $_GET['cedula_trab'];
		
		/* AL BENEFICIO VIEJO LE DEVUELVO EL MONTO VIEJO PERO AUN NO GUARDO NADA EN LA BDD*/
		if ($beneficioviejo == "Medicinas")
		{
		$medactual = $medactual + $suma;
		if ($medactual > $beneficiomed) /* ESTOS IF ES PARA ASEGURARME QUE AL SUMAR EL MONTO VIEJO NO EXCEDA LOS SALDOS MAXIMOS */
		{$medactual = $beneficiomed;}
		}
		if ($beneficioviejo == "Odontologia")
		{
		$odoactual = $odoactual + $suma;
		if ($odoactual > $beneficioodo)
		{$odoactual = $beneficioodo;}
		}
		if ($beneficioviejo == "Lentes")
		{
		$lenactual = $lenactual + $suma;
		if ($lenactual > $beneficiolen)
		{$lenactual = $beneficiolen;}
		}
		if ($beneficioviejo == "Protesis")
		{
		$protactual = $protactual + $suma;
		if ($protactual > $beneficioprot)
		{$protactual = $beneficioprot;}
		}
		
			if  ($_GET['tipogasto_fact'] == "Medicinas")
		{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salmedresta = $medactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salmedresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalmed = "UPDATE trabajador SET salmed_trab = '".$salmedresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalmed = mysql_query($restarsalmed) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE trabajador SET salmedod_trab = '".$odoactual."', sallen_trab = '".$lenactual."', salprot_trab = '".$protactual."' where cedula_trab = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
	
		if  ($_GET['tipogasto_fact'] == "Odontologia")
			{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salmedodresta = $odoactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salmedodresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalmedod = "UPDATE trabajador SET salmedod_trab = '".$salmedodresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalmedod = mysql_query($restarsalmedod) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE trabajador SET salmed_trab = '".$medactual."', sallen_trab = '".$lenactual."', salprot_trab = '".$protactual."' where cedula_trab = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
		
		if  ($_GET['tipogasto_fact'] == "Lentes")
				{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$sallenresta = $lenactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($sallenresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsallen = "UPDATE trabajador SET sallen_trab = '".$sallenresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsallen = mysql_query($restarsallen) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE trabajador SET salmed_trab = '".$medactual."', salmedod_trab = '".$odoactual."', salprot_trab = '".$protactual."' where cedula_trab = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
		
		if  ($_GET['tipogasto_fact'] == "Protesis")
				{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salprotresta = $protactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salprotresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalprot = "UPDATE trabajador SET salprot_trab = '".$salprotresta."' where cedula_trab = '".$cedula1."'";
		  $sqlrestarsalprot = mysql_query($restarsalprot) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE trabajador SET salmed_trab = '".$medactual."', salmedod_trab = '".$odoactual."', sallen_trab = '".$lenactual."' where cedula_trab = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
	}
	
	if ($_GET['identificador'] == "Familiar") 
	{	
		/* VERIFICO EL MONTO VIEJO, EL MONTO ACTUAL, Y LA CEDULA DEL TRABAJADOR */
		$suma = $_GET['mon'];
		$resta = $_GET['monto_fact'];
		$cedula1 = $_GET['cedula_trab'];
		
		/* AL BENEFICIO VIEJO LE DEVUELVO EL MONTO VIEJO PERO AUN NO GUARDO NADA EN LA BDD*/
		if ($beneficioviejo == "Medicinas")
		{
		$medactual = $medactual + $suma;
		if ($medactual > $beneficiomed) /* ESTOS IF ES PARA ASEGURARME QUE AL SUMAR EL MONTO VIEJO NO EXCEDA LOS SALDOS MAXIMOS */
		{$medactual = $beneficiomed;}
		}
		if ($beneficioviejo == "Odontologia")
		{
		$odoactual = $odoactual + $suma;
		if ($odoactual > $beneficioodo)
		{$odoactual = $beneficioodo;}
		}
		if ($beneficioviejo == "Lentes")
		{
		$lenactual = $lenactual + $suma;
		if ($lenactual > $beneficiolen)
		{$lenactual = $beneficiolen;}
		}
		if ($beneficioviejo == "Protesis")
		{
		$protactual = $protactual + $suma;
		if ($protactual > $beneficioprot)
		{$protactual = $beneficioprot;}
		}
		
			if  ($_GET['tipogasto_fact'] == "Medicinas")
		{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salmedresta = $medactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salmedresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalmed = "UPDATE familiar SET salmed_fam = '".$salmedresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalmed = mysql_query($restarsalmed) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE familiar SET salmedod_fam = '".$odoactual."', sallen_fam = '".$lenactual."', salprot_fam = '".$protactual."' where cedula_fam = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
	
		if  ($_GET['tipogasto_fact'] == "Odontologia")
			{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salmedodresta = $odoactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salmedodresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalmedod = "UPDATE familiar SET salmedod_fam = '".$salmedodresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalmedod = mysql_query($restarsalmedod) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE familiar SET salmed_fam = '".$medactual."', sallen_fam = '".$lenactual."', salprot_fam = '".$protactual."' where cedula_fam = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
		
		if  ($_GET['tipogasto_fact'] == "Lentes")
				{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$sallenresta = $lenactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($sallenresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsallen = "UPDATE familiar SET sallen_fam = '".$sallenresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsallen = mysql_query($restarsallen) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE familiar SET salmed_fam = '".$medactual."', salmedod_fam = '".$odoactual."', salprot_fam = '".$protactual."' where cedula_fam = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
		
		if  ($_GET['tipogasto_fact'] == "Protesis")
				{ 
		/* RESTO EL MONTO NUEVO AL BENEFICIO NUEVO. AUN NO GUARDO NADA EN LA BDD */
			$salprotresta = $protactual - $resta;
		  
		  /* VERIFICO QUE EL NUEVO MONTO DE LA FACTURA NO SUPERA EL SALDO DISPONIBLE */
		  if ($salprotresta < 0)
		  { 
		  /* MONTO SUPERA EL SALDO, EL SISTEMA NO HA MODIFICADO NADA DE LA BDD Y PUEDO ECHAR LA FACTURA PARA ATRAS */
		   ?>
		<script>
		alert("Ha alcanzado el monto maximo disponible para este beneficio");
        window.history.back();</script>
		<?php  		  
		   }
		   
		  else
		  	{
		  /* EJECUTO TODOS LOS QUERY PARA GUARDAR LOS NUEVOS SALDOS Y MODIFICO LA FACTURA */
		  $sqlmodificarfactura=mysql_query($stringmodificarfactura) or die ("ERROR: Linea 61".mysql_error());
		  
		  $restarsalprot = "UPDATE familiar SET salprot_fam = '".$salprotresta."' where cedula_fam = '".$cedula1."'";
		  $sqlrestarsalprot = mysql_query($restarsalprot) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  $guardaotrosaldos = "UPDATE familiar SET salmed_fam = '".$medactual."', salmedod_fam = '".$odoactual."', sallen_fam = '".$lenactual."' where cedula_fam = '".$cedula1."' ";
		  $sqlguardasaldos = mysql_query($guardaotrosaldos) or die ("ERROR: Linea 63 ".mysql_error());
		  
		  ?>
		<script>
		alert("Factura Modificada Exitosamente");</script>
		<?php
		  	}
		}
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
<center>
<form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
  <input name="sec" type="hidden" value="ventanas/trabajador/modificar_factura" />
  <input name="mon" type="hidden" value="<?php echo $_GET['mon'] ?>" />
  <input name="gasto_viejo" type="hidden" value="<?php echo $_GET['gastoviejo'] ?>" />
<input name="cedula" type="hidden" value="<?php echo $_GET['cedula']; ?>" />
<fieldset id="cuerpofacturatrabajador" style="background-color:#FFF">
  
  <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center"><strong>MODIFICAR FACTURA</strong></legend>
 
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
 <td width="31%"><strong>Codigo Anterior</strong></td>
 <td width="69%"><input name="codigo_anterior" type="text" id="codigo_anterior" style="width:98%;height:100%;background:#FF9" value="<?php echo $_GET['codigo']?>" size="20" readonly="readonly" /></td>
 </tr>
 <tr>
    <td width="31%"><strong>Cedula</strong></td>
    <td width="69%"><input name="cedula_trab" type="text" id="cedula_trab" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['cedula']?>" size="20"readonly="readonly"  /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Nombre</strong></td>
    <td width="69%"><input name="" type="text" id="" style="width:98%; height:auto;background:#FF9" value="<?php echo $echonombre;?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Apellido</strong></td>
    <td width="69%"><input name="" type="text" id="" style="width:98%; height:auto;background:#FF9" value="<?php echo $echoapellido;?>" size="20" readonly="readonly" /></td>
  </tr>
 <tr>
    <td><strong>Tipo de Factura</strong></td>
    <td>
      <input name="identificador" type="text" id="identificador" style="width:98%; height:auto;background:#FF9" value="<?php echo $_GET['identificador']?>" size="20" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="31%"><strong>Codigo Nuevo</strong></td>
    <td width="69%"><input name="codigo_fact" type="text" maxlength="20" id="codigo_fact" style="width:98%; height:auto" size="20" /></td>
  </tr>
  <tr>
    <td><strong>Institucion/Farmacia/Medico</strong></td>
    <td>
      <input name="nombre_fact" type="text" maxlength="50" id="nombre_fact" style="width:98%" value="<?php echo $_GET['fac']?>" size="20" /></td>
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
      <input type="date" name="fecha_fact" id="fecha_fact" style="width:98%"  /></td>
  </tr>
  <tr>
    <td><strong>Monto</strong></td>
    <td>
      <input type="text" name="monto_fact" id="monto_fact" style="width:98%"  /></td>
  </tr>
 <tr>
    <td><strong>Tipo de Gasto</strong></td>
    <td>
      <select name="tipogasto_fact" id="tipogasto_fact" style="width:99%">
        <option value="0">Escoja tipo de Gasto</option>
        <option value="Medicinas">Medicinas</option>
        <option value="Odontologia">Odontologia</option>
        <option value="Lentes">Lentes</option>
        <option value="Protesis">Protesis</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
        <input type="submit" name="enviar_modfact" id="enviar_modfact" value="Enviar" />
    </td>
    </tr>
 </table>
</fieldset></form></center>
	<input name="" type="hidden" value="ventanas/consumos" />