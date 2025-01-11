<?php

if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
	$transaction_qry = $conn->query("SELECT * from `transaction_list` where id = '{$_GET['transaction_id']}' ");
	// print_r($transaction_qry);
	if ($transaction_qry->num_rows > 0) {
		foreach ($transaction_qry->fetch_assoc() as $k => $v) {
			$transaction[$k] = $v;
		}
	}
	if (isset($transaction['vehicle_id'])) {
		$vehicle_id = $transaction['vehicle_id'];
	}
	$transaction_id = $_GET['transaction_id'];
} else if (isset($_GET['id']) && $_GET['id'] > 0) {
	$vehicle_id = $_GET['id'];
} else {
	echo '<script>alert("Vehicle ID is not valid."); location.replace("./?page=vehicles")</script>';
}
$qry = $conn->query("SELECT * from `vehicle_list` where id = '{$vehicle_id}' ");


if ($qry->num_rows > 0) {
	foreach ($qry->fetch_assoc() as $k => $v) {
		$$k = $v;
	}
}
if (isset($model_id)) {
	$model_qry = $conn->query("SELECT m.*, b.name as `brand` from `model_list` m inner join brand_list b on m.brand_id = b.id  where m.id = '{$model_id}'");

	if ($model_qry->num_rows > 0) {
		foreach ($model_qry->fetch_assoc() as $k => $v) {
			$model[$k] = $v;
		}
	}
	// print_r($model[$k]);
}


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

<div class="content py-5 px-3 bg-gradient-navy">
	<h4 class="font-wight-bolder">Transaction Form</h4>
</div>

<div class="row mt-n4 align-items-center justify-content-center flex-column">
	<div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-header py-1">
				<div class="card-title"><b>Bike Details</b></div>
			</div>
			<div class="card-body">
				<div class="container-fluid">
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Brand:</div>
						<div class="col-9 mb-0 border"><?= isset($model['brand']) ? $model['brand'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Bike Name</div>
						<div class="col-9 mb-0 border"><?= isset($bike_name) ? $bike_name : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Key Number</div>
						<div class="col-9 mb-0 border"><?= isset($key_number) ? $key_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">HSN Code</div>
						<div class="col-9 mb-0 border"><?= isset($hsn_code) ? $hsn_code : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Engine Number</div>
						<div class="col-9 mb-0 border"><?= isset($engine_number) ? $engine_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Chasis Number</div>
						<div class="col-9 mb-0 border"><?= isset($chassis_number) ? $chassis_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Ex Showroom Price</div>
						<div class="col-9 mb-0 border"><?= isset($ex_showroom_price) ? format_num($ex_showroom_price, 2) : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">On Road Price</div>
						<div class="col-9 mb-0 border"><?= isset($on_road_price) ? format_num($on_road_price, 2) : '' ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<form action="" id="transaction-form">
						<input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo isset($vehicle_id) ? $vehicle_id : '' ?>">
						<input type="hidden" name="id" id="id" value="<?php echo isset($transaction_id) ? $transaction_id : '' ?>">


						<div class="row">
							<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<label for="agent_name" class="control-label">Sales Person</label>
								<input type="text" name="agent_name" id="agent_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['agent_name']) ? $transaction['agent_name'] : ''; ?>" required />
							</div>

							<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<label for="customer_id" class="control-label">Customer</label>
								<select name="customer_id" id="customer_id" class="form-control form-control-sm rounded-0" required>
									<option value="">Select Customer</option>
									<?php
									// Fetch customers from the database
									$customer_query = $conn->query("SELECT * FROM customers ORDER BY id ASC");
									while ($customer = $customer_query->fetch_assoc()) {
										$selected = isset($transaction['id']) && $transaction['id'] == $customer['id'] ? 'selected' : '';
										echo "<option value='{$customer['id']}' $selected>{$customer['name']}</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<button id="submitKycBtn" class="btn btn-primary mt-3">Document</button>
							</div>

							<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<label for="broker_id" class="control-label">Broker</label>
								<select name="broker_id" id="broker_id" class="form-control form-control-sm rounded-0" required>
									<option value="">Select Broker</option>
									<?php
									// Fetch brokers from the database
									$broker_query = $conn->query("SELECT * FROM brokers ORDER BY broker_name ASC");
									while ($broker = $broker_query->fetch_assoc()) {
										$selected = isset($transaction['broker_id']) && $transaction['broker_id'] == $broker['broker_id'] ? 'selected' : '';
										echo "<option value='{$broker['broker_id']}' $selected>{$broker['broker_name']}</option>";
									}
									?>
								</select>
							</div>

							<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<label for="payment_mode" class="control-label">Payment Method</label>
								<select name="payment_mode" id="payment_mode" class="form-control form-control-sm rounded-0" required>
									<option value="">Select Payment Method</option>
									<?php
									// Define available payment methods
									$payment_methods = array('CASH', 'HIPOTHECATION');

									// Iterate through payment methods
									foreach ($payment_methods as $method) {
										// Check if the payment mode is set and matches the current method
										$selected = isset($transaction['payment_mode']) && $transaction['payment_mode'] == $method ? 'selected' : '';

										// Output the option tag
										echo "<option value='$method' $selected>$method</option>";
									}
									?>
								</select>
							</div>


							<div class="form-group col-lg-4 col-md-2 col-sm-12 col-xs-12">
								<label for="" class="control-label"></label>
								<input type="text" placeholder="Hypothecation Name" name="hypothecation_name" id="hypothecation_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['hypothecation_name']) ? $transaction['hypothecation_name'] : ''; ?>" />
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="insurance_provider" class="control-label">Insurance&nbsp;Provider</label>
								<select name="insurance_provider" id="insurance_provider" class="form-control form-control-sm rounded-0" required="required">
									<?php
									$insurance = $conn->query("SELECT * FROM `insurance` where delete_flag = 0 and `status` = 1 order by `provider` asc");
									while ($row = $insurance->fetch_assoc()) :
									?>
										<option value="<?= $row['id'] ?>" <?php
																			if (isset($transaction['insurance_provider'])) :
																				if ($transaction['insurance_provider'] == $row['id']) {
																					echo 'selected';
																				} else {
																					echo "";
																				}
																			endif; ?>><?= $row['provider'] ?></option>
									<?php
									endwhile;
									?>
								</select>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="insurance_amount" class="control-label">Insurance&nbsp;Amount</label>
								<input type="number" name="insurance_amount" id="insurance_amount" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['insurance_amount']) ? $transaction['insurance_amount'] : ''; ?>" required />
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-flat btn-sm btn-navy bg-gradient-navy" form="transaction-form"><i class="fa fa-save"></i> Save</button>
				<?php if (isset($transaction['id']) && $transaction['id']) : ?>
					<a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="./?page=vehicles/view_transaction&id=<?= isset($transaction['id']) ? $transaction['id'] : '' ?>"><i class="fa fa-angle-left"></i> Cancel</a>
				<?php else : ?>
					<a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="./?page=vehicles"><i class="fa fa-angle-left"></i> Cancel</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- kyc modal -->
<div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">KYC Submission</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="selectedCustomerId" name="selectedCustomerId">
				<div class="form-group">
					<label for="aadhaarFile">Aadhaar Card</label>
					<input type="file" class="form-control-file" id="aadhaarFile" name="aadhaarFile">
					<?php if (!empty($aadhaarFilePath)) : ?>
						<a href="<?php echo $aadhaarFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="panFile">PAN Card</label>
					<input type="file" class="form-control-file" id="panFile" name="panFile">
					<?php if (!empty($panFilePath)) : ?>
						<a href="<?php echo $panFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="dl_llFile">Driving License / Learner's License</label>
					<input type="file" class="form-control-file" id="dl_llFile" name="dl_llFile">
					<?php if (!empty($dl_llFilePath)) : ?>
						<a href="<?php echo $dl_llFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="bankPassbookFile">Bank Passbook</label>
					<input type="file" class="form-control-file" id="bankPassbookFile" name="bankPassbookFile">
					<?php if (!empty($bankPassbookFilePath)) : ?>
						<a href="<?php echo $bankPassbookFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="voterFile">Voter File</label>
					<input type="file" class="form-control-file" id="voterFile" name="voterFile">
					<?php if (!empty($voterFilePath)) : ?>
						<a href="<?php echo $voterFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="otherDocumentFile">Other Document</label>
					<input type="file" class="form-control-file" id="otherDocumentFile" name="otherDocumentFile">
					<?php if (!empty($otherDocumentFilePath)) : ?>
						<a href="<?php echo $otherDocumentFilePath; ?>" target="_blank">View Uploaded File</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="submitKycFormBtn" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>



<script>
	// CUSTOMER SECTION
	$(document).ready(function() {
		var anchortag = document.querySelectorAll('a');
		for (let index = 0; index < anchortag.length; index++) {
			const element = anchortag[index];
			if (element.innerHTML == "Developed by Deltaminds") {
				element.parentElement.style.display = "none";
			}
		}
		$('#transaction-form').submit(function(e) {
			e.preventDefault();
			var pmode = $('#payment_mode').val();
			var data = {};
			var _this = $(this);
			// Loop through form fields and add them to the data object
			$(this).find('input, select').each(function() {
				var fieldId = $(this).attr('id');
				var fieldValue = $(this).val();
				data[fieldId] = fieldValue;
			});
			// Make AJAX request to save transaction
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_transaction",
				method: 'POST',
				contentType: 'application/json',
				data: JSON.stringify(data),
				error: function(err) {
					console.log(err);
					alert_toast("An error occurred", 'error');
					end_loader();
				},
				success: function(resp) {
					resp = JSON.parse(resp);
					if (typeof resp == 'object' && resp.status == 'success') {
						location.replace('./?page=vehicles/view_transaction&id=' + resp.tid);
					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>').addClass("alert alert-danger err-msg").text(resp.msg);
						_this.prepend(el);
						el.show('slow');
						$("html, body").scrollTop(0);
					} else {
						alert_toast("An error occurred", 'error');
					}
					end_loader();
				}
			});
		});
	});
	// customer document store part
	$(document).ready(function() {
		$(document).ready(function() {
			// Hide the "Submit KYC" button by default
			$('#submitKycBtn').hide();

			// Change event handler for the customer_id dropdown
			$('#customer_id').change(function() {
				var customerId = $(this).val();
				$('#selectedCustomerId').val(customerId);

				// Show or hide the "Submit KYC" button based on whether a customer is selected
				if (customerId) {
					$('#submitKycBtn').show();
				} else {
					$('#submitKycBtn').hide();
				}
			});
		});


		$('#submitKycBtn').click(function() {
			$('#kycModal').modal('show');
		});

		$('#submitKycFormBtn').click(function() {
			var formData = new FormData();

			// Add input field values to the FormData object
			formData.append('customerId', $('#selectedCustomerId').val());
			formData.append('aadhaarFile', $('#aadhaarFile')[0].files[0]);
			formData.append('panFile', $('#panFile')[0].files[0]);
			formData.append('dl_llFile', $('#dl_llFile')[0].files[0]);
			formData.append('bankPassbookFile', $('#bankPassbookFile')[0].files[0]);
			formData.append('voterFile', $('#voterFile')[0].files[0]); // Add Voter File
			formData.append('otherDocumentFile', $('#otherDocumentFile')[0].files[0]); // Add Other Document
			// Add additional form fields if needed

			// Make AJAX call
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=submit_customer_doc",
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					// Handle success response
					console.log(response);
					// $('#kycModal').modal('hide');
				},
				error: function(xhr, status, error) {
					// Handle error response
					console.error(xhr, status, error);
					alert('An error occurred while submitting the form.');
				}
			});
		});


	});
	// Hide and disable the hypothecation name input by default
	$(document).ready(function() {
		$('#hypothecation_name').prop('disabled', true).hide();
		// Show and enable the hypothecation name input when HIPOTHECATION is selected
		$('#payment_mode').change(function() {
			if ($(this).val() === 'HIPOTHECATION') {
				$('#hypothecation_name').prop('disabled', false).show().prop('required', true);
			} else {
				$('#hypothecation_name').prop('disabled', true).hide().prop('required', false);
			}
		});
	});
</script>