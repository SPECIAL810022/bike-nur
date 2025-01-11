<?php
require_once('../config.php');
class Master extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img()
	{
		extract($_POST);
		if (is_file(base_app . $path)) {
			if (unlink(base_app . $path)) {
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete ' . $path;
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown ' . $path . ' path';
		}
		return json_encode($resp);
	}
	function save_brand()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `brand_list` where `name` = '{$name}' and delete_flag = 0 " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "brand already exists.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `brand_list` set {$data} ";
		} else {
			$sql = "UPDATE `brand_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['cid'] = $cid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New Brand successfully saved.";
			else
				$resp['msg'] = " Brand successfully updated.";
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		// if($resp['status'] == 'success')
		// 	$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function save_insurance()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}

		// Check if insurance already exists
		$check = $this->conn->query("SELECT * FROM `insurance` where `provider` = '{$provider}' and delete_flag = 0 " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Insurance already exists.";
			return json_encode($resp);
			exit;
		}

		// Prepare SQL query
		if (empty($id)) {
			$sql = "INSERT INTO `insurance` SET {$data} ";
		} else {
			$sql = "UPDATE `insurance` SET {$data} WHERE id = '{$id}' ";
		}

		// Execute SQL query
		$save = $this->conn->query($sql);

		// Check if query executed successfully
		if ($save) {
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['cid'] = $cid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New insurance successfully saved.";
			else
				$resp['msg'] = "Insurance successfully updated.";
		} else {
			// Error handling
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}

		return json_encode($resp);
	}
	function save_dealer()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		extract($_POST);
		$phone = $_POST['Phone'];

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('DealerID'))) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}

		if (empty($DealerID)) {
			$check = $this->conn->query("SELECT * FROM `dealers` where `Phone` = '{$phone}' " . (!empty($id) ? " and DealerID != {$DealerID} " : "") . " ")->num_rows;
			if ($this->capture_err())
				return $this->capture_err();
			if ($check > 0) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Dealer already exists.";
				return json_encode($resp);
				exit;
			}
			$sql = "INSERT INTO `dealers` set {$data}, `user_name`='{$fullname}'";
		} else {
			$sql = "UPDATE `dealers` set {$data}, `user_name`='{$fullname}' where DealerID = '{$DealerID}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['cid'] = $cid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New dealer successfully saved.";
			else
				$resp['msg'] = "Dealer successfully updated.";
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}

		return json_encode($resp);
	}
	function delete_dealer()
	{
		extract($_POST);

		// Check if $id is set
		if (!isset($id)) {
			$resp['status'] = 'failed';
			$resp['error'] = 'Dealer ID not provided.';
			return json_encode($resp);
		}

		// Use prepared statement to prevent SQL injection
		$stmt = $this->conn->prepare("DELETE FROM `dealers` WHERE DealerID = ?");
		$stmt->bind_param("s", $id);
		$del = $stmt->execute();
		$stmt->close();

		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', 'Dealer successfully deleted.');
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}

		return json_encode($resp);
	}
	function delete_brand()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `brand_list` set `delete_flag` = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Brand successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_insurance()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `insurance` set `delete_flag` = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Insurance successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_model()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		extract($_POST);

		$data = "";
		$a = "";
		foreach ($_POST as $k => $v) {
			$a .= $k;
			if (!in_array($k, array('id')) && !is_array($_POST[$k])) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		$model = htmlspecialchars($this->conn->real_escape_string($model));
		$check = $this->conn->query("SELECT * FROM `model_list` where `model` = '{$model}' and brand_id = '{$brand_id}' and delete_flag = 0 " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Model already exists.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `model_list` (`brand_id`, `model`, `status`, `user_name`) VALUES ('$brand_id', '$model', '$status', '$fullname')";
		} else {
			$sql = "UPDATE `model_list` SET 
						`brand_id`='$brand_id', 
						`model`='$model', 
						`status`='$status', 
						`user_name`='$fullname' 
					WHERE id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['pid'] = $pid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New Model successfully saved.";
			else
				$resp['msg'] = " Model successfully updated.";
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}
	function delete_model()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `model_list` set `delete_flag` = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Model successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_vehicle()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Extract POST data
		extract($_POST);

		// Initialize data variable
		$data = "";

		// Loop through POST data and construct data string
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_array($_POST[$k])) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		// Handle Bike Chalan file upload
		$bike_chalan_file = '';
		if (!empty($_FILES['bike_chalan']['name'])) {
			$upload_dir = '../admin/customer/docs/';
			$allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf');
			$current_time = time();

			$file_ext = strtolower(pathinfo($_FILES['bike_chalan']['name'], PATHINFO_EXTENSION));
			if (in_array($file_ext, $allowed_extensions)) {
				// Generate unique file name by appending current time
				$bike_chalan_file = $current_time . '_bike_chalan.' . $file_ext;
				if (!move_uploaded_file($_FILES['bike_chalan']['tmp_name'], $upload_dir . $bike_chalan_file)) {
					$resp['status'] = 'failed';
					$resp['msg'] = 'Failed to upload Bike Chalan file.';
					return json_encode($resp);
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = 'Invalid file format for Bike Chalan.';
				return json_encode($resp);
			}
		}

		// Append user_name field with the current user's full name
		$data .= ", `user_name`='{$fullname}'";

		// Construct SQL query
		if (empty($id)) {
			$sql = "INSERT INTO `vehicle_list` SET {$data}, `bike_chalan`='{$bike_chalan_file}'";
		} else {
			$sql = "UPDATE `vehicle_list` SET {$data}, `bike_chalan`='{$bike_chalan_file}' WHERE id = '{$id}'";
		}

		// Execute SQL query
		$save = $this->conn->query($sql);

		// Check if query executed successfully
		if ($save) {
			$vid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['vid'] = $vid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New Vehicle successfully saved.";
			else
				$resp['msg'] = " Vehicle successfully updated.";
		} else {
			// Error handling
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		return json_encode($resp);
	}
	function delete_vehicle()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `vehicle_list` set `delete_flag` = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Vehicle successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	// save transtion
	function save_transaction()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Extract POST data from JSON
		$jsonData = file_get_contents('php://input');
		$data = json_decode($jsonData, true);

		// Extract necessary data
		$id = !empty($data['id']) ? $data['id'] : '';
		$vehicle_id = !empty($data['vehicle_id']) ? $data['vehicle_id'] : '';

		// Initialize data_string variable
		$data_string = '';

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		// Loop through data and construct data_string
		foreach ($data as $k => $v) {
			if ($k === 'id' || $k === 'vehicle_id') {
				continue;
			}
			if (!empty($data_string)) {
				$data_string .= ",";
			}
			$v = htmlspecialchars($this->conn->real_escape_string($v));
			$data_string .= "`{$k}`='{$v}'";
		}

		// Include vehicle_id for insertion if it's not already set
		if (empty($id) && empty($vehicle_id)) {
			$resp['status'] = 'failed';
			$resp['err'] = 'Vehicle ID is required';
			return json_encode($resp);
		}

		// Add vehicle_id to $data_string if it's not already set
		if (empty($id) && !empty($vehicle_id)) {
			$data_string .= ", `vehicle_id`='{$vehicle_id}'";
		}

		// Include user_name field with the current user's full name
		$data_string .= ", `user_name`='{$fullname}'";

		// Construct SQL query
		$sql = !empty($id) ? "UPDATE `transaction_list` SET {$data_string} WHERE id = '{$id}'" : "INSERT INTO `transaction_list` SET {$data_string}";

		// Execute SQL query
		$save = $this->conn->query($sql);

		// Check if query executed successfully
		if ($save) {
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			$message = empty($id) ? "Transaction has been saved successfully." : "Transaction successfully updated.";
			$this->settings->set_flashdata('success', $message);
			if (!empty($vehicle_id)) {
				$this->conn->query("UPDATE `vehicle_list` SET `status` = 1 WHERE id = '{$vehicle_id}'");
			}
		} else {
			// Error handling
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}

		return json_encode($resp);
	}
	function delete_transaction()
	{
		extract($_POST);
		$get = $this->conn->query("SELECT vehicle_id FROM `transaction_list` where id = '{$id}' ");
		$del = $this->conn->query("DELETE FROM `transaction_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Transaction has been deleted successfully.");
			if ($get->num_rows > 0) {
				$vehicle_id = $get->fetch_array()[0];
				$this->conn->query("UPDATE `vehicle_list` set `status` = 0 where id = '{$vehicle_id}'");
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	// customer section
	function save_lead()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Extract POST data
		extract($_POST);

		// Sanitize ContactInformation
		$ContactInformation = $this->conn->real_escape_string($_POST['ContactInformation']);

		// Initialize data variable
		$data = "";

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		// Loop through POST data
		foreach ($_POST as $k => $v) {
			// Exclude LeadID from data
			if ($k !== 'LeadID') {
				// Sanitize and prepare data
				$v = $this->conn->real_escape_string($v);
				$data .= "`{$k}`='{$v}', ";
			}
		}
		// Remove trailing comma and space from $data
		$data = rtrim($data, ', ');

		// Check if new lead or updating existing lead
		if (empty($LeadID)) {
			// Check if lead already exists
			$check = $this->conn->query("SELECT * FROM `leads` WHERE `ContactInformation` = '{$ContactInformation}'")->num_rows;
			if ($this->capture_err()) {
				return $this->capture_err();
			}
			if ($check > 0) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Lead already exists.";
				return json_encode($resp);
			}

			// Add the user_name field with the current user's full name
			$data .= ", `user_name`='{$fullname}' ";

			// Insert new lead
			$sql = "INSERT INTO `leads` SET {$data}";
		} else {
			// Update existing lead
			$sql = "UPDATE `leads` SET {$data} WHERE LeadID = '{$LeadID}'";
		}

		// Execute SQL query
		$save = $this->conn->query($sql);

		// Check if query executed successfully
		if ($save) {
			$lid = !empty($LeadID) ? $LeadID : $this->conn->insert_id;
			$resp['LeadID'] = $lid;
			$resp['status'] = 'success';
			$resp['msg'] = empty($LeadID) ? "New lead successfully saved." : "Lead successfully updated.";
		} else {
			// Error handling
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . " [{$sql}]";
		}

		return json_encode($resp);
	}


	function delete_lead()
	{
		extract($_POST);
		$get = $this->conn->query("SELECT LeadID FROM `leads` WHERE LeadID = '{$LeadID}'");
		$del = $this->conn->query("DELETE FROM `leads` WHERE LeadID = '{$LeadID}'");
		if ($del) {
			$resp['status'] = 'success';
			$resp['msg'] = "Lead has been deleted successfully.";
			// Additional actions after deleting lead, if needed
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	// customer save
	function save_customer()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Extract POST data
		extract($_POST);
		$data = "";

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}

		if (empty($id)) {
			$check = $this->conn->query("SELECT * FROM `customers` where `contact_number` = '{$contact_number}' ")->num_rows;
			if ($this->capture_err())
				return $this->capture_err();
			if ($check > 0) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Customer already exists.";
				return json_encode($resp);
				exit;
			}
			// Add the user_name field with the current user's full name
			$data .= ", `user_name`='{$fullname}' ";

			$sql = "INSERT INTO `customers` set {$data} ";
		} else {
			$sql = "UPDATE `customers` set {$data} where id = '{$id}' ";
		}

		$save = $this->conn->query($sql);
		if ($save) {
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['id'] = $cid;
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = "New customer successfully saved.";
			else
				$resp['msg'] = "Customer successfully updated.";
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}

		return json_encode($resp);
	}
	// customer data
	function submit_customer_doc()
	{
		// Define upload directory
		$upload_dir = '../admin/customer/docs/';
		// Allowed file extensions
		$allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf');
		// Current timestamp
		$current_time = time();
		// Update customer record with file paths in the database
		$customer_id = $_POST['customerId'];
		// Initialize variables to store file names and extensions
		$aadhaar_file = '';
		$pan_file = '';
		$dl_ll_file = '';
		$bank_passbook_file = '';
		$voter_file = '';
		$other_document = '';

		// Function to handle file upload and update file names
		function handleFile($file, $name, $doc_type, $upload_dir, $allowed_extensions, $current_time)
		{
			if ($file['error'] === UPLOAD_ERR_OK) {
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				if (in_array($file_ext, $allowed_extensions)) {
					// Generate unique file name by appending current time
					$file_new_name = $current_time . '_' . $doc_type . '.' . $file_ext;
					if (move_uploaded_file($file['tmp_name'], $upload_dir . $file_new_name)) {
						return $file_new_name;
					}
				}
			}
			return false;
		}

		// Handle file upload for Aadhaar
		$aadhaar_file = handleFile($_FILES['aadhaarFile'], $_FILES['aadhaarFile']['name'], 'aadhaar', $upload_dir, $allowed_extensions, $current_time);

		// Handle file upload for PAN
		$pan_file = handleFile($_FILES['panFile'], $_FILES['panFile']['name'], 'pan', $upload_dir, $allowed_extensions, $current_time);

		// Handle file upload for Driving License/Learner's License
		$dl_ll_file = handleFile($_FILES['dl_llFile'], $_FILES['dl_llFile']['name'], 'dl_ll', $upload_dir, $allowed_extensions, $current_time);

		// Handle file upload for Bank Passbook
		$bank_passbook_file = handleFile($_FILES['bankPassbookFile'], $_FILES['bankPassbookFile']['name'], 'bank_passbook', $upload_dir, $allowed_extensions, $current_time);

		// Handle file upload for Voter File
		$voter_file = handleFile($_FILES['voterFile'], $_FILES['voterFile']['name'], 'voter', $upload_dir, $allowed_extensions, $current_time);

		// Handle file upload for Other Document
		$other_document = handleFile($_FILES['otherDocumentFile'], $_FILES['otherDocumentFile']['name'], 'other_document', $upload_dir, $allowed_extensions, $current_time);

		// Update customer record with file paths in the database
		$update_query = "UPDATE customers SET 
						aadhaar_card='" . $aadhaar_file . "',
						pan_card='" . $pan_file . "',
						dl_or_ll='" . $dl_ll_file . "',
						bank_passbook='" . $bank_passbook_file . "',
						voter_file='" . $voter_file . "',
						other_document='" . $other_document . "'
						WHERE id='{$customer_id}'";

		// Execute the update query
		$upresult = $this->conn->query($update_query);
		if ($upresult) {
			echo "Files uploaded and database updated successfully.";
			print_r($upresult);
		} else {
			echo "Error updating database: " . $this->conn->error;
		}
	}
	// insurance stage
	function update_insurance()
	{
		extract($_POST);
		// Check if the same meta_key and meta_value combination exists
		$check_query = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'INSURANCE' AND meta_value = ? AND transaction_id = ?";
		$stmt_check = $this->conn->prepare($check_query);
		$stmt_check->bind_param("si", $insuranceStage, $transactionId);
		$stmt_check->execute();
		$result_check = $stmt_check->get_result();
		$row_check = $result_check->fetch_assoc();
		$stmt_check->close();
		// If the same combination exists, return a message
		if ($row_check['count'] > 0) {
			echo json_encode(['status' => 'error', 'message' => 'Insurance details already exist']);
			return;
		}
		// Prepare the SQL statement
		$insert_query = "INSERT INTO status_manage (transaction_id, meta_key, meta_value, created_at) VALUES (?, 'INSURANCE', ?, CURRENT_TIMESTAMP)";
		// Bind parameters and execute the query
		$stmt_insert =  $this->conn->prepare($insert_query);
		$stmt_insert->bind_param("is", $transactionId, $insuranceStage);
		// Check if the query executed successfully
		if ($stmt_insert->execute()) {
			// Return a success message or perform any other actions
			echo json_encode(['status' => 'success', 'message' => 'Insurance details updated successfully']);
		} else {
			// Return an error message if the query failed
			echo json_encode(['status' => 'error', 'message' => 'Failed to update insurance details']);
		}

		// Close the statement
		$stmt_insert->close();
	}
	// road tax stage
	function update_road_tax()
	{
		extract($_POST);
		$check_query = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'ROADTAX' AND meta_value = ? AND transaction_id = ?";
		$stmt_check = $this->conn->prepare($check_query);
		$stmt_check->bind_param("si", $roadTaxStage, $transactionId);
		$stmt_check->execute();
		$result_check = $stmt_check->get_result();
		$row_check = $result_check->fetch_assoc();
		$stmt_check->close();
		if ($row_check['count'] > 0) {
			echo json_encode(['status' => 'error', 'message' => 'Road Tax details already exist']);
			return;
		}
		// Prepare the SQL statement
		$insert_query = "INSERT INTO status_manage (transaction_id, meta_key, meta_value, created_at) VALUES (?, 'ROADTAX', ?, CURRENT_TIMESTAMP)";
		// Bind parameters and execute the query
		$stmt_insert =  $this->conn->prepare($insert_query);
		$stmt_insert->bind_param("is", $transactionId, $roadTaxStage);
		if ($stmt_insert->execute()) {
			echo json_encode(['status' => 'success', 'message' => 'Road Tax details updated successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update road tax details']);
		}
		$stmt_insert->close();
	}
	// number plate stage 
	function update_number_plate()
	{
		extract($_POST);
		$check_query = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'NUMBERPLATE' AND meta_value = ? AND transaction_id = ?";
		$stmt_check = $this->conn->prepare($check_query);
		$stmt_check->bind_param("si", $plateStage, $transactionId);
		$stmt_check->execute();
		$result_check = $stmt_check->get_result();
		$row_check = $result_check->fetch_assoc();
		$stmt_check->close();
		if ($row_check['count'] > 0) {
			echo json_encode(['status' => 'error', 'message' => 'Number Plate details already exist']);
			return;
		}
		// Prepare the SQL statement
		$insert_query = "INSERT INTO status_manage (transaction_id, meta_key, meta_value, created_at) VALUES (?, 'NUMBERPLATE', ?, CURRENT_TIMESTAMP)";
		// Bind parameters and execute the query
		$stmt_insert =  $this->conn->prepare($insert_query);
		$stmt_insert->bind_param("is", $transactionId, $plateStage);
		if ($stmt_insert->execute()) {
			echo json_encode(['status' => 'success', 'message' => 'Number Plate details updated successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update number plate details']);
		}
		$stmt_insert->close();
	}
	// borker section
	function save_broker()
	{
		// Start the session if not already started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// Extract POST data
		extract($_POST);
		// Escape POST data to prevent SQL injection
		$phone = $this->conn->real_escape_string($broker_phone);
		$data = "";
		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('broker_id'))) {
				if (!empty($data)) $data .= ",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($broker_id)) {
			$check = $this->conn->query("SELECT * FROM `brokers` where `broker_phone` = '{$phone}' " . (!empty($id) ? " and broker_id != {$broker_id} " : "") . " ")->num_rows;
			if ($this->capture_err())
				return $this->capture_err();
			if ($check > 0) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Broker already exists.";
				return json_encode($resp);
				exit;
			}
			// Add the user_name field with the current user's full name
			$data .= ", `user_name`='{$fullname}' ";

			$sql = "INSERT INTO `brokers` set {$data} ";
		} else {
			$sql = "UPDATE `brokers` set {$data} where broker_id = '{$broker_id}' ";
		}

		$save = $this->conn->query($sql);
		if ($save) {
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['cid'] = $cid;
			$resp['status'] = 'success';
			if (empty($broker_id))
				$resp['msg'] = "New broker successfully saved.";
			else
				$resp['msg'] = "Broker successfully updated.";
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}

		return json_encode($resp);
	}
	// next followup
	function save_next_followup()
	{
		// Assuming you already started the session
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Extract POST data
		extract($_POST);

		// Escape POST data to prevent SQL injection
		$leadId = $this->conn->real_escape_string($leadId);
		$remarks = $this->conn->real_escape_string($remarks);
		$nextFollowupDate = $this->conn->real_escape_string($nextFollowupDate);
		$status = $this->conn->real_escape_string($status);
		$scheme = $this->conn->real_escape_string($scheme);

		// Check if leadId is empty
		if (empty($leadId)) {
			$resp['status'] = 'failed';
			$resp['msg'] = 'Lead ID is missing.';
			return json_encode($resp);
		}

		// Get the full name from session data
		$fullname = $_SESSION['userdata']['id'];

		// Prepare SQL query for inserting into followups table
		$sql_followup = "INSERT INTO `followups` (`LeadID`, `FollowUpDate`, `FollowUpType`, `FollowUpStatus`, `Notes`, `User_Name`) 
						VALUES ('{$leadId}', '{$nextFollowupDate}', 'Next Follow-up', '{$status}', '{$remarks}', '{$fullname}')";

		$save_followup = $this->conn->query($sql_followup);
		if ($save_followup) {
			// Prepare SQL query for updating LeadStatus
			$sql_update_lead = "UPDATE `leads` SET `LeadStatus`='{$status}',`NextFollowUpDate`= '{$nextFollowupDate}' WHERE `LeadID`='{$leadId}'";
			$update_lead = $this->conn->query($sql_update_lead);

			if ($update_lead) {
				$resp['status'] = 'success';
				$resp['msg'] = 'Next follow-up details successfully saved.';
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = 'Failed to update LeadStatus. ' . $this->conn->error;
			}
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'Failed to save next follow-up details. ' . $this->conn->error;
		}

		return json_encode($resp);
	}

	// booking function
	function save_booking()
	{
		extract($_POST);
		$leadId = $this->conn->real_escape_string($LeadID);
		$bookingDate = $this->conn->real_escape_string($BookingDate);
		$scheme = $this->conn->real_escape_string($Scheme);
		$amount = $this->conn->real_escape_string($Amount);
		$notes = $this->conn->real_escape_string($Notes);
		$refNumberInput = $this->conn->real_escape_string($refNumberInput);
		$paymentMethodInput = $this->conn->real_escape_string($PaymentMethod);
		$bookingType = $this->conn->real_escape_string($BookingType);
		$bikeDetails = $this->conn->real_escape_string($BikeDetails);
		$giftItems = $this->conn->real_escape_string($GiftItemsInput);

		// Concatenate firstname and lastname to create fullname
		$fullname = $_SESSION['userdata']['id'];

		// Handle file upload
		$documentPath = '';
		if (isset($_FILES['DocumentUpload']) && $_FILES['DocumentUpload']['error'] == 0) {
			$uploadDir = '../admin/customer/booking/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0777, true);
			}
			$documentPath = $uploadDir . basename($_FILES['DocumentUpload']['name']);
			if (!move_uploaded_file($_FILES['DocumentUpload']['tmp_name'], $documentPath)) {
				$resp['status'] = 'failed';
				$resp['err'] = 'Failed to upload document.';
				return json_encode($resp);
			}
		}

		// Prepare SQL query to insert into bookings table
		$sql_booking = "INSERT INTO `bookings` (`LeadID`, `BookingDate`, `Scheme`, `Amount`, `Notes`, `paymentMethodInput`, `refNumberInput`, `BookingType`, `BikeDetails`, `giftItemsInput`, `DocumentPath`, `user_name`) 
		VALUES ('{$leadId}', '{$bookingDate}', '{$scheme}', '{$amount}', '{$notes}', '{$paymentMethodInput}', '{$refNumberInput}', '{$bookingType}', '{$bikeDetails}', '{$giftItems}', '{$documentPath}', '{$fullname}')";

		$save_booking = $this->conn->query($sql_booking);
		if ($save_booking) {
			$resp['status'] = 'success';
			$resp['msg'] = 'Booking details successfully saved.';
		} else {
			// Error handling if inserting into bookings table failed
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . " [{$sql_booking}]";
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
		break;
	case 'save_brand':
		echo $Master->save_brand();
		break;
	case 'delete_brand':
		echo $Master->delete_brand();
		break;
	case 'save_model':
		echo $Master->save_model();
		break;
	case 'delete_model':
		echo $Master->delete_model();
		break;
	case 'save_vehicle':
		echo $Master->save_vehicle();
		break;
	case 'delete_vehicle':
		echo $Master->delete_vehicle();
		break;
	case 'save_transaction':
		echo $Master->save_transaction();
		break;
	case 'delete_transaction':
		echo $Master->delete_transaction();
		break;
	case 'save_insurance':
		echo $Master->save_insurance();
		break;
	case 'save_dealer':
		echo $Master->save_dealer();
		break;
	case 'delete_dealer':
		echo $Master->delete_dealer();
		break;
	case 'delete_insurance':
		echo $Master->delete_insurance();
		break;
	case 'save_customer':
		echo $Master->save_customer();
		break;
	case 'submit_customer_doc':
		echo $Master->submit_customer_doc();
		break;
	case 'update_insurance':
		echo $Master->update_insurance();
		break;
	case 'update_road_tax':
		echo $Master->update_road_tax();
		break;
	case 'update_number_plate':
		echo $Master->update_number_plate();
		break;
	case 'save_broker':
		echo $Master->save_broker();
		break;
	case 'save_lead':
		echo $Master->save_lead();
		break;
	case 'save_next_followup':
		echo $Master->save_next_followup();
		break;
	case 'delete_lead':
		echo $Master->delete_lead();
		break;
	case 'save_booking':
		echo $Master->save_booking();
		break;
	default:
		// echo $sysset->index();
		break;
}
