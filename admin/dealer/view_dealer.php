<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * FROM `dealers` WHERE DealerID = '{$_GET['id']}'");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
		echo '<script>alert("Dealer ID is not valid."); location.replace("./?page=dealers")</script>';
	}
} else {
	echo '<script>alert("Dealer ID is Required."); location.replace("./?page=dealers")</script>';
}
?>
<style>
	#uni_modal .modal-footer {
		display: none !important;
	}
</style>
<div class="container-fluid">
	<dl>
		<dt class="text-muted">Name</dt>
		<dd class="pl-4"><?= isset($DealerName) ? $DealerName : "" ?></dd>
		<dt class="text-muted">Contact Person</dt>
		<dd class="pl-4"><?= isset($contact_person) ? $contact_person : "" ?></dd>
		<dt class="text-muted">Phone</dt>
		<dd class="pl-4"><?= isset($phone) ? $phone : "" ?></dd>
		<dt class="text-muted">Email</dt>
		<dd class="pl-4"><?= isset($Email) ? $Email : "" ?></dd>
		<dt class="text-muted">Location</dt>
		<dd class="pl-4"><?= isset($Location) ? $Location : "" ?></dd>
	</dl>
</div>
<hr class="mx-n3">
<div class="py-1 text-right">
	<button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>