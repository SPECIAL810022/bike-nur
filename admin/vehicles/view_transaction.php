<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$transaction_qry = $conn->query("SELECT *
	FROM `transaction_list`
	LEFT JOIN customers ON customers.id = transaction_list.customer_id
	LEFT JOIN vehicle_list ON vehicle_list.id = transaction_list.vehicle_id
	LEFT JOIN brokers ON brokers.broker_id = transaction_list.broker_id
	WHERE transaction_list.id = '{$_GET['id']}'
	LIMIT 1"); // Added LIMIT 1 to fetch only one row

	if ($transaction_qry->num_rows > 0) {
		// Fetch the transaction data
		$transaction = $transaction_qry->fetch_assoc();
	} else {
		// Handle case where no transaction is found
		echo "No transaction found with ID: {$_GET['id']}";
	}


	if (isset($transaction['vehicle_id'])) {
		$qry = $conn->query("SELECT * from `vehicle_list` where id = '{$transaction['vehicle_id']}' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_assoc() as $k => $v) {
				$$k = $v;
			}
		}
		if (isset($model_id)) {
			$model_qry = $conn->query("SELECT m.*, b.name as `brand` from `model_list` m inner join brand_list b on m.brand_id = b.id where m.id = '{$model_id}'");
			if ($model_qry->num_rows > 0) {
				foreach ($model_qry->fetch_assoc() as $k => $v) {
					$model[$k] = $v;
				}
			}
		}
	}
}
$transaction_id = $_GET['id'];
// dealers
?>

<style>
	legend.legend-sm {
		font-size: 1.4em;
	}

	#cimg {
		max-width: 100%;
		max-height: 20em;
		object-fit: scale-down;
		object-position: center center;
	}
</style>

<!-- status manage modal section -->
<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="customModalLabel">Modal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
				$sql = "SELECT meta_key, meta_value, created_at 
				FROM status_manage 
				WHERE (meta_key, created_at) IN 
					(SELECT meta_key, MAX(created_at) 
					FROM status_manage 
					GROUP BY meta_key)
				AND transaction_id = $transaction_id 
				";

				$result = $conn->query($sql);
				// Check if there are any rows in the result

				if ($result->num_rows > 0) {
					echo "<table class='table table-bordered'>";
					echo "<thead>";
					echo "<tr><th>STAGE NAME</th><th>CURRENT STAGE</th><th>DATE</th></tr>";
					echo "</thead>";
					echo "<tbody>";

					// Output data rows
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . $row['meta_key'] . "</td>";
						echo "<td>" . $row['meta_value'] . "</td>";
						echo "<td>" . $row['created_at'] . "</td>";
					}

					// Close table body and table tags
					echo "</tbody>";
					echo "</table>";
				} else {
					// If no rows found, display a message
					echo "No data found ";
				}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal for Insurance -->
<div class="modal fade" id="insuranceModal" tabindex="-1" role="dialog" aria-labelledby="insuranceModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="insuranceModalLabel">Insurance Section</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" class="form-control" name="insuranceInfo" id="insuranceInfo" value="insuranceInfo">
				<input type="hidden" class="form-control" name="transaction_id" id="transaction_id" value="<?php echo $transaction_id ?>">
				<div class="form-group">
					<label for="insuranceStage">Insurance Stage</label>
					<select class="form-control" id="insuranceStage" name="insuranceStage" required>
						<option value="Issued">Issued</option>
						<option value="Received">Received</option>
						<option value="Insurance Completed">Insurance Completed</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submitInsuranceBtn">Submit</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal for Road Tax -->
<div class="modal fade" id="roadTaxModal" tabindex="-1" role="dialog" aria-labelledby="roadTaxModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="roadTaxModalLabel">Road Tax Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label for="insuranceStage">Road Tax Stage</label>
				<select class="form-control" id="roadTaxStage" name="roadTaxStage" required>
					<option value="Processed">Processed</option>
					<option value="Completed">Completed</option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submitRoadTax">Submit</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal for Number Plate -->
<div class="modal fade" id="numberPlateModal" tabindex="-1" role="dialog" aria-labelledby="numberPlateModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="numberPlateModalLabel">Number Plate Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="plateNumber">Number Plate Stage</label>
					<select class="form-control" id="plateStage" name="plateStage">
						<option value="arrived">arrived</option>
						<option value="fittings_done">Fittings Done</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submitNumberPlate">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- CONTENT PART -->
<div class="content py-5 px-3 bg-gradient-navy">
	<h4 class="font-wight-bolder">Invoice Details</h4>
</div>

<div class="row mt-n4 align-items-center justify-content-center flex-column">
	<!-- BUTTONS -->
	<div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-footer py-1 text-center">
				<?php
				$statusCheckQuery = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'MAIL' AND meta_value = 'SENT' AND transaction_id = ?";
				$stmt = $conn->prepare($statusCheckQuery);
				$stmt->bind_param("i", $transaction_id);
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$stmt->close();
				$mailSent = ($row['count'] > 0);
				if ($mailSent) {
					echo '<button class="btn btn-success btn-sm btn-success bg-gradient-success disabled"><i class="fa fa-man"></i>ALREADY SENT</button>';
				} else {
					echo '<button class="btn btn-flat btn-sm btn-info bg-gradient-info" id="send_dealer"><i class="fa fa-man"></i>Send Email</button>';
				}
				?>
				<button class="btn btn-flat btn-sm btn-yellow bg-gradient-yellow" id="change_atatu"><i class="fa fa-status"></i>DEALER COMMUNACATION</button>


				<?php
				$check_query = "SELECT COUNT(*) AS count FROM status_manage WHERE meta_key = 'MAIL' AND meta_value = 'SENT' AND transaction_id = ?";
				$stmt_check = $conn->prepare($check_query);
				$stmt_check->bind_param("i", $transaction_id);
				$stmt_check->execute();
				$result_check = $stmt_check->get_result();
				$row_check = $result_check->fetch_assoc();
				$stmt_check->close();

				// If the record exists, show the buttons
				if ($row_check['count'] > 0) {
				?>
					<button class="btn btn-flat btn-sm btn-primary bg-gradient-primary" data-toggle="modal" data-target="#insuranceModal"><i class="fa fa-shield"></i> Insurance</button>
					<button class="btn btn-flat btn-sm btn-warning bg-gradient-warning" id="road-tax" data-toggle="modal" data-target="#roadTaxModal"><i class="fa fa-road"></i> Road Tax</button>
					<button class="btn btn-flat btn-sm btn-warning bg-gradient-warning" id="number-plate" data-toggle="modal" data-target="#numberPlateModal"><i class="fa fa-car"></i> Number Plate</button>
				<?php
				}
				?>


				<a class="btn btn-flat btn-sm btn-navy bg-gradient-navy border" href="./?page=vehicles/sell_vehicle&transaction_id=<?= isset($transaction_id) ? $transaction_id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<button class="btn btn-flat btn-sm btn-danger bg-gradient-danger" id="delete-transaction"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn-flat btn-sm btn-light bg-gradient-light border" onclick="history.back()"><i class="fa fa-angle-left"></i> Back</a>
			</div>
		</div>
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid" id="printout">
					<table class="table table-bordered">
						<tbody>
							<tr>

							</tr>
							<tr>
								<td>Name</td>
								<td><?= isset($transaction['name']) ? $transaction['name'] : '' ?></td>
							</tr>
							<tr>
								<td>Borker Name</td>
								<td><?= isset($transaction['broker_name']) ? $transaction['broker_name'] : '' ?></td>
							</tr>
							<tr>
								<td>Father's Name</td>
								<td><?= isset($transaction['father_name']) ? $transaction['father_name'] : '' ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?= isset($transaction['address']) ? $transaction['address'] : '' ?></td>
							</tr>
							<tr>
								<td>Post Office</td>
								<td><?= isset($transaction['post_office']) ? $transaction['post_office'] : '' ?></td>
							</tr>
							<tr>
								<td>Police Station</td>
								<td><?= isset($transaction['police_station']) ? $transaction['police_station'] : '' ?></td>
							</tr>
							<tr>
								<td>District</td>
								<td><?= isset($transaction['district']) ? $transaction['district'] : '' ?></td>
							</tr>
							<tr>
								<td>Pin</td>
								<td><?= isset($transaction['pin']) ? $transaction['pin'] : '' ?></td>
							</tr>
							<tr>
								<td>Contact Number</td>
								<td><?= isset($transaction['contact_number']) ? $transaction['contact_number'] : '' ?></td>
							</tr>
							<tr>
								<td>Age</td>
								<td><?= isset($transaction['age']) ? $transaction['age'] : '' ?></td>
							</tr>
							<tr>
								<td>Nominee Name</td>
								<td><?= isset($transaction['NomineeName']) ? $transaction['NomineeName'] : '' ?></td>
							</tr>
							<tr>
								<td>Relationship</td>
								<td><?= isset($transaction['Relationship']) ? $transaction['Relationship'] : '' ?></td>
							</tr>
							<tr>
								<td>Bike Name</td>
								<td><?= isset($bike_name) ? $bike_name : '' ?></td>
							</tr>
							<tr>
								<td>Key Number</td>
								<td><?= isset($key_number) ? $key_number : '' ?></td>
							</tr>
							<tr>
								<td>Battery Maker</td>
								<td><?= isset($battery_maker) ? $battery_maker : '' ?></td>
							</tr>
							<tr>
								<td>Battery Number</td>
								<td><?= isset($battery_number) ? $battery_number : '' ?></td>
							</tr>
							<tr>
								<td>Ex-Showroom Price</td>
								<td><?= isset($ex_showroom_price) ? $ex_showroom_price : '' ?></td>
							</tr>
							<tr>
								<td>On-Road Price</td>
								<td><?= isset($on_road_price) ? $on_road_price : '' ?></td>
							</tr>
							<tr>
								<td>Engine Details</td>
								<td><?= isset($engine_details) ? $engine_details : '' ?></td>
							</tr>
							<tr>
								<td>Brakes</td>
								<td><?= isset($brakes) ? $brakes : '' ?></td>
							</tr>
							<tr>
								<td>HSN Code</td>
								<td><?= isset($hsn_code) ? $hsn_code : '' ?></td>
							</tr>
							<tr>
								<td>Chassis Number</td>
								<td><?= isset($chassis_number) ? $chassis_number : '' ?></td>
							</tr>
							<tr>
								<td>Engine Number</td>
								<td><?= isset($engine_number) ? $engine_number : '' ?></td>
							</tr>
							<tr>
								<td>Mileage</td>
								<td><?= isset($mileage) ? $mileage : '' ?></td>
							</tr>
							<tr>
								<td>All Documents</td>
								<td>
									<?php
									$documents = [
										['file' => $transaction['aadhaar_card'], 'title' => 'Aadhaar Card'],
										['file' => $transaction['pan_card'], 'title' => 'PAN Card'],
										['file' => $transaction['dl_or_ll'], 'title' => 'Driving License'],
										['file' => $transaction['bank_passbook'], 'title' => 'Bank Passbook'],
										['file' => $transaction['voter_file'], 'title' => 'Voter ID'],
										['file' => $transaction['other_document'], 'title' => 'Other Document'],
										['file' => $bike_chalan, 'title' => 'Bike Chalan']
									];

									foreach ($documents as $doc) {
										$document = $doc['file'];
										$title = $doc['title'];
										if (!empty($document)) {
											$fileType = pathinfo($document, PATHINFO_EXTENSION);
											if ($fileType === 'pdf') {
												// If the file is a PDF, display it using an iframe with specified width, height, and scrolling
												echo '<a href="../admin/customer/docs/' . $document . '" download title="' . $title . '"><iframe src="../admin/customer/docs/' . $document . '" width="100" height="100" scrolling="yes" style="margin: 10px;"></iframe></a>';
											} elseif (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
												// If the file is an image, display it using an <img> tag with specified width and height
												echo '<a href="../admin/customer/docs/' . $document . '" download title="' . $title . '"><img src="../admin/customer/docs/' . $document . '" alt="' . $title . '" style="width: 100px; height: 100px; margin: 10px;"></a>';
											} else {
												// Handle other file types (if needed)
												echo 'File type not supported';
											}
										}
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- ALL SCRIPT -->
<script>
	$(document).ready(function() {
		$('#delete-transaction').click(function() {
			_conf("Are you sure to delete this transaction permanently?", "delete_transaction", ['<?= isset($id) ? $id : '' ?>'])
		})
	})

	function delete_transaction($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_transaction",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.replace('./?page=vehicles/transactions');
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
	// modal section
	$(document).ready(function() {
		$("#change_atatu").on("click", function() {
			$("#customModalLabel").text("All Stages");
			$("#customModal").modal("show");
		});
	});
	// dealer email ection
	$(document).ready(function() {
		$("#send_dealer").on("click", function() {
			$(this).prop("disabled", true);
			var transactionId = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
			$.ajax({
				url: './?page=mailer/mail_dealer',
				type: 'POST',
				data: {
					transaction_id: transactionId
				},
				success: function(response) {
					alert("Mail Has Been Sent To Dealer");
					setTimeout(function() {
						location.reload();
					}, 500);
				},
				error: function(xhr, status, error) {
					alert("Error: " + error);
				}
			});
		});

	});

	// update insurance stage
	$("#submitInsuranceBtn").on("click", function() {
		var insuranceInfo = $("#insuranceInfo").val();
		var transactionId = $("#transaction_id").val();
		var insuranceStage = $("#insuranceStage").val();

		// Make AJAX call
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=update_insurance",
			type: "POST",
			data: {
				insuranceInfo: insuranceInfo,
				transactionId: transactionId,
				insuranceStage: insuranceStage
			},

			success: function(response) {
				// Handle success response
				alert("Insurance details submitted successfully!");
				$("#insuranceModal").modal("hide");
				// Refresh the page after a short delay
				setTimeout(function() {
					location.reload();
				}, 500);
			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
				alert("Error: " + error);
			}
		});
	});
	// update road tax stages 
	$("#submitRoadTax").on("click", function() {
		var roadTaxStage = $("#roadTaxStage").val();
		var transactionId = '<?php echo isset($transaction_id) ? $transaction_id : ''; ?>';

		// Make AJAX call
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=update_road_tax",
			type: "POST",
			data: {
				roadTaxStage: roadTaxStage,
				transactionId: transactionId
			},
			success: function(response) {
				alert("Road Tax details submitted successfully!");
				$("#roadTaxModal").modal("hide");
				setTimeout(function() {
					location.reload();
				}, 300);
			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
				alert("Error: " + error);
			}
		});
	});
	// update number plate stage
	$("#submitNumberPlate").on("click", function() {
		var plateStage = $("#plateStage").val();
		// alert(plateStage);
		var transactionId = '<?php echo isset($transaction_id) ? $transaction_id : ''; ?>';
		// Make AJAX call
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=update_number_plate",
			type: "POST",
			data: {
				plateStage: plateStage,
				transactionId: transactionId
			},
			success: function(response) {
				// Handle success response
				alert("Number Plate details submitted successfully!");
				$("#numberPlateModal").modal("hide");
				// Refresh the page after a short delay
				setTimeout(function() {
					location.reload();
				}, 300);
			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
				alert("Error: " + error);
			}
		});
	});
</script>