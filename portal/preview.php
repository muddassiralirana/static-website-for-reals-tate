<?php
include 'actions/config.php';
session_start();
require('fpdf.php');

$inv_sql = "SELECT * FROM invoice _invoice WHERE  _invoice.id = '".$_GET['id']."' ";
$inv = mysqli_query($conn,$inv_sql);
$invoice = mysqli_fetch_array($inv,MYSQLI_ASSOC);

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../images/joe-logo.png',10,6,30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Ln(20);
$pdf->Cell(1,1,'Invoice# '.$invoice['invoice-number'],0,1);
$pdf->Cell(1,10,'Order Date: '.$invoice['order-date'],0,1);
// Move to the right

$pdf->Multicell(90,6,"Company: \n Company name \n Company Address \n Columbus Ohio, USA \n Contact# 614 - 00 000",1);
$pdf->Ln(-30);
$pdf->Cell(95);
$pdf->Multicell(90,6,"Customer: \n "
.$invoice['client-name']." \n "
.$invoice['client-address']." \n "
.$invoice['client-city']." "
.$invoice['client-state']." "
.$invoice['client-zipcode']. " "
.$invoice['client-country']. " \n "
."Contact# ".$invoice['client-contact-no'],1);

// Colors, line width and bold font
$pdf->SetFillColor(211,211,211);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.3);

// Column widths
$w = array(70,70, 40);
$pdf->Ln(15);

$pdf->Cell($w[0],7,"Service Item",1,0,'C',true);
$pdf->Cell($w[1],7,"Description",1,0,'C',true);
$pdf->Cell($w[2],7,"Amount",1,0,'C',true);
$pdf->Ln();
$pdf->Cell($w[0],6,$invoice['service-item'],'LR',0);
$pdf->Cell($w[1],6,$invoice['description'],'LR',0);
$pdf->Cell($w[2],6,"$".$invoice['amount'],'LR',0);

$sum = $_POST['amount'];
for($x = 0; $x<=$_POST['total-services'] ; $x++ ) {
    $pdf->Cell($w[0],6,$_POST['service-item'.$x],'LR',0);
    $pdf->Cell($w[1],6,$_POST['description'.$x],'LR',0);
    $pdf->Cell($w[2],6,"$".$_POST['amount'.$x],'LR',0);
    $sum = $sum + $_POST['amount'.$x];
    $pdf->Ln();
}


$pdf->Cell(($w[0]+$w[1]),10,"Total",'LRT',0,'L');
$pdf->Cell($w[2],10,"$".$sum,'LRT',0,'L',true);
$pdf->Ln();

// Closing line
$pdf->Cell(array_sum($w),0,'','T');
$pdf->Output('I');
$conn->close();
?>