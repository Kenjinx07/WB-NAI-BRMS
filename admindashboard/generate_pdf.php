<?php
require_once '../vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "records_management_system_db"; 
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate Request ID
if (!isset($_GET['R_ID']) || empty($_GET['R_ID'])) {
    die("Invalid request.");
}

$R_ID = mysqli_real_escape_string($conn, $_GET['R_ID']);

// Fetch Data from Database
$sql = "
    SELECT rr.R_ID, rr.Email, rr.Request_Type, rr.Request_Reason, rr.R_Date,
        u.F_Name, u.M_Name, u.L_Name, u.BirthDate, u.Nationality, 
        u.Civil_Status, u.Block, u.Lot, u.Subdivision, u.Barangay
    FROM request_records AS rr
    JOIN users AS u ON rr.Email = u.Email
    WHERE rr.R_ID = '$R_ID'
";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Format user details
    $full_name = strtoupper($data['F_Name'] . ' ' . $data['M_Name'] . ' ' . $data['L_Name']);
    $birth_date = date("F j, Y", strtotime($data['BirthDate']));
    $barangay = strtoupper($data['Barangay']);
    $address = strtoupper($data['Block'] . ", " . $data['Lot'] . ", " . $data['Subdivision']);
    $request_reason = ucfirst($data['Request_Reason']);
    $issued_day = date("j"); // Current day
    $issued_month = date("F"); // Current month
    $civil_status = $data['Civil_Status'];

    // Determine Certificate Type
    $certificateType = strtoupper(trim($data['Request_Type']));

    if (stripos($certificateType, "Barangay Clearance") !== false) {
        $templateFile = 'Barangay_Clearance.pdf';
    } elseif (stripos($certificateType, "Indigence Certificate") !== false) {
        $templateFile = 'Barangay_Indigency.pdf';
    } else {
        die("Invalid request type.");
    }

    // Initialize FPDI with TCPDF
    $pdf = new Fpdi();
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Load the correct PDF template
    $pdf->AddPage();
    $pdf->setSourceFile($templateFile);
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0, 210, 297); // Fit to A4 size

    // Set font for text overlay
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Black text

    // Fill details based on template type
    if ($templateFile === 'Barangay_Clearance.pdf') {
        $pdf->SetXY(45, 80); // Full Name
        $pdf->Cell(100, 10, $full_name, 0, 0, 'L');

        $pdf->SetXY(135, 80); // Birth Date
        $pdf->Cell(100, 10, $birth_date, 0, 0, 'L');

        $pdf->SetXY(70, 95); // Barangay Resident Since
        $pdf->Cell(100, 10, $barangay, 0, 0, 'L');

        $pdf->SetXY(50, 110); // Address (Block, Lot, Subdivision)
        $pdf->Cell(130, 10, $address, 0, 0, 'L');

        $pdf->SetXY(50, 125); // Request Reason
        $pdf->MultiCell(120, 6, $request_reason, 0, 'L');

        $pdf->SetXY(50, 155); // Issued Date
        $pdf->Cell(100, 10, "Issued this {$issued_month} day of {$issued_day}, 2025", 0, 0, 'L');

        // Civil Status Check Mark Placement
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->SetTextColor(0, 0, 0); // Black

        $status_positions = [
            "Single" => [35, 85], // Adjust X, Y as needed
            "Married" => [55, 85],
            "Separated" => [75, 85],
            "Widow/Widower" => [95, 85]
        ];

        if (isset($status_positions[$civil_status])) {
            list($x, $y) = $status_positions[$civil_status];
            $pdf->SetXY($x, $y);
            $pdf->Cell(5, 5, "/", 0, 0, 'C'); // Check mark
        }
    } 
    elseif ($templateFile === 'Barangay_Indigency.pdf') {
        $pdf->SetXY(50, 80); // Full Name
        $pdf->Cell(100, 10, $full_name, 0, 0, 'L');

        $pdf->SetXY(50, 95); // Barangay
        $pdf->Cell(100, 10, $barangay, 0, 0, 'L');

        $pdf->SetXY(50, 135); // Issued Date
        $pdf->Cell(100, 10, "Issued this {$issued_month} day of {$issued_day}, 2025", 0, 0, 'L');
    }

    // Output the generated PDF
    $outputFilename = strtolower(str_replace(' ', '_', $certificateType)) . '.pdf';
    $pdf->Output($outputFilename, 'I');

} else {
    echo "No record found.";
}

// Close Connection
mysqli_close($conn);
?>
