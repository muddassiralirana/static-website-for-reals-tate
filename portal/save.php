<?php
include 'actions/config.php';
session_start();
require('fpdf.php');
//require('html2pdf.php');
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
$pdf->Cell(1,1,'Invoice# '.$_POST['invoice-number'],0,1);
$pdf->Cell(1,10,'Order Date: '.$_POST['order-date'],0,1);
// Move to the right

$pdf->Multicell(90,6,"Company: \n Company name \n Company Address \n Columbus Ohio, USA \n Contact# 614 - 00 000",1);
$pdf->Ln(-30);
$pdf->Cell(95);
$pdf->Multicell(90,6,"Customer: \n "
.$_POST['client-name']." \n "
.$_POST['client-address']." \n "
.$_POST['client-city']." "
.$_POST['client-state']." "
.$_POST['client-zipcode']. " "
.$_POST['client-country']. " \n "
."Contact# ".$_POST['client-contact-no'],1);

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
$pdf->Cell($w[0],6,$_POST['service-item'],'LR',0);
$pdf->Cell($w[1],6,$_POST['description'],'LR',0);
$pdf->Cell($w[2],6,"$".$_POST['amount'],'LR',0);

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
$sql = "INSERT INTO 
`invoice`(
    `invoice-number`,
     `client-name`, 
     `client-address`, 
     `client-city`, 
     `client-state`, 
     `client-zipcode`, 
     `client-country`, 
     `order-date`, 
     `client-contact-no`, 
     `service-item`, 
     `description`, 
     `amount`, 
     `is_available`, 
     `is_send`,
     `created_by`) VALUES(
         '".$_POST['invoice-number']."',
         '".$_POST['client-name']."',
         '".$_POST['client-address']."',
         '".$_POST['client-city']."',
         '".$_POST['client-state']."',
         '".$_POST['client-zipcode']."',
         '".$_POST['client-country']."',
         '".$_POST['order-date']."',
         '".$_POST['client-contact-no']."',
         '".$_POST['service-item']."',
         '".$_POST['description']."',
         '".$_POST['amount']."',
         1,
         1,
         '".$_POST['created_by']."')";

if ($conn->query($sql) === TRUE) {
    $pdf->Output('I');
}
$conn->close();
?>