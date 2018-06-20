<?php
require('fpdf181/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // $this->Image('http://www.csb.gov.in/assets/csblogo.png',10,6,30);
    $title1='Application For Registration /Renewal As A Silkworm';
    $title2='Seed Cocoon Producer';
    $this->SetFont('Arial','B',18);
    // Calculate width of title and position
    $w =200;
    $this->SetX(1+(220-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(220,230,200);
    $this->SetFillColor(230,230,200);
    $this->SetTextColor(20,50,50);
    $this->Cell(180,10,$title1,1,1,'C',true);
    $this->SetX(1+(220-$w)/2);
    $this->Cell(180,10,$title2,1,1,'C',true);
    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFillColor(230,0,0);
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
session_start();
//$_SESSION['name'] = 8123452478 ;
$ph_number = $_SESSION['name'];
//echo $ph_number;
$connect=mysqli_connect("localhost","root","","sericulture");
$query="SELECT * FROM producer WHERE mobile='$ph_number'";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_array($result);
//session_destroy();


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();
//echo $row['mobile'];
$pdf->Image('produce_photo.jpg',158,90,26,35);

$pdf->SetFont('Times','BU',16);
$pdf->Cell(0,12,'Application form',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Times','B',14);
$pdf->Cell(120,9,'ACKNOWLEDGMENT NUMBER:',1,0);
$pdf->SetFont('Times','U',14);
$pdf->Cell(60,9,$row['ack_number'],1,1,'C');
$pdf->Ln(8);

$pdf->SetFont('Times','B',16);
$pdf->SetFillColor(230,230,200);
$pdf->Cell(0,10,'Personal Details:',0,1);
$pdf->Ln(5);
$pdf->SetFont('Times','B',14);
$pdf->Cell(80,9,'First Name:',1,0);
$pdf->SetFont('Times','',14);
$fname = $row['fname'];
$pdf->Cell(60,9,$row['fname'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(80,9,'Middle Name:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(60,9,$row['mname'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(80,9,'Last Name:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(60,9,$row['lname'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(80,9,'Father Name/mother/husband:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(60,9,$row['mname'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(40,9,'Phone Number',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(50,9,$row['mobile'],1,0);
$pdf->SetFont('Times','B',14);
$pdf->Cell(40,9,'landline Number',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(55,9,$row['land_line'],1,1);
$pdf->Ln(3);

$pdf->SetFont('Times','B',14);
$pdf->Cell(20,9,'Address:',0,0);
$pdf->SetFont('Times','',14);
$add="door_no area taluk districk state pincode";
$pdf->MultiCell(140,8,$add,0,1);
$pdf->Ln(5);

$pdf->SetFont('Times','B',16);
$pdf->Cell(0,10,'M Details:',0,1);

$pdf->Ln(5);
$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Kind of pure silkworm race rared:',1,0);
$pdf->SetFont('Times','',14);
$pdf->MultiCell(90,9,$row['pure_silk_proposed'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(45,9,'Sector:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(45,9,$row['sector'],1,0);

$pdf->SetFont('Times','B',14);
$pdf->Cell(45,9,'Applicant type:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(45,9,$row['app_type'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Rearing house ownership:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(90,9,$row['house_owner'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Separate rearing house?',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(90,9,$row['rearing_done_sep'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Mulberry garden/host plant:',1,0);
$pdf->SetFont('Times','',16);
$pdf->Cell(90,9,$row['host_plant_1'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Capacity of rearing house:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(90,9,$row['capacity'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Mulberry/host plant:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(90,9,$row['host_plant_2'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(90,9,'Year of establishment:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(90,9,$row['year_estab'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(45,9,'Demand draft No.:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(45,9,$row['dd_number'],1,0);

$pdf->SetFont('Times','B',14);
$pdf->Cell(45,9,'DD Date:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(45,9,$row['dd_date'],1,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(60,9,'For Renewal:',1,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(120,9,'Enclose copy of previous registration certificates',1,1);

$pdf->AddPage();
$pdf->Image('sign_photo.jpg',130,120,26,15);

$pdf->SetFont('Times','B',14);
$pdf->Cell(40,9,'Other Details:',0,0);
$pdf->SetFont('Times','',14);
$pdf->multiCell(120,9,$row['other_details'],0,1);
$pdf->Ln(40);

$pdf->SetFont('Times','B','U',16);
$pdf->Cell(0,9,'DECLARATION:',0,1,'C');
$text='I/We declare that the information given above is true to the best of my/our knowledge and belief and no part thereof is false.';
$pdf->SetFont('Times','',16);
$pdf->MultiCell(0,8,$text,0,1);
$pdf->Ln(15);

$pdf->SetFont('Times','B',14);
$pdf->Cell(30,9,'Place:',0,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(50,9,$row['area'],0,1);
$pdf->Ln(5);

$pdf->SetFont('Times','B',14);
$pdf->Cell(30,9,'Date:',0,0);
$pdf->SetFont('Times','',14);
$pdf->Cell(50,9,substr($row['date'],0,10),0,0);

$pdf->SetFont('Times','',14);
$pdf->Cell(0,9,'Signature of the Applicant',0,1,'C');

//$pdf->SetFont('Times','B',14);
//$pdf->Cell(40,9,'Enclosures:',0,1);
//$pdf->SetFont('Times','',14);
//$pdf->Cell(40,9,'()',0,0);
$pdf->Output();
?>
