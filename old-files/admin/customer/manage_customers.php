<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `customers` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">

    <form action="" id="customer-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="father_name" class="control-label">Father's Name</label>
            <input type="text" name="father_name" id="father_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($father_name) ? $father_name : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address</label>
            <textarea name="address" id="address" class="form-control form-control-sm rounded-0" required><?php echo isset($address) ? $address : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="post_office" class="control-label">Post Office</label>
            <input type="text" name="post_office" id="post_office" class="form-control form-control-sm rounded-0" value="<?php echo isset($post_office) ? $post_office : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="police_station" class="control-label">Police Station</label>
            <input type="text" name="police_station" id="police_station" class="form-control form-control-sm rounded-0" value="<?php echo isset($police_station) ? $police_station : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="district" class="control-label">District</label>
            <input type="text" name="district" id="district" class="form-control form-control-sm rounded-0" value="<?php echo isset($district) ? $district : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="pin" class="control-label">Pincode</label>
            <input type="text" name="pin" id="pin" class="form-control form-control-sm rounded-0" value="<?php echo isset($pin) ? $pin : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="contact_number" class="control-label">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact_number) ? $contact_number : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="age" class="control-label">Age</label>
            <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" value="<?php echo isset($age) ? $age : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="NomineeName" class="control-label">Nominee Name</label>
            <input type="text" name="NomineeName" id="NomineeName" class="form-control form-control-sm rounded-0" value="<?php echo isset($NomineeName) ? $NomineeName : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="relationship" class="control-label">Relationship</label>
            <input type="text" name="Relationship" id="Relationship" class="form-control form-control-sm rounded-0" value="<?php echo isset($Relationship) ? $Relationship : ''; ?>" required />
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#customer-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_customer",
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
                        // uni_modal('<i class="fa fa-th-list"></i> Customer Details', 'customers/view_customer.php?id=' + resp.id)
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