<?php
session_start();
require('include/fpdf.php');

// Check if order details are set in the session
if (!isset($_SESSION['order_details']) || empty($_SESSION['order_details'])) {
    die("No order details found.");
}

$order_details = $_SESSION['order_details'];
$total_order_price = isset($_SESSION['total_order_price']) ? $_SESSION['total_order_price'] : 0;

// Create PDF receipt
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Order Receipt', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Display order details
$pdf->Cell(40, 10, 'Medicine Name', 1);
$pdf->Cell(30, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Price Per Unit (Rs)', 1);
$pdf->Cell(40, 10, 'Total Price (Rs)', 1);
$pdf->Cell(40, 10, 'Expiry Date', 1);
$pdf->Ln();

foreach ($order_details as $item) {
    $pdf->Cell(40, 10, $item['medicine_name'], 1);
    $pdf->Cell(30, 10, $item['quantity'], 1);
    $pdf->Cell(40, 10, $item['price_per_unit'], 1);
    $pdf->Cell(40, 10, $item['total_price'], 1);
    $pdf->Cell(40, 10, $item['expiry_date'], 1);
    $pdf->Ln();
}

// Display total order price
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total Order Price: ' . number_format($total_order_price, 2) . ' Rs', 0, 1, 'R');

// Generate and output the PDF
$pdf->Output('D', 'order_receipt.pdf');
exit;
?>
