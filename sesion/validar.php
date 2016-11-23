<?php

include("../bdd/funciones_mysql.php");
conectar();

if (!empty($_POST['nick_usuario']) && !empty($_POST['clave_usuario']))
{
$usu=$_POST['nick_usuario'];
$clav=$_POST['clave_usuario'];
$STRINGINGRESO="select * from usuario where nick_usuario='".$usu."'";
$SQLINGRESO=mysql_query($STRINGINGRESO);
$FILASINGRESO=mysql_num_rows($SQLINGRESO);

if($FILASINGRESO==1)
{
for($is=1;$is<=$FILASINGRESO;$is++)
{
		$rs=mysql_fetch_array($SQLINGRESO);
   		$usuario_sistema=$rs['nick_usuario'];
		$clave_sistema=$rs['clave_usuario'];
		$nombre_sistema=$rs['nombre_usuario'];
		$apellido_sistema=$rs['apellido_usuario'];
		$tipo_sistema=$rs['tipo_usuario'];
		
		if($clav==$clave_sistema)
		{
		session_start();
		$_SESSION['usuario']=$usuario_sistema;
		$_SESSION['clave']=$clave_sistema;
		$_SESSION['nombre']=$nombre_sistema;
		$_SESSION['cargo']=$apellido_sistema;
		$_SESSION['tipo']=$tipo_sistema;
		pasar("index.php");
		}
        else
		{
			pasar("msj.php?msj=no_password");
		}
}

}
else 
{
	pasar("msj.php?msj=no_usu");
}
session_start();
}
?>