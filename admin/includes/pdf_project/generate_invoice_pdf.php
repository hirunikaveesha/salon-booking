<?php
require('../pdf_project/fpdf.php');
// Include the dbconnection.php file from the correct path
require('../../includes/dbconnection.php');

// Function to generate the invoice PDF
function generateInvoicePDF($invoiceId) {
    global $con; // Use the global $con variable inside this function

    // Create a new PDF object
    $pdf = new FPDF();
    
    // Add a page to the PDF
    $pdf->AddPage();
    
    // Set font
    $pdf->SetFont('Arial', 'B', 16);
    
    // Fetch invoice details from the database
    $query = "SELECT tblinvoice.BillingId, date(tblinvoice.PostingDate) AS invoicedate, tbluser.FirstName, tbluser.LastName, tbluser.Email, tbluser.MobileNumber, tbluser.RegDate, tblservices.ServiceName, tblservices.Cost
        FROM tblinvoice 
        JOIN tbluser ON tbluser.ID = tblinvoice.Userid 
        JOIN tblservices ON tblservices.ID = tblinvoice.ServiceId 
        WHERE tblinvoice.BillingId = '$invoiceId'";
    
    $result = mysqli_query($con, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        // If no invoice details found, show an error message
        $pdf->Cell(0, 10, 'Invoice details not found', 0, 1, 'C');
    } else {
        // Print invoice title
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Ln(10);

        // Print customer details (only once)
        $row = mysqli_fetch_assoc($result);
        $pdf->Cell(50, 10, 'Customer Name:', 0, 0);
        $pdf->Cell(50, 10, $row['FirstName'] . ' ' . $row['LastName'], 0, 1);

        $pdf->Cell(50, 10, 'Contact no.:', 0, 0);
        $pdf->Cell(50, 10, $row['MobileNumber'], 0, 1);

        $pdf->Cell(50, 10, 'Email:', 0, 0);
        $pdf->Cell(50, 10, $row['Email'], 0, 1);

        $pdf->Cell(50, 10, 'Registration Date:', 0, 0);
        $pdf->Cell(50, 10, $row['RegDate'], 0, 1);

        $pdf->Cell(50, 10, 'Invoice Date:', 0, 0);
        $pdf->Cell(50, 10, $row['invoicedate'], 0, 1);

        $pdf->Ln(10);

        // Print services details
        $pdf->Cell(0, 10, 'Services Details', 0, 1, 'C');
        $pdf->Cell(50, 10, '#', 1, 0, 'C');
        $pdf->Cell(70, 10, 'Service', 1, 0, 'C');
        $pdf->Cell(70, 10, 'Cost', 1, 1, 'C');

        $cnt = 1;
        $gtotal = 0; // Initialize grand total variable
        do {
            $pdf->Cell(50, 10, $cnt, 1, 0, 'C');
            $pdf->Cell(70, 10, $row['ServiceName'], 1, 0);
            $pdf->Cell(70, 10, $row['Cost'], 1, 1, 'R');
            $cnt++;
            $gtotal += $row['Cost'];
        } while ($row = mysqli_fetch_array($result));

        // Print grand total
        $pdf->Cell(120, 10, 'Grand Total', 1, 0, 'C');
        $pdf->Cell(70, 10, $gtotal, 1, 1, 'R');
    }

    // Output the PDF as a downloadable file
    $pdf->Output('invoice.pdf', 'D');
}

// Call the function to generate the invoice PDF
if (isset($_GET['invoiceid'])) {
    $invoiceId = $_GET['invoiceid'];
    generateInvoicePDF($invoiceId);
}
?>
