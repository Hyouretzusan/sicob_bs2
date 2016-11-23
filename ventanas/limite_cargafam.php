<?php 

extract ($_GET);
 
 function limite_prueba(){
	 echo 'AQUI IRIA OPERACIONES Y FUNCIONES XDXDXDXD NAAAHHH';
	 }
	 
 function limite_cargafam($cualquiera){
	
 $buscacarga = mysql_query("select * from familiar where cedula_trab = '$cualquiera'");
 $infocarga = mysql_fetch_array($buscacarga);
 $numcarga = mysql_num_rows($buscacarga);
	/* echo "$numcarga <br>"; */
		
		if($numcarga>100)	
		    {
			?>
			<script>
		alert("El ciudadano ha superado el limite de familiares que puede incluir en su carga familiar"); 
		window.history.back(); 
		
        </script>
			<?php 
			}
		else if($numcarga < 101)
	 	{
			/* hay algun comando que me envie directo a la factura? o aqui incluyo las operaciones de incluir factura?*/
		}
		}
		
?>
 