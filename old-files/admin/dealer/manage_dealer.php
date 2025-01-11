<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `dealers` where DealerID = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="dealer-form">
		<input type="hidden" name="DealerID" value="<?php echo isset($DealerID) ? $DealerID : '' ?>">
		<div class="form-group">
			<label for="DealerName" class="control-label">Dealer Name</label>
			<input type="text" name="DealerName" id="DealerName" class="form-control form-control-sm rounded-0" value="<?php echo isset($DealerName) ? $DealerName : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="ContactPerson" class="control-label">Other Contact</label>
			<input type="text" name="ContactPerson" id="ContactPerson" class="form-control form-control-sm rounded-0" value="<?php echo isset($ContactPerson) ? $ContactPerson : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="ContactPersonMobile" class="control-label">Other Contact Mobile</label>
			<input type="text" name="contact_perosn_mobile" id="contact_perosn_mobile" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact_perosn_mobile) ? $contact_perosn_mobile : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="Phone" class="control-label">Dealer Phone</label>
			<input type="text" name="Phone" id="phone" class="form-control form-control-sm rounded-0" value="<?php echo isset($Phone) ? $Phone : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<input type="text" name="Email" id="Email" class="form-control form-control-sm rounded-0" value="<?php echo isset($Email) ? $Email : ''; ?>" required />
		</div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('#dealer-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_dealer",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err)
					alert_toast("An error occurred", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						alert_toast(resp.msg, 'success')
						// uni_modal('<i class="fa fa-th-list"></i> Dealer Details', 'dealers/view_dealer.php?id=' + resp.cid)
						// $('#uni_modal').on('hide.bs.modal', function() {
							location.reload()
						// })
					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						$("html, body").scrollTop(0);
					} else {
						alert_toast("An error occurred", 'error');
					}
					end_loader()
				}
			})
		})

	})
</script>