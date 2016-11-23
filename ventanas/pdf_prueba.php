<?php 
include("bdd/funciones_mysql.php");
conectar();
extract ($_GET);
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times New Roman','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();


?>