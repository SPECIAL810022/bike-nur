<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<style>
	.vehicle-thumbnail {
		width: 3em;
		height: 3em;
		object-fit: cover;
		object-position: center center;
	}
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Vehicles</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Brand</th>
						<th>Model</th>
						<th>Vehicle</th>
						<th>ON Road</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT v.*, m.model, b.name AS `brand`
					FROM `vehicle_list` v 
					INNER JOIN `model_list` m ON v.model_id = m.id 
					INNER JOIN `brand_list` b ON m.brand_id = b.id
					WHERE v.`status` = 0 AND v.`delete_flag` = 0 
					ORDER BY ABS(UNIX_TIMESTAMP(v.`date_created`)) ASC;
					");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="">
								<div style="line-height:1em">
									<div><b><?= $row['brand'] ?></b></div>
								</div>
							</td>
							<td class="">
								<div style="line-height:1em">
									<div><b><?= $row['bike_name'] ?></b></div>
								</div>
							</td>
							<td class="">
								<div style="line-height:1em">
									<div><b>Chassis Number.: <?= $row['chassis_number'] ?></b></div>
									<div><small class="text-muted">Engine Number: <?= $row['engine_number'] ?></small></div>
								</div>
							</td>
							<td class="text-right"><?= number_format($row['on_road_price'], 2) ?></td>
							<td align="center" class='text-center'>
								<a class="btn btn-flat btn-light bg-gradient-light btn-sm border sell_vehicle" href="./?page=vehicles/sell_vehicle&id=<?= $row['id'] ?>"><i class="far fa-handshake"></i> Sell</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
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
		$('.table').dataTable({
			columnDefs: [{
				orderable: false,
				targets: [5]
			}],
			order: [0, 'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})

	function delete_vehicle($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_vehicle",
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
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>