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
		<h3 class="card-title">ACCESSORIES & PARTS</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th class="text-center">PART NUMBER</th>
						<th class="text-center">PART NAME</th>
						<th class="text-center">Price</th>
						<th class="text-center">Stock</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * from `spare_parts` ");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center">
								<div style="line-height:1em">
									<div><b><?= $row['PART NUMBER'] ?></b></div>
								</div>
							</td>
							<td class="text-center">
								<div style="line-height:1em">
									<div><b><?= $row['PART NAME'] ?></b></div>
								</div>
							</td>
							<td class="text-center">
								<div style="line-height:1em">
									<div><?php
											echo $row['Sale Price'];
											?></b></div>
								</div>
							</td>
							<td class="text-center">
								<div style="line-height:1em">
									<div><?php
											echo $row['Stock'];
											?></b></div>
								</div>
							</td>
							<td align="center" class='text-center'>
								<a class="btn btn-flat btn-light bg-gradient-light btn-sm border sell_vehicle" href="./?page=spare_parts/sell_spare_parts&id=<?= $row['SR NO'] ?>"><i class="far fa-handshake"></i> Sell</a>
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
		$('.table').dataTable({
			// columnDefs: [{
			// 	orderable: false,
			// 	targets: [5]
			// }],
			// order: [0, 'asc']
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