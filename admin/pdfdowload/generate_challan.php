<?php
require_once('./../../config.php');
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
    $qry = $conn->query("SELECT *,CONCAT(firstname, ' ', COALESCE(CONCAT(middlename, ' '), ''), lastname) AS customer FROM `vehicle_list` INNER JOIN `transaction_list` ON vehicle_list.id=transaction_list.vehicle_id WHERE transaction_list.id='{$_GET['transaction_id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
        echo '<script>alert("transaction ID is not valid."); location.replace("./?page=insurance")</script>';
    }
} else {
    echo '<script>alert("transaction ID is Required."); location.replace("./?page=insurance")</script>';
}
if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
    $qry1 = $conn->query("SELECT * FROM model_list WHERE id='$model_id'");
    if ($qry1->num_rows > 0) {
        foreach ($qry1->fetch_assoc() as $key => $val) {

            $$key = $val;
        }
    }
}
$village = mb_convert_case($village, MB_CASE_TITLE);
$post_office = mb_convert_case($post_office, MB_CASE_TITLE);
$police_station = mb_convert_case($police_station, MB_CASE_TITLE);
$pin_no = mb_convert_case($pin_no, MB_CASE_TITLE);
$care_of = mb_convert_case($care_of, MB_CASE_TITLE);
$address = mb_convert_case($address, MB_CASE_TITLE);
$hsn_code = mb_convert_case($hsn_code, MB_CASE_TITLE);
$gst = null;
if (!isset($gst)) {
    $gst = (int) 28;
}
$cgst = $gst / 2;
$sgst = $gst / 2;

$cgst_amount = $price * ($cgst / 100);
$sgst_amount = $price * ($sgst / 100);
$cgst_amount_with_format = number_format($price * ($cgst / 100), '2', '.');
$sgst_amount_with_format = number_format($price * ($sgst / 100), '2', '.');
$roadtax_amount = $roadtax_amount;
$numberplate_amount = $numberplate_amount;
$engine_number = mb_convert_case($engine_number, MB_CASE_TITLE);
$chasis_number = mb_convert_case($chasis_number, MB_CASE_TITLE);
$customer = mb_convert_case($customer, MB_CASE_TITLE);
$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$ex_showroom_price = $cgst_amount + $sgst_amount + $price;
$formattedNumber = $formatter->format($ex_showroom_price);
$formattedNumber = mb_convert_case($formattedNumber, MB_CASE_TITLE);
$grand_total = number_format($ex_showroom_price, '2', '.');
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Challan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 20px;
            padding: 0 15px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
        }
        .card-title {
            background: black;
            color: white;
            text-align: center;
            padding: 5px 0;
            border-radius: 5px;
        }
        .card-body {
            padding: 20px;
        }
        .row {
            margin-bottom: 20px;
        }
        .border {
            border: 1px solid black;
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
            color: #00ee14;
            margin-top: 10px;
        }
        .declaration {
            color: #0028ee;
            padding-left: 5px;
            text-align: center;
        }
        .price {
            font-weight: bold;
            color: #ff0000; /* Adjust color as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DELIVERY CHALLAN</h4>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>NUR AUTO SALES AND SERVICE</strong><br>
                            MOTOR CYCLES & SCOOTERS<br>
                            SALES, SERVICE & SPARE PARTS<br>
                            Dai Pukur, Kakali Cinematola, Near Supermarket, Pandua, Hooghly<br>
                            Gmail: nurautosales7860@gmail.com<br>
                            Sales: 7384145740 Service: 033 71482996
                        </p>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md-6" style="padding:10px;">
                        <p><strong>NAME</strong> ' . $customer . '</p>
                        <p><strong>C/0</strong> ' . $care_of . '</p>
                        <p><strong>P.O.:</strong> ' . $post_office . '</p>
                        <p><strong>PIN:</strong> ' . $pin_no . '</p>
                    </div>
                    <div class="col-md-6" style="padding:10px;">
                        <p><strong>DATE</strong> ' . date('d-m-y', strtotime($date_updated)) . '</p>
                        <p><strong>VILLAGE</strong> ' . $village . '</p>
                        <p><strong>DIST:</strong> ' . $district . '</p>
                        <p><strong>MOB.:</strong> ' . $contact . '</p>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md-12" style="padding:10px;">
                        <table class="vehicle_description">
                            <thead>
                                <tr>
                                    <th colspan="3">VEHICLE DESCRIPTION</th>
                                    <th>EX-SHOWROOM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>MODEL:</strong> ' . $model . '</td>
                                </tr>
                                <tr>
                                    <td><strong>CHASSIS NO.:</strong>' . $chasis_number . '</td>
                                </tr>
                                <tr>
                                    <td><strong>ENGINE NO.:</strong>' . $engine_number . '</td>
                                    <td><strong><span class="price">' . $ex_showroom_price . '</span></strong></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row border border-success">
                    <div class="col-md-12" style="padding:10px;">
                        <table>
                            <tr>
                                <td>1.Tool Kit</td>
                                <td>2.Mirror</td>
                                <td>3.First Aid Kit</td>
                                <td>4. Leg Guard</td>
                                <td>5. Sharee Guard</td>
                                <td>6. Service Book</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12" style="padding:0px 10px;">
                        <h4 class="">Declaration:</h4>
                        <p class="declaration">Goods once sold cannot be taken back. Payment against Proforma Invoice. Any loss or damages after delivery will be borne
                            by the Purchaser. Rate are subject to market fluctuation & will be charged at the ruling rate at the time of delivery.
                            Warranty: as per company rules. I/We agree to the above terms and conditions and acknowledge the delivery of the above
                            motorcycle in good order and running condition with all its parts & free accessories as supplied by the manufacturers. I
                            have read and agreed to all the T&C of the finance companys EMI, Down Payment and Tenure for the above vehicle
                            hypothecation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Invoice", array("Attachment" => 0));
