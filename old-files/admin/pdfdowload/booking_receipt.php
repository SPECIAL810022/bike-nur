<?php
require_once('./../../config.php');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// Check if transaction_id is set in the GET parameters
if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
    // Sanitize the input to prevent SQL injection
    $booking_id = $conn->real_escape_string($_GET['transaction_id']);

    // Query to retrieve booking details
    $qry = $conn->query("SELECT * FROM `bookings` LEFT JOIN leads ON leads.LeadID = bookings.LeadID WHERE bookings.BookingID = '$booking_id'");

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
</head>
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}
.container {
    margin-top: 10px;
    padding: 0 0px;
    border:2px solid #000;
}
.company_details{
    text-align:center;
}
.receipt_header_section {
    width:100%;
    background: white;
    text-align:center;
    color: #000;
    padding: 5px 0px;
    border-radius: 0px;
    border-top:2px solid #000;
    border-bottom:2px solid #000;
    display: flex;
    justify-content:space-between;
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
}
th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}
h4 {
    color: #000;
    margin-top: 10px;
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
.contact_section{
    display:flex;
    justify-content:space-between;

}
.contact_section b{
    margin-left:25px;
}
.customer_section{
    display:flex;
}
</style>
<body>
        <div class="container">
            <div class="company_details">
                <h1 class="text-center">NUR AUTO SALES AND SERVICE</h1>
                <h3  class="text-center">KAKALI CINEMATALA,PANDUA,HOOGLY,WEST BENGAL - 712149</h3>
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
                    <p><strong>Booking Person Name:</strong> ' . $LeadName . '</p>
                </div>
                <div class="col-md-6" style="padding:10px;">
                    <p><strong>Payment Method:</strong> ' . $paymentMethodInput . '</p>
                </div>
                <div class="col-md-6" style="padding:10px;">
                    <?php if(isset($refNumberInput)): ?>
                        <p><strong>Reference No:</strong>  ' . $refNumberInput . '</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6" style="padding:10px;">
                    <p><strong>DATE:</strong> ' . date('d-m-Y', strtotime($BookingDate)) . '</p>
                </div>
            </div>
            <div class="row border">
                <div class="col-md-12" style="padding:;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">MODEL</th>
                                <th scope="col">SCHEME</th>
                                <th scope="col">BOOKING AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>' . $BikeOfInterest . '</td>
                                <td>' . $Scheme . '</td>
                                <td>' . $Amount . '</td>
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
                    <P>1. No Interest In Payable On The Payment<P>
                    <P>1. Price Is Applicable On The Day Of Delivery Only.<P>
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
