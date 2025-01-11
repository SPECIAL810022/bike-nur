<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Function to generate HTML table from fetched data
function generateHTMLTable($data)
{
    // Start the table
    $html = '<table border="1">';
    foreach ($data as $key => $value) {
        $html .= '<tr>';
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
        $html .= '<td>' . htmlspecialchars($value) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
}

// Check if the ID parameter is passed in the POST data
if (isset($_POST['transaction_id'])) {
    try {
        $id = $_POST['transaction_id'];

        // Prepare and bind the SQL statement

        $stmt = $conn->prepare("SELECT t.*, v.*, d.DealerName, d.Email AS DealerEmail, c.* FROM `transaction_list` t JOIN `vehicle_list` v ON t.vehicle_id = v.id JOIN `dealers` d ON v.dealers = d.DealerID LEFT JOIN `customers` c ON t.customer_id = c.id WHERE t.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->bind_param("i", $id); // Assuming 'id' is an integer

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the result has at least one row
        if ($result->num_rows > 0) {
            // Fetch all rows
            $data = $result->fetch_all(MYSQLI_ASSOC);
            // Get dealer's email and name
            $dealerEmail = $data[0]['DealerEmail'];
            $dealerName = $data[0]['DealerName'];

            // Static HTML template
            $htmlTable = '
            <body>
                <h2>NUR AUTO SALES & SERVICE</h2>
                <h5>MOB - 7384145740 NURAUTOSALES7860@GMAIL.COM</h5>
                <table border="1">
                    <tr>
                        <th>NAME</th>
                        <td>' . $data[0]['name'] . '</td>
                    </tr>
                    <tr>
                        <th>FATHER NAME</th>
                        <td>' . $data[0]['father_name'] . '</td>
                    </tr>
                    <tr>
                        <th>ADDRESS</th>
                        <td>' . $data[0]['address'] . '</td>
                    </tr>
                    <tr>
                        <th>POST</th>
                        <td>' . $data[0]['post_office'] . '</td>
                    </tr>
                    <tr>
                        <th>POLICE STATION</th>
                        <td>' . $data[0]['police_station'] . '</td>
                    </tr>
                    <tr>
                        <th>DISTRICT</th>
                        <td>' . $data[0]['district'] . '</td>
                    </tr>
                    <tr>
                        <th>PIN</th>
                        <td>' . $data[0]['pin'] . '</td>
                    </tr>
                    <tr>
                        <th>CONTACT NUMBER</th>
                        <td>' . $data[0]['contact_number'] . '</td>
                    </tr>
                    <tr>
                        <th>CHASSIS NUMBER</th>
                        <td>' . $data[0]['chassis_number'] . '</td>
                    </tr>
                    <tr>
                        <th>ENGINE NUMBER</th>
                        <td>' . $data[0]['engine_number'] . '</td>
                    </tr>
                    <tr>
                        <th>KEY NUMBER</th>
                        <td>' . $data[0]['key_number'] . '</td>
                    </tr>
                    <tr>
                        <th>BIKE MODEL</th>
                        <td>' . $data[0]['bike_name'] . '</td>
                    </tr>
                    <tr>
                        <th>COLOUR</th>
                        <td>' . $data[0]['colour'] . '</td>
                    </tr>
                    <tr>
                        <th>DATE & IN.VO.NO</th>
                        <td>' . $data[0]['create_at'] . '</td>
                    </tr>
                    <tr>
                        <th>BATTERY NUMBER</th>
                        <td>' . $data[0]['battery_number'] . '</td>
                    </tr>
                    <tr>
                        <th>HIPOTHECATION</th>
                        <td>' . $data[0]['hypothecation_name'] . '</td>
                    </tr>
                    <tr>
                        <th>ON RODE</th>
                        <td>' . $data[0]['on_road_price'] . '</td>
                    </tr>
                    <tr>
                        <th>EX SHOWROOM</th>
                        <td>' . $data[0]['ex_showroom_price'] . '</td>
                    </tr>
                    <tr>
                        <th>NOMINEE NAME</th>
                        <td>' . $data[0]['NomineeName'] . '</td>
                    </tr>
                    <tr>
                        <th>RELATIONSHIP</th>
                        <td>' . $data[0]['Relationship'] . '</td>
                    </tr>
                    <tr>
                        <th>AGE</th>
                        <td>' . $data[0]['age'] . '</td>
                    </tr>
                </table>
            </body>';

            // Create a PHPMailer instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'nurautosales7860@gmail.com';           // SMTP username
            $mail->Password   = 'hzmw thew qaer ucby';                  // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to

            // Sender details
            $mail->setFrom('nurautosales7860@gmail.com
            ', 'SAJID UDDIN');

            // Add recipient
            $mail->addAddress($dealerEmail, $dealerName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'REGISTRATION FROM';
            // Include the ID in the email body
            $mail->Body = '
                <body>
                    ' . $htmlTable . '
                </body>';

            // Attach files from the customer directory if they exist
            $customerFilesPath = 'customer/docs/';
            $attachmentStatus = [];

            if (file_exists($customerFilesPath . $data[0]['aadhaar_card'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['aadhaar_card'], 'Aadhaar Card');
                $attachmentStatus['aadhaar_card'] = 'Attached';
            } else {
                $attachmentStatus['aadhaar_card'] = 'File not found';
            }

            if (file_exists($customerFilesPath . $data[0]['pan_card'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['pan_card'], 'PAN Card');
                $attachmentStatus['pan_card'] = 'Attached';
            } else {
                $attachmentStatus['pan_card'] = 'File not found';
            }

            if (file_exists($customerFilesPath . $data[0]['dl_or_ll'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['dl_or_ll'], 'Driving License / Learner\'s License');
                $attachmentStatus['dl_or_ll'] = 'Attached';
            } else {
                $attachmentStatus['dl_or_ll'] = 'File not found';
            }

            if (file_exists($customerFilesPath . $data[0]['bank_passbook'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['bank_passbook'], 'Bank Passbook');
                $attachmentStatus['bank_passbook'] = 'Attached';
            } else {
                $attachmentStatus['bank_passbook'] = 'File not found';
            }
            if (file_exists($customerFilesPath . $data[0]['voter_file'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['voter_file'], 'Voter Card');
                $attachmentStatus['voter_file'] = 'Attached';
            } else {
                $attachmentStatus['voter_file'] = 'File not found';
            }
            if (file_exists($customerFilesPath . $data[0]['other_document'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['other_document'], 'Other Document');
                $attachmentStatus['other_document'] = 'Attached';
            } else {
                $attachmentStatus['other_document'] = 'File not found';
            }
            if (file_exists($customerFilesPath . $data[0]['bike_chalan'])) {
                $mail->addAttachment($customerFilesPath . $data[0]['bike_chalan'], 'Bike Chalan');
                $attachmentStatus['bike_chalan'] = 'Attached';
            } else {
                $attachmentStatus['bike_chalan'] = 'File not found';
            }

            // Check if the record already exists
            $statusCheckQuery = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'MAIL' AND meta_value = 'SENT' AND transaction_id = ?";
            $stmt = $conn->prepare($statusCheckQuery);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            // Close the statement
            $stmt->close();
            $mailAlreadySent = ($row['count'] > 0);

            if ($mailAlreadySent) {
                // If mail has already been sent, display a message
                echo "Mail has already been sent for this transaction.";
            } else {
                $mail->send();
                // Insert into status_manage table
                $statusInsertQuery = "INSERT INTO status_manage (transaction_id, meta_key, meta_value, created_at) VALUES (?, 'MAIL', 'SENT', CURRENT_TIMESTAMP)";
                $stmt = $conn->prepare($statusInsertQuery);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                // Provide a JSON response indicating that the email has been successfully sent
                echo "success";
            }
        } else {
            // Provide a JSON response if no data found for the given transaction ID
            echo json_encode(['status' => 'error', 'message' => "No data found for the given transaction ID"]);
        }
    } catch (Exception $e) {
        // Provide a JSON response with an error message if the email could not be sent
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    // Provide a JSON response with an error message if the ID parameter is not passed in the POST data
    echo json_encode(['status' => 'error', 'message' => "ID parameter is missing in the POST data"]);
}
