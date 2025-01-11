<?php
// Include your configuration and autoload files
require_once('./../../config.php');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// Function to conditionally display Payment Method and Bike Details
function displayPaymentMethod($paymentMethod, $bikeDetails, $bookingType)
{
    if ($bookingType === 'EXCHANGE') {
        return '<p><strong>Payment Method:</strong> Exchange</p>' . '<br>' .
            '<p><strong>Exchnage Bike Details:</strong> ' . $bikeDetails . '</p>';
    } else {
        return '<p><strong>Payment Method:</strong> ' . $paymentMethod . '</p>';
    }
}

// Check if transaction_id is set in the GET parameters
if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
    // Sanitize the input to prevent SQL injection
    $booking_id = $conn->real_escape_string($_GET['transaction_id']);

    // Query to retrieve booking details
    $qry = $conn->query("
        SELECT 
            *,
            bookings.Scheme AS `Bike_Name`,  -- Alias the Scheme column as 'Bike Name'
            DATE_ADD(bookings.CreatedAt, INTERVAL 10 DAY) AS `EstimatedDeliveryDate`  -- Calculate estimated delivery date
        FROM 
            `bookings` 
        LEFT JOIN 
            leads ON leads.LeadID = bookings.LeadID 
        WHERE 
            bookings.BookingID = '$booking_id'
    ");

    // Check if the query returned results
    if ($qry->num_rows > 0) {
        // Fetch booking details
        $booking_data = $qry->fetch_assoc();

        // Extract variables from the fetched data
        extract($booking_data);
    } else {
        // Redirect with an alert message if the booking ID is not valid
        echo '<script>alert("Booking ID is not valid."); location.replace("./?page=insurance")</script>';
        exit; // Terminate script execution
    }
} else {
    // Redirect with an alert message if the booking ID is not provided
    echo '<script>alert("Booking ID is required."); location.replace("./?page=insurance")</script>';
    exit; // Terminate script execution
}

// HTML content for the booking receipt
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <link rel="stylesheet" href="booking.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("http://localhost/nur/admin/images/hacker.jpg"); /* Adjust path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .container {
        padding:0px 20px;
        border: 1px solid #000;
        height:auto;
    }
    .company_details {
        text-align: center;
        color: #333;
    }
    .receipt_header_section {
        width: 100%;
        background-color: #007bff;
        text-align: center;
        color: #fff;
        margin-top:15px;
        border-radius: 0px;
        display: flex;
        justify-content:end;
    }
    .row {
        margin-bottom: 20px;
    }
    .row p {
        margin: 0;
    }
    table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    .declaration {
        color: #0028ee;
        padding-left: 5px;
        text-align: center;
    }
    .price {
        font-weight: bold;
        color: #ff0000;
    }
    .contact_section {
        display: flex;
        justify-content: space-between;
    }
    .contact_section b {
        margin-left: 25px;
    }
    .customer_section {
        display: flex;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="company_details">
            <h1 class="text-center">NUR AUTO SALES AND SERVICE</h1>
            <h3 class="text-center">KAKALI CINEMATALA, PANDUA, HOOGLY, WEST BENGAL - 712149</h3>
            <div class="contact_section">
                <div class="number">
                    <b>PHONE- 03371482996/7384145740</b>
                    <b>EMAIL- nurautosales7860@gmail.com</b>
                </div>
            </div>
        </div>
        <div class="receipt_header_section">
            <span><b>MONEY RECEIPT</b></span>
        </div>
        <div class="row border customer_section">
            <div class="col-md-6" style="padding:10px;">
                <p><strong>BOOKING NO:</strong> #NUR00' . $BookingID . '</p>
            </div>
            <div class="col-md-6" style="padding:10px;">
                <p><strong>Booking Person Name:</strong> ' . $Name . '</p>
            </div>
            <div class="col-md-6" style="padding:10px;">
                ' . displayPaymentMethod($PaymentMethod, $Bike_Name, $BookingType) . '  <!-- Display Payment Method and Bike Details -->
            </div>
            <div class="col-md-6" style="padding:10px;">
                ' . (isset($RefNumber) ? '<p><strong>Reference No:</strong> ' . $RefNumber . '</p>' : '') . '
            </div>
            <div class="col-md-6" style="padding:10px;">
                <p><strong>DATE:</strong> ' . date('d-m-Y', strtotime($CreatedAt)) . '</p>
            </div>
            <div class="col-md-6" style="padding:10px;">
                <p><strong>Estimated Delivery Date:</strong> ' . date('d-m-Y', strtotime($EstimatedDeliveryDate)) . '</p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-12" style="padding:;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">BIKE NAME</th>
                            <th scope="col">GIFT ITEMS</th>
                            <th scope="col">BOOKING AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>' . $Bike_Name . '</td>  <!-- Display Bike Name -->
                            <td>' . $GiftItems . '</td>
                            <td class="price">' . $Amount . '</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row border border-success">
            <div class="col-md-12" style="padding:0px 10px;">
                <h4 class="">FOR NUR AUTO SALES AND SERVICES</h4>
            </div>
            <div class="col-md-12" style="padding:0px 10px;">
                <h4 class="">NOTE :- </h4>
                <p>1. No Interest Is Payable On The Payment</p>
                <p>2. Price Is Applicable On The Day Of Delivery Only.</p>
            </div>
        </div>
    </div>
</body>
</html>
';

// Create a new Dompdf instance
$dompdf = new Dompdf();

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output PDF as stream with filename "Booking Receipt"
$dompdf->stream("Booking Receipt", array("Attachment" => 0));
