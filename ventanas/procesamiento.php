<?php
    include("../sesion.php");
    include("../bdd/funciones_mysql.php");
    conectar();

    $SQLTRUNCAR=mysql_query("truncate table txta") or die("ERROR AL ELIMINAR LOS DATOS".mysql_error());

    $BUSQUEDA="select * from trabajador where dependencia_trab='".$_GET['municipiocn']."' order by codigo_trab asc";
    $SQL=mysql_query($BUSQUEDA) or die ("ERROR AL SELECCIONAR LOS DATOS: ".mysql_error());
    $CANTIDADPERSONAS=mysql_num_rows($SQL);

    //$tdesdeas=strtotime(str_replace("/", "-",$_GET['fechacn']));
    //$SQLdesdeas = date("Y-m-d",$tdesdeas);
    $SQLmescn=$_GET['mescn'];
    $SQLaniocn=$_GET['aniocn'];

    for ($i=1; $i<=$CANTIDADPERSONAS;$i++)
    {
        $FILA=mysql_fetch_array($SQL);
        $cbd=$FILA['cedula_trab'];

        $select2=mysql_query("select * from factura_trab  where cedula_trab=$FILA[cedula_trab] and month(fecha_fact)='$SQLmescn' and year(fecha_fact)= $SQLaniocn");
        $CANTIDADA=mysql_num_rows($select2);

        $SUMAASIGNACIONESUNO=0;
        for ($j=1; $j<=$CANTIDADA;$j++)
        {
            $FILADOS=mysql_fetch_array($select2);
            $SUMAASIGNACIONESUNO=$SUMAASIGNACIONESUNO+number_format($FILADOS["monto_fact"], 2, ".", "");
        }

        $SUMATOTALUNO=number_format($SUMAASIGNACIONESUNO, 2, ".", "");

        $NACIONAL='V';
        $NCOMPLETO=$FILA['apellido_trab']." ".$FILA['nombre_trab'];
        $NCUENTA=$FILA['numero_cuenta'];

        $STRINGINGRESAR="insert into txta (nacionalidad_texto, cedula_texto, nombre_texto, numero_cuenta_texto, monto_texto, municipio_texto, tipo_banco) values ('$NACIONAL','$cbd','$NCOMPLETO','$NCUENTA','$SUMATOTALUNO','$_GET[municipiocn]','CARONI')";

        $SQLINGRESAR=mysql_query($STRINGINGRESAR) or die("ERROR AL GUARDAR LOS DATOS".mysql_error());
    }

    switch( $_GET['procesar'] ) 
    {
        case "TXT": 
        {
            $STRINGXTA="select * from txta where municipio_texto ='".$_GET['municipiocn']."' and numero_cuenta_texto !='' and nombre_texto !='VACANTE'";
            $SQLTXTA=mysql_query($STRINGXTA) or die ("Error 01: ".mysql_error());
            $CANTIDADPERSONASTXTA=mysql_num_rows($SQLTXTA);
            $ITXTA=1;
            if($CANTIDADPERSONASTXTA > 0)
            {
                for ($ITXTA=1; $ITXTA<=$CANTIDADPERSONASTXTA;$ITXTA++)
                {
                    $FILATRES=mysql_fetch_array($SQLTXTA);
                    $NACIONALIDAD_TEXTO=$FILATRES["nacionalidad_texto"];
                    $CEDULA_TEXTO=$FILATRES["cedula_texto"];
                    $NOMBRE_TEXTO=str_replace(",", "", str_replace(".", "",$FILATRES["nombre_texto"]));
                    $MONTO_TEXTO=number_format($FILATRES["monto_texto"], 2, "", "");
                    $NUMERO_CUENTA_TEXTO=$FILATRES["numero_cuenta_texto"];
                    $nacionalidad=str_pad($NACIONALIDAD_TEXTO, 1);
                    $cedula=str_pad($CEDULA_TEXTO, 10, "0", STR_PAD_LEFT);
                    $nombrea=str_pad($NOMBRE_TEXTO,40,"0", STR_PAD_RIGHT);
                    $nombreb=str_replace("0", " ",$nombrea);
                    $monto=str_pad($MONTO_TEXTO, 10, "0", STR_PAD_LEFT);
                    $numero_cuenta=str_pad($NUMERO_CUENTA_TEXTO, 20);
		
                    $nombre=$nacionalidad.$cedula.$nombreb.$numero_cuenta.$monto.chr(13).chr(10);
		
                    $nombre_archivo = 'txtcaroni/'.$_GET['nombre_archivo'].'.txt'; 
                    $contenido = $nombre; 
                    fopen($nombre_archivo, 'a+'); 

                    // Asegurarse primero de que el archivo existe y puede escribirse sobre el. 
                    if (is_writable($nombre_archivo)) 
                    { 
                        if($ITXTA==1)
                        {
                            unlink("../ventanas/txtcaroni/".$_GET['nombre_archivo'].".txt");	
                        }
                        // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adicion. 
                        // El apuntador de archivo se encuentra al final del archivo, asi que 
                        // alli es donde ira $contenido cuando llamemos fwrite(). 
                        if (!$gestor = fopen($nombre_archivo, 'a')) 
                        { 
                              echo "No se puede abrir el archivo ($nombre_archivo)"; 
                              exit; 
                        } 

                        // Escribir $contenido a nuestro arcivo abierto. 
                        if (fwrite($gestor, $contenido) === FALSE) 
                        { 
                            echo "No se puede escribir al archivo ($nombre_archivo)"; 
                            exit; 
                        } 
    
                        fclose($gestor); 

                    } 
                    else 
                    { 
                        echo "No se puede escribir sobre el archivo $nombre_archivo"; 
                    } 
            
                }
                $enlace01 = "../ventanas/txtcaroni/".$_GET['nombre_archivo'].".txt";
            }
            else
            {
                $nombre_archivo = "txtcaroni/".$_GET['nombre_archivo']."SINTRABAJADORES.txt"; 
                $contenido = "No hay trabajadores que cobren por banco, todos cobran por cheque esta fecha"; 
                fopen($nombre_archivo, 'a+'); 
                if (is_writable($nombre_archivo)) 
                { 
                    if($ITXTA==1)
                    {
                        unlink("../ventanas/txtcaroni/".$_GET['nombre_archivo']."SINTRABAJADORES.txt");	
                    }
                    // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adicion. 
                    // El apuntador de archivo se encuentra al final del archivo, asi que 
                    // alli es donde ira $contenido cuando llamemos fwrite(). 
                    if (!$gestor = fopen($nombre_archivo, 'a')) 
                    { 
                        echo "No se puede abrir el archivo ($nombre_archivo)"; 
                        exit; 
                    } 

                    // Escribir $contenido a nuestro arcivo abierto. 
                    if (fwrite($gestor, $contenido) === FALSE) 
                    { 
                        echo "No se puede escribir al archivo ($nombre_archivo)"; 
                        exit; 
                    } 

                    fclose($gestor); 

                    } 
                    else 
                    { 
                        echo "No se puede escribir sobre el archivo $nombre_archivo"; 
                    }
                    $enlace01 = "../ventanas/txtcaroni/".$_GET['nombre_archivo']."SINTRABAJADORES.txt";
                }
            //header ("location:../ventanas/txtcaroni/".$_GET['nombre_archivo'].".txt");
			//chmod("/var/www/sicob_bs/ventanas/txtcaroni/".$_GET['nombre_archivo'].".txt",0777);
            $enlace = $enlace01;
            header ("Content-Disposition: attachment; filename=".$_GET['nombre_archivo'].".txt");
            header ("Content-Type: text/plain");
            header ("Content-Length: ".filesize($enlace));
            readfile($enlace);
        }
        break;
        case "PDF": header ("location:../reportes_pdf/reportecaroni.php?mescn=".$_GET['mescn']."&aniocn=".$_GET['aniocn']."&municipiocn=".$_GET['municipiocn']."");
        break;
    }
?>