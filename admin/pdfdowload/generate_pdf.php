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
$model = mb_convert_case($model, MB_CASE_TITLE);
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
$roadtax_amount = (int) $roadtax_amount;
$numberplate_amount = (int) $numberplate_amount;
$insurance_amount
    = (int) $insurance_amount;
$other_amounts = $roadtax_amount + $numberplate_amount + $insurance_amount;
$engine_number = mb_convert_case($engine_number, MB_CASE_TITLE);
$chasis_number = mb_convert_case($chasis_number, MB_CASE_TITLE);
$customer = mb_convert_case($customer, MB_CASE_TITLE);
$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$ex_showroom_price = $cgst_amount + $sgst_amount + $price;
$formattedNumber = $formatter->format($ex_showroom_price);
$formattedNumber = mb_convert_case($formattedNumber, MB_CASE_TITLE);
$grand_total = number_format($ex_showroom_price, '2', '.');
$on_road_amount = $other_amounts + $ex_showroom_price;
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table{
            width:100%;
        }
        .invoice-container {
            width: 100%;
            margin: 0 auto;
            font-size: 14px;
            border:1px solid #000;
        }

        .invoice-header {
            text-align: center;
            border: 1px solid black;
            color:white;
        }

        .invoice-tables {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid black;
        }

        .invoice-table th {
            background-color: #eee;
            font-weight: bold;
        }

        .signature {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header" style="background-color: black;">
            <h2 style="float:left; margin-left:240px; font-size: 30px;">INVOICE</h2>
            <div style="float:right;margin-right: 5px;margin-top: auto;margin-bottom: auto;">
                <p>CONTACT NO-9932673601<br/>
                DATE: <span id="date">' . date('d-m-Y', strtotime($date_updated)) . '</span></p>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="invoice-header" style="color:black;">
            <p><span style="font-weight:bold;font-size: 20px;">NUR AUTO SALES AND SERVICE</span><br>
               <span style="font-size: 15px;"> KAKALI CENAMATALA, PANDUA, HOOGHLY, WEST BENGAL - 712149<br>
                GSTIN: 19DBBPS9887N1ZC</span></p>
        </div>
        <div class="invoice-header" style="color:black;text-align: left;">
            <p><span style="font-weight:bold;font-size: 17px;">&nbsp;CUSTOMER NAME:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $customer . '</span></p>
        </div>
       
        <table class="invoice-tables">
            <tr>
                <td>
                    <p><span style="font-weight:bold;font-size: 17px;">&nbsp;CUSTOMER ADDRESS:- ' . $address . '</span>
                    </p>
                </td>
                <td>
                    <p><span style="font-weight:bold;font-size: 16px;">&nbsp;CONTACT NO:-&nbsp;' . $contact . '</span>
                    </p>
                </td>
            </tr>
        </table>
        <table class="invoice-table">
            <tr>
                <th>Description</th>
                <th>HSN Code</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>' . $model . '<br/><br/>ENGINE NO-' . $engine_number . '<br/>CHASSIS NO - ' . $chasis_number . '<br/><br/><br /><br /></td>
                <td align="justify">' . $hsn_code . '<br/></td>
                <td>1<br/><br/><br /><br /><br /><br /><br /></td>
                <td>' . $price . '<br/><br/><br /><br /><br /><br /><br /></td>
                <td>' . $price . '<br/><br/><br /><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Total - </td>
                <td>' . $price . '</td>
                <td>' . $price . '</td>
            </tr>
            <tr>
                <td style="font-weight:bold">
                Total Amount (In Words) :-<br> ' . "Rupees " . $formattedNumber . '<br>
                </td>
                <td colspan="5">
                   <p>Add :&nbsp; CGST @ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $cgst . '%' . ' &nbsp;&nbsp; ' . $cgst_amount_with_format . '</p>
                   <p>Add :&nbsp; SGST @&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $sgst . '%' . ' &nbsp;&nbsp; ' . $sgst_amount_with_format . '</p>
                </td>
            </tr>
            <tr>
                <td>
                <h4>H.P - TVS CREDIT SERVICE LTD</h4>
                </td>
                <td colspan="5" >
                <h4 style="float:left;">GRAND TOTAL =</h4>
                <h4 style="float:left;">&nbsp;&nbsp;&nbsp;' . $grand_total . '</h4>
                <div style="clear:both;"></div>
                </td>
            </tr>
            <tr>
                <td>
                  <h4>FOR NUR AUTO SALES AND SERVICE</h4>
                  <br>
                  <br>
                  <span>E,& O.E</span> &nbsp;&nbsp;&nbsp;&nbsp; <span>Auhority Signuture</span>
                </td>
                <td colspan="5">
                <div class="others_amount">
                    <span style="font-weight: bold;">Ex-Showroom Amount - </span>
                    <span style="text-align: right; font-weight: bold;">' . $ex_showroom_price . '</span>
                </div>
            
                <div class="others_amount" style="margin: 20px 0px;">
                    <span style="font-weight: bold;">Registration, Insurance & Other -</span>
                    <span style="text-align: right; font-weight: bold;">' . $other_amounts . '</span>
                </div>
            
                <div class="others_amount">
                    <span style="font-weight: bold;">On Road Amount - </span>
                    <span style="text-align: right; font-weight: bold;">' . $on_road_amount . '</span>
                </div>
            </td>
            
            </tr>

        </table>
    </div>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Invoice", array("Attachment" => 0));
