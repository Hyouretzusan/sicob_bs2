<?php
require('fpdf.php');

include("../sesion.php");
include("../bdd/funciones_mysql.php");
conectar();

//$stringbanavih="select * from txtb where municipio_textob=$_get[municipiocn] order by cedula_textob asc";
$stringcaroni="select * from txta where nombre_texto not like '%VACANTE%' and numero_cuenta_texto != '' order by cedula_texto asc";
$sqlcaroni=mysql_query($stringcaroni);
$filascaroni=mysql_num_rows($sqlcaroni);

$stringcaronicheque="select * from txta where nombre_texto not like '%VACANTE%' and numero_cuenta_texto = '' order by cedula_texto asc";
$sqlcaronicheque=mysql_query($stringcaronicheque);
$filascaronicheque=mysql_num_rows($sqlcaronicheque);

$stringvacante="select * from txta where nombre_texto like '%VACANTE%' order by cedula_texto asc";
$sqlvacante=mysql_query($stringvacante);
$filasvacante=mysql_num_rows($sqlvacante);

$acumuladocaroni=0;
$acumuladocaronicheque=0;
$contadorcheque=0;
$contadorchequefinal=0;

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(185,15,'Banco Caroni - Personas que Cobran por Banco',0,0,'C');
$pdf->SetFont('Arial','',9);
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(10);

$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(8,15,'NAC',0,0,'L');
$pdf->Cell(20,15,'CEDULA:',0,0,'R');
$pdf->Cell(80,15,'NOMBRE:',0,0,'L');
$pdf->Cell(40,15,'NUMERO DE CUENTA:',0,0,'L');
$pdf->Cell(25,15,'MONTO:',0,0,'C');
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
for ($cb=1; $cb<=$filascaroni;$cb++)
{
	$camposcaroni=mysql_fetch_array($sqlcaroni);
	$ncompleto=$camposbanavih['primer_apellido_textob']." ".$camposbanavih['segundo_apellido_textob']." ".$camposbanavih['primer_nombre_textob']." ".$camposbanavih['segundo_nombre_textob'];
	if($contador==29)
	{
		$pdf->ln(7);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(145,06,'SUB-TOTAL:',0,0,'R');
		$pdf->Cell(25,06,number_format($acumuladocaroni, 2, ",", "."),0,0,'R');
		$pdf->SetFont('Arial','',9);
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->AddPage();
		if(strtoupper($act_u)=='LCDO. NESTOR TORO'and $_GET[municipiocn]==51)
		{
			$pdf->Cell(185,15,'SUPLENTES FIJOS FINANCIADOS POR LA RED HOSPITALARIA',0,0,'C');
			$pdf->ln(4);
			$pdf->Cell(185,15,'FISICAMENTE LABORANDO EN LOS MUNICIPIOS DEL ESTADO MONAGAS',0,0,'C');
			$pdf->ln(8);
		}
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(185,15,'Banco Caroni - Personas que Cobran por Banco',0,0,'C');
		$pdf->SetFont('Arial','',9);
		$pdf->ln(6);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(10);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(8,15,'NAC',0,0,'L');
		$pdf->Cell(20,15,'CEDULA:',0,0,'R');
		$pdf->Cell(80,15,'NOMBRE:',0,0,'L');
		$pdf->Cell(40,15,'NUMERO DE CUENTA',0,0,'L');
		$pdf->Cell(25,15,'MONTO:',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$contador=0;
		
	}
	if($camposcaroni['monto_texto']!=0)
	{
		$pdf->Cell(8,15,$camposcaroni['nacionalidad_texto'],0,0,'C');
		$pdf->Cell(20,15,str_pad($camposcaroni['cedula_texto'], 10, "0", STR_PAD_LEFT),0,0,'R');
		$pdf->Cell(80,15,$camposcaroni['nombre_texto'],0,0,'L');
		$pdf->Cell(35,15,$camposcaroni['numero_cuenta_texto'],0,0,'C');
		$pdf->Cell(35,15,str_pad(number_format($camposcaroni['monto_texto'], 2, "", ""), 10, "0", STR_PAD_LEFT),0,0,'C');
		$acumuladocaroni=$acumuladocaroni+$camposcaroni['monto_texto'];
		$pdf->ln(6);
		$contador=$contador+1;
	}
}
$pdf->ln(7);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(145,06,'TOTAL:',0,0,'R');
$pdf->Cell(25,06,number_format($acumuladocaroni, 2, ",", "."),0,0,'R');
$pdf->SetFont('Arial','',9);
$pdf->ln(1);
$pdf->cell(90,06,'____________________________________________________________________________________________________________');
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(185,15,'Banco Caroni - Personas que Cobran por Cheque',0,0,'C');
$pdf->SetFont('Arial','',9);
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(10);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(8,15,'NAC',0,0,'L');
$pdf->Cell(20,15,'CEDULA:',0,0,'R');
$pdf->Cell(120,15,'NOMBRE:',0,0,'L');
//$pdf->Cell(40,15,'NUMERO DE CUENTA:',0,0,'L');
$pdf->Cell(30,15,'MONTO:',0,0,'R');
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
for ($cbcheque=1; $cbcheque<=$filascaronicheque;$cbcheque++)
{
	$camposcaronicheque=mysql_fetch_array($sqlcaronicheque);
	$ncompletocheque=$camposcaronicheque['nombre_texto'];
	if($contadorcheque==29)
	{	
		$pdf->ln(7);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(145,06,'SUB-TOTAL:',0,0,'R');
		$pdf->Cell(25,06,number_format($acumuladocaronicheque, 2, ",", "."),0,0,'R');
		$pdf->SetFont('Arial','',9);
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->AddPage();
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(185,15,'Banco Caroni - Personas que Cobran por Cheque',0,0,'C');
		$pdf->SetFont('Arial','',9);
		$pdf->ln(6);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(10);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$pdf->Cell(8,15,'NAC',0,0,'L');
		$pdf->Cell(20,15,'CEDULA:',0,0,'R');
		$pdf->Cell(80,15,'NOMBRE:',0,0,'L');
		//$pdf->Cell(40,15,'NUMERO DE CUENTA',0,0,'L');
		$pdf->Cell(30,15,'MONTO:',0,0,'R');
		$pdf->ln(6);
		$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
		$pdf->ln(1);
		$contadorcheque=0;
		
	}
	if($camposcaronicheque['monto_texto']!=0)
	{
		$pdf->Cell(8,15,str_replace('','V',$camposcaronicheque['nacionalidad_texto']),0,0,'C');
		$pdf->Cell(20,15,number_format($camposcaronicheque['cedula_texto'], 0, "", "."),0,0,'R');
		$pdf->Cell(115,15,$camposcaronicheque['nombre_texto'],0,0,'L');
		//$pdf->Cell(35,15,'--',0,0,'C');
		$pdf->Cell(35,15,number_format($camposcaronicheque['monto_texto'], 2, ",", "."),0,0,'C');
		$pdf->ln(6);
		$acumuladocaronicheque=$acumuladocaronicheque+$camposcaronicheque['monto_texto'];
		$contadorcheque=$contadorcheque+1;
		$contadorchequefinal=$contadorchequefinal+1;
	}
}
$pdf->ln(7);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(145,06,'TOTAL:',0,0,'R');
$pdf->Cell(25,06,number_format($acumuladocaronicheque, 2, ",", "."),0,0,'R');
$pdf->SetFont('Arial','',9);
$pdf->ln(1);
$pdf->cell(90,06,'____________________________________________________________________________________________________________');
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(185,15,'RESUMEN',0,0,'C');
$pdf->SetFont('Arial','',9);
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(4);
$pdf->SetFont('Arial','',9);
$pdf->ln(6);
$pdf->SetFont('Arial','',10);
//$pdf->SetFont('Arial','',12);
$pdf->Cell(180,15,'MONTO TOTAL DE PERSONAS QUE COBRAN POR BANCO: ....................................',0,0,'L');
$pdf->Cell(10,15,number_format($acumuladocaroni, 2, ",", "."),0,0,'R');
$pdf->ln(6);
$pdf->Cell(180,15,'MONTO TOTAL DE PERSONAS QUE COBRAN POR CHEQUE: ..................................',0,0,'L');
$pdf->Cell(10,15,number_format($acumuladocaronicheque, 2, ",", "."),0,0,'R');
$pdf->ln(6);
////$pdf->Cell(180,15,'TOTAL DE VACANTES NO INCLUIDOS EN EL REPORTE: ........................................................',0,0,'L');
////$pdf->Cell(10,15,$filasvacante,0,0,'R');
//$pdf->ln(18);
//$pdf->SetFont('Arial','B',14);
$pdf->Cell(180,15,'TOTAL GENERAL .............................................................................................................',0,0,'L');
$pdf->Cell(10,15,number_format($acumuladocaroni+$acumuladocaronicheque, 2, ",", "."),0,0,'R');
$pdf->SetFont('Arial','',9);
$pdf->ln(10);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(88,15,'TOTAL DE CARGOS QUE COBRAN POR BANCO:');
$pdf->Cell(10,15,$filascaroni,0,0,'R');
$pdf->ln(6);
$pdf->Cell(88,15,'TOTAL DE CARGOS QUE COBRAN POR CHEQUE:');
$pdf->Cell(10,15,$contadorchequefinal,0,0,'R');
$pdf->ln(6);
$pdf->Cell(88,15,'TOTAL GENERAL DE CARGOS:');
$pdf->Cell(10,15,$filascaroni+$contadorchequefinal,0,0,'R');
$pdf->SetFont('Arial','',9);
$pdf->ln(6);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(1);
$pdf->Cell(90,06,'____________________________________________________________________________________________________________');
$pdf->ln(20);
$pdf->output();
?>


