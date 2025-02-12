<?php 
require_once '../vendor/autoload.php';
$servername = "localhost";
$username = "root";
$password = "";
$database = "records_management_system_db"; 
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['R_ID'])) {
        $R_ID = $_GET['R_ID'];
        $sql = "SELECT * FROM request_records WHERE R_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $R_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $request = $result->fetch_assoc();
        
        
    if (isset($_GET['ID_No'])) {
        $ID_No = $_GET['ID_No'];
        $sql = "SELECT * FROM users WHERE ID_No = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $ID_No);
        $stmt->execute();
        $result = $stmt->get_result();
        $request = $result->fetch_assoc();
        
        if (!$request) {
            die("Request not found.");
        }
    }
}

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

$pdf->SetFont('Helvetica', 'B', 16);
$pdf->Cell(0, 10, 'BARANGAY PASONG BUAYA II', 0, 1, 'C');
$pdf->SetFont('Helvetica', 'B', 14);
$pdf->Cell(0, 5, 'CITY OF IMUS, PROVINCE OF CAVITE', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Helvetica', 'B', 18);
$pdf->Cell(0, 10, 'BARANGAY CERTIFICATION', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Helvetica', '', 12);
$text = "To Whom It May Concern:\n\nThis is to certify that Mr./Ms./Mrs. " . strtoupper($request['RF_Name']) . "\n\n"
      . "( X ) Single    ( ) Separated    ( ) Widow/Widower    ( ) Married\n\n"
      . "Born on " . "\n"
      . "Filipino and a resident of this Barangay since 2004\n"
      . "with postal address at B7 L18 KAPATIRAN VILLAGE.\n\n"
      . "He/She is personally known to be a law-abiding citizen and has a good moral character.\n"
      . "Records of this Barangay show that he/she has not committed nor been involved in unlawful activities.\n\n"
      . "This certificate is issued upon request for MEDICAL ASSISTANCE.\n\n"
      . "Issued this 3rd day of FEBRUARY, 2025.";
$pdf->MultiCell(0, 10, $text, 0, 'L');

$pdf->Ln(10);
$pdf->Cell(0, 10, '_________________________', 0, 1, 'C');
$pdf->Cell(0, 5, 'Signature of Applicant', 0, 1, 'C');

$pdf->Image('applicant.jpg', 85, 170, 40, 40, '', '', '', false, 300);

$pdf->Ln(50);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 5, 'HON. CARLITO C. TAGLE', 0, 1, 'R');
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, 'Barangay Chairman', 0, 1, 'R');

$pdf->Output('barangay_certificate.pdf', 'I');
?>