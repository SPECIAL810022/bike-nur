<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$transaction_qry = $conn->query("SELECT *,
       CONCAT(firstname, ' ', COALESCE(CONCAT(middlename, ' '), ''), lastname) AS customer,
       CONCAT(address, ' ', COALESCE(CONCAT(city, ', '), ''),
              COALESCE(CONCAT(block, ' '), ''),
              COALESCE(CONCAT(district, ', '), ''),
              COALESCE(states, '')) AS address
FROM `transaction_list`
WHERE id = '{$_GET['id']}';
");
	if ($transaction_qry->num_rows > 0) {
		foreach ($transaction_qry->fetch_assoc() as $k => $v) {
			$transaction[$k] = $v;
		}
	}
	if (isset($transaction['vehicle_id'])) {
		$qry = $conn->query("SELECT * from `vehicle_list` where id = '{$transaction['vehicle_id']}' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_assoc() as $k => $v) {
				$$k = $v;
			}
		}
		if (isset($model_id)) {
			$model_qry = $conn->query("SELECT m.*, b.name as `brand`, ct.capacity as `car_type` from `model_list` m inner join brand_list b on m.brand_id = b.id inner join engine_capacity ct on m.engine_capacity_id = ct.id where m.id = '{$model_id}'");
			if ($model_qry->num_rows > 0) {
				foreach ($model_qry->fetch_assoc() as $k => $v) {
					$model[$k] = $v;
				}
			}
		}
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
	<h4 class="font-wight-bolder">Transaction Details</h4>
</div>
<div class="row mt-n4 align-items-center justify-content-center flex-column">
	<div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-footer py-1 text-center">
				<button class="btn btn-flat btn-sm btn-success bg-gradient-success" id="print_chalan"><i class="fa fa-print"></i> Print Chalan</button>
				<button class="btn btn-flat btn-sm btn-success bg-gradient-success" id="print"><i class="fa fa-print"></i> Print Invoice</button>
				<a class="btn btn-flat btn-sm btn-navy bg-gradient-navy border" href="./?page=vehicles/sell_vehicle&transaction_id=<?= isset($transaction['id']) ? $transaction['id'] : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<button class="btn btn-flat btn-sm btn-danger bg-gradient-danger" id="delete-transaction"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="./?page=vehicles/transactions"><i class="fa fa-angle-left"></i> Cancel</a>
			</div>
		</div>
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<h4 class="h4">Invoice</h4>
				<div class="container-fluid" id="printout">
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Brand:</div>
						<div class="col-9 mb-0 border"><?= isset($model['brand']) ? $model['brand'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Bikes Engine:</div>
						<div class="col-9 mb-0 border"><?= isset($model['car_type']) ? $model['car_type'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Model:</div>
						<div class="col-9 mb-0 border"><?= isset($model['model']) ? $model['model'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Engine Type:</div>
						<div class="col-9 mb-0 border"><?= isset($model['engine_type']) ? $model['engine_type'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Transmission Type:</div>
						<div class="col-9 mb-0 border"><?= isset($model['transmission_type']) ? $model['transmission_type'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Technology:</div>
						<div class="col-9 mb-0 border"><?= isset($model['technology']) ? htmlspecialchars_decode($model['technology']) : '' ?></div>
					</div>
					<div class="clear-fix my-1"></div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">M.V. File No.</div>
						<div class="col-9 mb-0 border"><?= isset($mv_number) ? $mv_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Plate Number</div>
						<div class="col-9 mb-0 border"><?= isset($plate_number) ? $plate_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Variant</div>
						<div class="col-9 mb-0 border"><?= isset($variant) ? $variant : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Mileage</div>
						<div class="col-9 mb-0 border"><?= isset($mileage) ? ($mileage > 0 ? format_num($mileage) : $mileage) : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Engine Number</div>
						<div class="col-9 mb-0 border"><?= isset($engine_number) ? $engine_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Chasis Number</div>
						<div class="col-9 mb-0 border"><?= isset($chasis_number) ? $chasis_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Price</div>
						<div class="col-9 mb-0 border"><?= isset($price) ? format_num($price, 2) : '' ?></div>
					</div>
					<div class="clear-fix my-1"></div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Transaction Date & Time</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['date_created']) ? date("M d, Y h:i A", strtotime($transaction['date_created'])) : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Agent Name</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['agent_name']) ? $transaction['agent_name'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Customer</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['customer']) ? $transaction['customer'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Sex</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['sex']) ? $transaction['sex'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Birthday</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['dob']) ? date("F d, Y", strtotime($transaction['dob'])) : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Contact #</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['contact']) ? $transaction['contact'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Email</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['email']) ? $transaction['email'] : 'N/A' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Address</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['address']) ? $transaction['address'] : 'N/A' ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<h4 class="h4">Chalan</h4>
				<div class="container-fluid" id="printoutchalan">
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Customer</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['customer']) ? $transaction['customer'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">C/O</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['care_of']) ? $transaction['care_of'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Village</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['village']) ? $transaction['village'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Pin</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['pin_no']) ? $transaction['pin_no'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Post Office</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['post_office']) ? $transaction['post_office'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Police Station</div>
						<div class="col-9 mb-0 border"><?= isset($transaction['police_station']) ? $transaction['police_station'] : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">M.V. File No.</div>
						<div class="col-9 mb-0 border"><?= isset($mv_number) ? $mv_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Variant</div>
						<div class="col-9 mb-0 border"><?= isset($variant) ? $variant : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Mileage</div>
						<div class="col-9 mb-0 border"><?= isset($mileage) ? ($mileage > 0 ? format_num($mileage) : $mileage) : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Engine Number</div>
						<div class="col-9 mb-0 border"><?= isset($engine_number) ? $engine_number : '' ?></div>
					</div>
					<div class="d-flex w-100">
						<div class="col-3 mb-0 border bg-gradient-secondary">Chasis Number</div>
						<div class="col-9 mb-0 border"><?= isset($chasis_number) ? $chasis_number : '' ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<noscript id="print-header">
	<div>
		<div class="d-flex w-100 align-items-center">
			<div class="col-2 text-center">
				<img src="<?= validate_image($_settings->info('logo')) ?>" style="width:4em !important;height:4em !important;object-fit:cover;object-position:center center" class="img-thumbnail p-0 border border-dark rounded-circle" alt="">
			</div>
			<div class="col-8 text-center" style="line-height:1em">
				<h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
				<h4 class="text-center mb-0">Transaction Details</h4>
			</div>
		</div>
		<hr>
	</div>
</noscript>
<script>
	$(document).ready(function() {
		$('#print').click(function() {
			var url = "pdfdowload/generate_pdf.php";
			url += "?vehicle_id=" + encodeURIComponent("<?= $transaction['vehicle_id'] ?>");
			url += "&transaction_id=" + encodeURIComponent("<?= $_GET['id'] ?>");
			window.location.href = url
		})
		$('#print_chalan').click(function() {
			var url = "pdfdowload/generate_challan.php";
			url += "?vehicle_id=" + encodeURIComponent("<?= $transaction['vehicle_id'] ?>");
			url += "&transaction_id=" + encodeURIComponent("<?= $_GET['id'] ?>");
			window.location.href = url
		})
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
</script>