<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `brokers` where broker_id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="broker-form">
        <input type="hidden" name="broker_id" value="<?php echo isset($broker_id) ? $broker_id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="broker_name" id="broker_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($broker_name) ? $broker_name : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="phone" class="control-label">Phone</label>
            <input type="text" name="broker_phone" id="broker_phone" class="form-control form-control-sm rounded-0" value="<?php echo isset($broker_phone) ? $broker_phone : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="gram_panchayat" class="control-label">Gram Panchayat</label>
            <select name="gram_panchayat" id="gram_panchayat" class="form-control form-control-sm rounded-0" required>
                <option value="">Select Gram Panchayat</option>
                <?php
                $query = "SELECT * FROM gram_panchayat";
                $result = $conn->query($query);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = (isset($gram_panchayat) && $gram_panchayat == $row['id']) ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['gram_panchayat_name'] . '</option>';
                    }
                    // Free result set
                    $result->free_result();
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="additional_address" class="control-label">Additional Address</label>
            <textarea name="additional_address" id="additional_address" class="form-control form-control-sm rounded-0" required><?php echo isset($additional_address) ? $additional_address : ''; ?></textarea>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#broker-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_broker",
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
                        // uni_modal('<i class="fa fa-th-list"></i> Broker Details', 'brokers/view_broker.php?id=' + resp.id)
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