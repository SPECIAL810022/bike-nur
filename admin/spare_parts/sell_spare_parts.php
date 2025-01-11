<?php
if (isset($_GET['transaction_id']) && $_GET['transaction_id'] > 0) {
	$transaction_qry = $conn->query("SELECT * from `transaction_list` where id = '{$_GET['transaction_id']}' ");
	if ($transaction_qry->num_rows > 0) {
		foreach ($transaction_qry->fetch_assoc() as $k => $v) {
			$transaction[$k] = $v;
		}
	}
	if (isset($transaction['vehicle_id'])) {
		$spare_part_id = $transaction['vehicle_id'];
	}
} else if (isset($_GET['id']) && $_GET['id'] > 0) {
	$spare_part_id = $_GET['id'];
} else {
	echo '<script>alert("SPARE PARTS ID is not valid."); location.replace("./?page=spare_parts")</script>';
}

$qry = $conn->query("SELECT *,`PART NUMBER` as part_number,`PART NAME` as part_name,`Sale Price` as sale_price,`HSN CODE` as hsn_code,`SR NO` as sr_no FROM `spare_parts` WHERE `SR NO` = '$spare_part_id'");
if ($qry->num_rows > 0) {
	foreach ($qry->fetch_assoc() as $k => $v) {
		$$k = $v;
	}
}
if (isset($sr_no)) {
	$model_qry = $conn->query("SELECT sp.*, sp_transaction.* from `spare_parts` sp inner join spare_parts_transaction_list sp_transaction on sp.`SR NO` = '$sr_no'");
	$ar = $model_qry->num_rows;
	if ($model_qry->num_rows > 0) {
		foreach ($model_qry->fetch_assoc() as $k => $v) {
			$spare_partss[$k] = $v;
		}
	}
}
if (isset($transaction['emi_amount'])) {
	$emi_details = htmlspecialchars_decode($transaction['emi_amount']);
	$ar = json_decode($emi_details, true);
	if (isset($ar)) {
		$down_payment = $ar['down_payment'];
		$loan_amount
			= $ar['loan_amount'];
		$emi_monthly_payment
			= $ar['emi_monthly_payment'];
		$emi_duration
			= $ar['emi_duration'];
		$emi_start_date
			= $ar['emi_start_date'];
	}
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
				<div class="card-title"><b>Spare Part Details</b></div>
			</div>
			<div class="card-body">
				<div class="container-fluid">
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Type:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['TYPE']) ? $spare_partss['TYPE'] : $TYPE ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Part No.:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['PART NUMBER']) ? $spare_partss['PART NUMBER'] : $part_number ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Part Name:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['PART NAME']) ? $spare_partss['PART NAME'] : $part_name ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Gst:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['IGST']) ? $spare_partss['IGST'] : $IGST ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Hsn Code:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['HSN CODE']) ? htmlspecialchars_decode($spare_partss['HSN CODE']) : $hsn_code ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Price:</div>
						<div class="col-9 mb-0 border"><?= isset($spare_partss['Sale Price']) ? format_num($spare_partss['Sale Price'], 2) : format_num($sale_price, 2) ?></div>
					</div>
					<div class="clear-fix my-1"></div>
				</div>
			</div>
		</div>
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<form action="" id="transaction-form">
						<input type="hidden" name="id" id="trans_id" value="<?php echo isset($transaction['id']) ? $transaction['id'] : '' ?>">
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="agent_name" class="control-label">Agent Name</label>
								<input type="text" name="agent_name" id="agent_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['agent_name']) ? $transaction['agent_name'] : ''; ?>" required />
							</div>
						</div>
						<h5><b>Customer Details</b></h5>
						<div class="row">
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label for="firstname" class="control-label">First Name</label>
								<input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['firstname']) ? $transaction['firstname'] : ''; ?>" required />
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label for="middlename" class="control-label">Middle Name</label>
								<input type="text" name="middlename" id="middlename" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['middlename']) ? $transaction['middlename'] : ''; ?>" />
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label for="lastname" class="control-label">Last Name</label>
								<input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['lastname']) ? $transaction['lastname'] : ''; ?>" required />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="sex" class="control-label">Sex</label>
								<select name="sex" id="sex" class="form-control form-control-sm rounded-0" required>
									<option value="Male" <?= isset($sex) && $sex == 'Male' ? 'selected' : '' ?>>Male</option>
									<option value="Female" <?= isset($sex) && $sex == 'Female' ? 'selected' : '' ?>>Female</option>
								</select>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="care_of" class="control-label">C/O</label>
								<input type="text" name="care_of" id="care_of" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['care_of']) ? $transaction['care_of'] : ''; ?>" required />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="contact" class="control-label">Contact #</label>
								<input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['contact']) ? $transaction['contact'] : ''; ?>" required />
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="email" class="control-label">Email</label>
								<input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['email']) ? $transaction['email'] : ''; ?>" />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="states" class="control-label">States</label>
								<select name="states" id="states" class="form-control form-control-sm">
									<option value="Andhra Pradesh" <?php
																	if (isset($transaction['states'])) :
																		if ($transaction['states'] == "Andhra Pradesh") {
																			echo "selected";
																		} else {
																			echo "";
																		}
																	endif;
																	?>>Andhra Pradesh</option>
									<option value="Arunachal Pradesh" <?php
																		if (isset($transaction['states'])) :
																			if ($transaction['states'] == "Arunachal Pradesh") {
																				echo "selected";
																			} else {
																				echo "";
																			}
																		endif;
																		?>>Arunachal Pradesh</option>
									<option value="Assam" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Assam") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Assam</option>
									<option value="Bihar" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Bihar") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Bihar</option>
									<option value="Chhattisgarh" <?php
																	if (isset($transaction['states'])) :
																		if ($transaction['states'] == "Chhattisgarh") {
																			echo "selected";
																		} else {
																			echo "";
																		}
																	endif;
																	?>>Chhattisgarh</option>
									<option value="Goa" <?php
														if (isset($transaction['states'])) :
															if ($transaction['states'] == "Goa") {
																echo "selected";
															} else {
																echo "";
															}
														endif;
														?>>Goa</option>
									<option value="Gujarat" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Gujarat") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Gujarat</option>
									<option value="Haryana" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Haryana") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif; ?>>Haryana</option>
									<option value="Himachal Pradesh" <?php
																		if (isset($transaction['states'])) :
																			if ($transaction['states'] == "Himachal Pradesh") {
																				echo "selected";
																			} else {
																				echo "";
																			}
																		endif; ?>>Himachal Pradesh</option>
									<option value="Jharkhand" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Jharkhand") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif; ?>>Jharkhand</option>
									<option value="Karnataka" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Karnataka") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif; ?>>Karnataka</option>
									<option value="Kerala" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Kerala") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif; ?>>Kerala</option>
									<option value="Madhya Pradesh" <?php
																	if (isset($transaction['states'])) :
																		if ($transaction['states'] == "Madhya Pradesh") {
																			echo "selected";
																		} else {
																			echo "";
																		}
																	endif;
																	?>>Madhya Pradesh</option>
									<option value="Maharashtra" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Maharashtra") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Maharashtra</option>
									<option value="Manipur" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Manipur") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Manipur</option>
									<option value="Meghalaya" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Meghalaya") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif; ?>>Meghalaya</option>
									<option value="Mizoram" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Mizoram") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Mizoram</option>
									<option value="Nagaland" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Nagaland") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Nagaland</option>
									<option value="Odisha" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Odisha") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Odisha</option>
									<option value="Punjab" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Punjab") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Punjab</option>
									<option value="Rajasthan" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Rajasthan") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Rajasthan</option>
									<option value="Sikkim" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Sikkim") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Sikkim</option>
									<option value="Tamil Nadu" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Tamil Nadu") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Tamil Nadu</option>
									<option value="Telangana" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Telangana") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Telangana</option>
									<option value="Tripura" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Tripura") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif; ?>>Tripura</option>
									<option value="Uttar Pradesh" <?php
																	if (isset($transaction['states'])) :
																		if ($transaction['states'] == "Uttar Pradesh") {
																			echo "selected";
																		} else {
																			echo "";
																		}
																	endif; ?>>Uttar Pradesh</option>
									<option value="Uttarakhand" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Uttarakhand") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif; ?>>Uttarakhand</option>
									<option value="West Bengal" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "West Bengal") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?> selected>West Bengal</option>
									<option value="Andaman and Nicobar Islands" <?php
																				if (isset($transaction['states'])) :
																					if ($transaction['states'] == "Andaman and Nicobar Islands") {
																						echo "selected";
																					} else {
																						echo "";
																					}
																				endif; ?>>Andaman and Nicobar Islands</option>
									<option value="Chandigarh" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Chandigarh") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Chandigarh</option>
									<option value="Dadra and Nagar Haveli and Daman and Diu" <?php
																								if (isset($transaction['states'])) :
																									if ($transaction['states'] == "Dadra and Nagar Haveli and Daman and Diu") {
																										echo "selected";
																									} else {
																										echo "";
																									}
																								endif;
																								?>>Dadra and Nagar Haveli and Daman and Diu</option>
									<option value="Lakshadweep" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Lakshadweep") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Lakshadweep</option>
									<option value="Ladakh" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Ladakh") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Ladakh</option>
									<option value="Puducherry" <?php
																if (isset($transaction['states'])) :
																	if ($transaction['states'] == "Puducherry") {
																		echo "selected";
																	} else {
																		echo "";
																	}
																endif;
																?>>Puducherry</option>
									<option value="Delhi" <?php
															if (isset($transaction['states'])) :
																if ($transaction['states'] == "Delhi") {
																	echo "selected";
																} else {
																	echo "";
																}
															endif;
															?>>Delhi</option>
								</select>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="village" class="control-label">Village</label>
								<input type="text" name="village" id="village" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['village']) ? $transaction['village'] : ''; ?>" required />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="district" class="control-label">District</label>
								<input type="text" name="district" id="district" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['district']) ? $transaction['district'] : ''; ?>" required />
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="post_office" class="control-label">Post&nbsp;Office</label>
								<input type="text" name="post_office" id="post_office" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['post_office']) ? $transaction['post_office'] : ''; ?>" />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="police_station" class="control-label">Police&nbsp;Station</label>
								<input type="text" name="police_station" id="police_station" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['police_station']) ? $transaction['police_station'] : ''; ?>" required />
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="pin_no" class="control-label">Pin&nbsp;No</label>
								<input type="text" name="pin_no" id="pin_no" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['pin_no']) ? $transaction['pin_no'] : ''; ?>" />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="aadhar_no" class="control-label">Aadhar&nbsp;No.</label>
								<input type="text" name="aadhar_no" id="aadhar_no" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['aadhar_no']) ? $transaction['aadhar_no'] : ''; ?>" required />
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="pan_no" class="control-label">Pan&nbsp;No.</label>
								<input type="text" name="pan_no" id="pan_no" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['pan_no']) ? $transaction['pan_no'] : ''; ?>" required />
							</div>
						</div>

						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="gst" class="control-label">Gst&nbsp;(%)</label>
								<input type="number" name="gst" id="gst" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction['gst']) ? $transaction['gst'] : ''; ?>" required />
							</div>

						</div>
						<div class="row">
							<div class="row d-flex payment_div">
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-2">
									<label for="emi_amount" class="form-label payment_mode_div">Payment&nbsp;Mode:&nbsp;&nbsp;</label>
									<select name="payment_mode" id="payment_mode" class="form-control form-control-sm rounded-0">
										<option value="">---Select Payment Mode---</option>
										<option value="emi" <?php echo (isset($transaction['emi']) ? 'selected' : '') ?>>Emi</option>
										<option value="cash" <?php echo (isset($transaction['cash']) ? 'selected' : '') ?>>Cash</option>
										<option value="card" <?php echo (isset($transaction['card_no']) ? 'selected' : '') ?>>Card</option>
									</select>
								</div>
								<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-2">
									<label for="emi_amount" class="form-label emi_amount_label" style="display:none;">Downpayment</label>
									<input type="number" name="emi_amount" id="emi_amount" value="<?php echo isset($down_payment) ? $down_payment : ''; ?>" class="form-control form-control-sm rounded-0" style="display:none;">
									<label for="loan_amount" class="form-label loan_amount_label" style="display:none;">Loan&nbsp;Amount</label>
									<input type="number" name="loan_amount" id="loan_amount" value="<?php echo isset($loan_amount) ? $loan_amount : ''; ?>" class="form-control form-control-sm rounded-0" style="display:none;">
									<label for="emi_monthly_payment" class="form-label emi_monthly_payment_label" style="display:none;">Emi&nbsp;Monthly&nbsp;Payment</label>
									<input type="number" name="emi_monthly_payment" id="emi_monthly_payment" value="<?php echo isset($emi_monthly_payment) ? $emi_monthly_payment : ''; ?>" class="form-control form-control-sm rounded-0" style="display:none;">
									<label for="emi_start_date" class="form-label emi_start_date_label" style="display:none;">Start&nbsp;Date</label>
									<input type="date" name="emi_start_date" id="emi_start_date" value="<?php echo isset($emi_start_date) ? $emi_start_date : ''; ?>" class="form-control form-control-sm rounded-0" style="display:none;">
									<label for="emi_duration" class="form-label emi_duration_label" style="display:none;">Emi&nbsp;Duration</label>
									<input type="number" name="emi_duration" id="emi_duration" value="<?php echo isset($emi_duration) ? $emi_duration : ''; ?>" placeholder="Duration In Years" class="form-control form-control-sm rounded-0" style="display:none;">
									<label for="card_no" class="form-label card_no_label" style="display:none;">Card&nbsp;No.</label>
									<input type="number" value="<?php echo isset($transaction['card_no']) ? $transaction['card_no'] : ''; ?>" name="card_no" id="card_no" style="display:none;" class="form-control form-control-sm rounded-0">
									<label for="cash_amount" class="form-label cash_amount_label" style="display:none;">Cash&nbsp;Amount</label>
									<input type="number" style="display:none;" name="cash" id="cash_amount" value="<?php echo isset($transaction['cash']) ? $transaction['cash'] : ''; ?>" class="form-control form-control-sm rounded-0">
								</div>
							</div>
						</div>
						<!-- <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="spare_parts_id" class="control-label">Accessories/Parts</label>
								<select name="spare_parts_id" id="spare_parts_id" class="form-control form-control-sm rounded-0" required="required" multiple>
									<//?php
									$car_types = $conn->query("SELECT * FROM `spare_parts`");
									while ($row = $car_types->fetch_assoc()) :
									?>
										<option value="<//?= $row['SR NO'] ?>"><//?= $row['PART NAME'] ?></option>
									<//?php endwhile; ?>
								</select>
							</div> -->
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

<script>
	$(document).ready(function() {
		var anchortag = document.querySelectorAll('a')
		for (let index = 0; index < anchortag.length; index++) {
			const element = anchortag[index];
			if (element.innerHTML == "Developed by Deltaminds") {
				element.parentElement.style.display = "none"
			}
		}
		var care_of;
		var post_office;
		var pin_no;
		var police_station;
		var village;
		var ins_am;
		var road_am;
		var number_plate_am;
		var net_payable_amount;
		var totalamount;
		var gst;
		var pmode;
		var payment_mode_check_emi = "<?= (isset($transaction['card_no']) ? $transaction['card_no'] : '') ?>";
		var payment_mode_check_card = "<?= (isset($transaction['cash']) ? $transaction['cash'] : '') ?>";;
		var payment_mode_check_cash = "<?= (isset($transaction['emi']) ? $transaction['emi'] : '') ?>"
		if (payment_mode_check_emi) {
			$('.emi_amount_label').show()
			$('#emi_amount').show()
			$('.emi_monthly_payment_label').show()
			$('#emi_monthly_payment').show()
			$('.loan_amount_label').show()
			$('#loan_amount').show()
			$('.emi_duration_label').show()
			$('#emi_duration').show()
			$('.emi_start_date_label').show()
			$('#emi_start_date').show()
			$('#emi_duration').show()
			$('.cash_amount_label').hide()
			$('#cash_amount').hide()
			$('.card_no_label').hide()
			$('#card_no').hide()
		}
		if (payment_mode_check_card) {
			$('.card_no_label').show()
			$('#card_no').show()
			$('.emi_amount_label').hide()
			$('#emi_amount').hide()
			$('.cash_amount_label').hide()
			$('#cash_amount').hide()
			$('.loan_amount_label').hide()
			$('#loan_amount').hide()
			$('.emi_duration_label').hide()
			$('#emi_duration').hide()
			$('.emi_monthly_payment_label').hide()
			$('#emi_monthly_payment').hide()
			$('.emi_start_date_label').hide()
			$('#emi_start_date').hide()
			$('#emi_duration').hide()
		}
		if (payment_mode_check_cash) {
			$('.cash_amount_label').show()
			$('#cash_amount').show()
			$('.emi_amount_label').hide()
			$('#emi_amount').hide()
			$('.card_no_label').hide()
			$('#card_no').hide()
			$('.loan_amount_label').hide()
			$('#loan_amount').hide()
			$('.emi_duration_label').hide()
			$('#emi_duration').hide()
			$('.emi_start_date_label').hide()
			$('#emi_start_date').hide()
			$('#emi_duration').hide()
			$('.emi_monthly_payment_label').hide()
			$('#emi_monthly_payment').hide()
		}
		$('#payment_mode').change(() => {
			pmode = $('#payment_mode').val()
			if (pmode == "emi") {
				$('.emi_amount_label').show()
				$('#emi_amount').show()
				$('.emi_monthly_payment_label').show()
				$('#emi_monthly_payment').show()
				$('.loan_amount_label').show()
				$('#loan_amount').show()
				$('.emi_duration_label').show()
				$('#emi_duration').show()
				$('.emi_start_date_label').show()
				$('#emi_start_date').show()
				$('#emi_duration').show()
				$('.cash_amount_label').hide()
				$('#cash_amount').hide()
				$('.card_no_label').hide()
				$('#card_no').hide()
			} else if (pmode == "card") {
				$('.card_no_label').show()
				$('#card_no').show()
				$('.emi_amount_label').hide()
				$('#emi_amount').hide()
				$('.cash_amount_label').hide()
				$('#cash_amount').hide()
				$('.loan_amount_label').hide()
				$('#loan_amount').hide()
				$('.emi_duration_label').hide()
				$('#emi_duration').hide()
				$('.emi_monthly_payment_label').hide()
				$('#emi_monthly_payment').hide()
				$('.emi_start_date_label').hide()
				$('#emi_start_date').hide()
				$('#emi_duration').hide()
			} else {
				$('.cash_amount_label').show()
				$('#cash_amount').show()
				$('.emi_amount_label').hide()
				$('#emi_amount').hide()
				$('.card_no_label').hide()
				$('#card_no').hide()
				$('.loan_amount_label').hide()
				$('#loan_amount').hide()
				$('.emi_duration_label').hide()
				$('#emi_duration').hide()
				$('.emi_start_date_label').hide()
				$('#emi_start_date').hide()
				$('#emi_duration').hide()
				$('.emi_monthly_payment_label').hide()
				$('#emi_monthly_payment').hide()
			}
		})
		var amounts_of_parts;
		var emi_start_date;
		var emi_duration;
		var down_payment;
		var emi_monthly_payment;
		var loan_amount;
		var trans_id;
		var insurance_provider;
		$('#transaction-form').submit(function(e) {
			e.preventDefault();
			var agent_name = $('#agent_name').val()
			var firstname = $('#firstname').val()
			var middlename = ($('#middlename').val()) ? $('#middlename').val() : ""
			var lastname = $('#lastname').val()
			care_of = ($('#care_of').val()) ? $('#care_of').val() : ""
			village = ($('#village').val()) ? $('#village').val() : ""
			post_office = ($('#post_office').val()) ? $('#post_office').val() : ""
			pin_no = ($('#pin_no').val()) ? $('#pin_no').val() : ""
			police_station = ($('#police_station').val()) ? $('#police_station').val() : ""
			var sex = $('#sex').val()
			var dob = $('#dob').val()
			trans_id = ($('#trans_id').val()) ? $('#trans_id').val() : ""
			var contact = $('#contact').val()
			var email = $('#email').val()
			var states = $('#states').val()
			gst = ($('#gst').val()) ? $('#gst').val() : ""
			var city = ($('#city').val()) ? $('#city').val() : ""
			var district = ($('#district').val()) ? $('#district').val() : ""
			var block = ($('#block').val()) ? $('#block').val() : ""
			var aadhar_no = $('#aadhar_no').val()
			var pan_no = $('#pan_no').val()
			insurance_provider = $('#insurance_provider').val()
			ins_am = parseInt($('#insurance_amount').val())
			road_am = parseInt($('#roadtax_amount').val())
			number_plate_am = parseInt($('#numberplate_amount').val())
			emi_monthly_payment = $('#emi_monthly_payment').val()
			emi_start_date = $('#emi_start_date').val()
			down_payment = $('#emi_amount').val()
			emi_duration = $('#emi_duration').val()
			loan_amount = $('#loan_amount').val()
			var card_no = $('#card_no').val()
			var cash = ($('#cash_amount').val()) ? $('#cash_amount').val() : ""
			cash = parseInt(cash)
			if (down_payment || card_no || cash) {
				if (pmode == "emi") {
					if (down_payment && emi_duration && loan_amount && emi_start_date && emi_monthly_payment) {
						var _this = $(this)
						$('.err-msg').remove();
						start_loader();
						emi_amount = {
							"down_payment": down_payment,
							"loan_amount": loan_amount,
							"emi_duration": emi_duration,
							"emi_start_date": emi_start_date,
							"emi_monthly_payment": emi_monthly_payment
						}
						emi_amount = JSON.stringify(emi_amount)
						data = JSON.stringify({
							"id": trans_id,
							"vehicle_id": vehicle_id,
							"agent_name": agent_name,
							"firstname": firstname,
							"middlename": middlename,
							"lastname": lastname,
							"address": address,
							"care_of": care_of,
							"pin_no": pin_no,
							"village": village,
							"post_office": post_office,
							"police_station": police_station,
							"insurance_provider": insurance_provider,
							"sex": sex,
							"dob": dob,
							"contact": contact,
							"email": email,
							"states": states,
							"city": city,
							"district": district,
							"insurance_amount": ins_am,
							"roadtax_amount": road_am,
							"block": block,
							"aadhar_no": aadhar_no,
							"pan_no": pan_no,
							"payment_mode": pmode,
							"emi_amount": emi_amount,
							"numberplate_amount": number_plate_am,
							"gst": gst
						})
						$.ajax({
							url: _base_url_ + "classes/Master.php?f=save_spare_parts_transaction",
							cache: false,
							contentType: false,
							processData: false,
							method: 'POST',
							type: 'POST',
							contentType: 'application/json',
							data: JSON.stringify({
								"id": trans_id,
								"agent_name": agent_name,
								"firstname": firstname,
								"middlename": middlename,
								"care_of": care_of,
								"pin_no": pin_no,
								"village": village,
								"post_office": post_office,
								"police_station": police_station,
								"lastname": lastname,
								"sex": sex,
								"dob": dob,
								"contact": contact,
								"email": email,
								"states": states,
								"city": city,
								"district": district,
								"block": block,
								"insurance_amount": ins_am,
								"roadtax_amount": road_am,
								"aadhar_no": aadhar_no,
								"pan_no": pan_no,
								"payment_mode": pmode,
								"emi_amount": emi_amount,
								"numberplate_amount": number_plate_am,
								"gst": gst
							}),
							error: err => {
								console.log(err)
								alert_toast("An error occured", 'error');
								end_loader();
							},
							success: function(resp) {
								console.log(resp);
								retrun;
								resp = JSON.parse(resp)
								if (typeof resp == 'object' && resp.status == 'success') {
									location.replace('./?page=vehicles/view_transaction&id=' + resp.tid)
								} else if (resp.status == 'failed' && !!resp.msg) {
									var el = $('<div>')
									el.addClass("alert alert-danger err-msg").text(resp.msg)
									_this.prepend(el)
									el.show('slow')
									$("html, body").scrollTop(0);
								} else {
									alert_toast("An error occured", 'error');
								}
								end_loader()
							}
						})
					}
				} else if (pmode == "cash") {
					// if (cash < net_payable_amount) {
					var _this = $(this)
					$('.err-msg').remove();
					start_loader();
					data = JSON.stringify({
						"id": trans_id,
						"agent_name": agent_name,
						"firstname": firstname,
						"middlename": middlename,
						"lastname": lastname,
						"address": address,
						"care_of": care_of,
						"pin_no": pin_no,
						"village": village,
						"post_office": post_office,
						"police_station": police_station,
						"sex": sex,
						"dob": dob,
						"contact": contact,
						"email": email,
						"states": states,
						"city": city,
						"district": district,
						"block": block,
						"aadhar_no": aadhar_no,
						"pan_no": pan_no,
						"payment_mode": pmode,
						"cash": cash
					})

					$.ajax({
						url: _base_url_ + "classes/Master.php?f=save_spare_parts_transaction",
						cache: false,
						contentType: false,
						processData: false,
						method: 'POST',
						contentType: 'application/json',
						data: JSON.stringify({
							"id": trans_id,
							"agent_name": agent_name,
							"firstname": firstname,
							"middlename": middlename,
							"lastname": lastname,
							"care_of": care_of,
							"pin_no": pin_no,
							"village": village,
							"post_office": post_office,
							"police_station": police_station,
							"address": address,
							"sex": sex,
							"dob": dob,
							"contact": contact,
							"email": email,
							"states": states,
							"city": city,
							"district": district,
							"block": block,
							"aadhar_no": aadhar_no,
							"pan_no": pan_no,
							"payment_mode": pmode,
							"cash": cash,
							"gst": gst
						}),
						error: err => {
							console.log(err)
							alert_toast("An error occuredssss", 'error');
							end_loader();
						},
						success: function(resp) {
							console.log(resp);
							retrun;
							resp = JSON.parse(resp)
							if (typeof resp == 'object' && resp.status == 'success') {
								location.replace('./?page=vehicles/view_transaction&id=' + resp.tid)
							} else if (resp.status == 'failed' && !!resp.msg) {
								var el = $('<div>')
								el.addClass("alert alert-danger err-msg").text(resp.msg)
								_this.prepend(el)
								el.show('slow')
								$("html, body").scrollTop(0);
							} else {
								alert_toast("An error occured", 'error');
							}
							end_loader()
						}
					})
					// } else {
					// 	alert_toast("Cash amount must be less than net amount", 'error');
					// }

				} else {
					$('.err-msg').remove();
					start_loader();
					data = JSON.stringify({
						"id": trans_id,
						"agent_name": agent_name,
						"firstname": firstname,
						"insurance_provider": insurance_provider,
						"address": address,
						"middlename": middlename,
						"lastname": lastname,
						"sex": sex,
						"dob": dob,
						"contact": contact,
						"email": email,
						"states": states,
						"city": city,
						"district": district,
						"block": block,
						"aadhar_no": aadhar_no,
						"pan_no": pan_no,
						"payment_mode": pmode,
						"card_no": card_no,
						"numberplate_amount": number_plate_am,
						"roadtax_amount": road_am,
						"insurance_amount": ins_am
					})

					$.ajax({
						url: _base_url_ + "classes/Master.php?f=save_spare_parts_transaction",
						cache: false,
						contentType: false,
						processData: false,
						method: 'POST',
						contentType: 'application/json',
						type: 'POST',
						data: JSON.stringify({
							"id": trans_id,
							"agent_name": agent_name,
							"firstname": firstname,
							"middlename": middlename,
							"lastname": lastname,
							"sex": sex,
							"dob": dob,
							"contact": contact,
							"email": email,
							"states": states,
							"city": city,
							"district": district,
							"block": block,
							"aadhar_no": aadhar_no,
							"pan_no": pan_no,
							"payment_mode": pmode,
							"card_no": card_no,
							"care_of": care_of,
							"pin_no": pin_no,
							"village": village,
							"post_office": post_office,
							"police_station": police_station
						}),
						error: err => {
							alert_toast("An error occured", 'error');
							end_loader();
						},
						success: function(resp) {
							console.log(resp);
							retrun;
							resp = JSON.parse(resp)
							if (typeof resp == 'object' && resp.status == 'success') {
								location.replace('./?page=vehicles/view_transaction&id=' + resp.tid)
							} else if (resp.status == 'failed' && !!resp.msg) {
								var el = $('<div>')
								el.addClass("alert alert-danger err-msg").text(resp.msg)
								_this.prepend(el)
								el.show('slow')
								$("html, body").scrollTop(0);
							} else {
								alert_toast("An error occured", 'error');
							}
							end_loader()
						}
					})
				}
			} else {
				alert_toast("Please choose any of payment method.", 'error');
			}

		})

	})
</script>