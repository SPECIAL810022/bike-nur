<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `vehicle_list` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}

$query = "SELECT * FROM dealers";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <form action="" id="vehicle-form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="model_id" value="<?php echo isset($model_id) ? $model_id : (isset($_GET['model_id']) ? $_GET['model_id'] : '') ?>">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dealers" class="control-label">All Dealers</label>
                    <select name="dealers" id="dealers" class="form-control form-control-sm rounded-0" required>
                        <option value="">Select Dealer</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = (isset($dealers) && $dealers == $row['DealerID']) ? 'selected' : '';
                                echo "<option value='{$row['DealerID']}' {$selected}>{$row['DealerName']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bike_chalan" class="control-label">Bike Chalan</label>
                    <input type="file" name="bike_chalan" id="bike_chalan" class="form-control-file rounded-0" accept=".jpg, .jpeg, .png, .pdf" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bike_name" class="control-label">Bike Name</label>
                    <input type="text" name="bike_name" id="bike_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($bike_name) ? $bike_name : ''; ?>" required />
                </div>
            </div>
           
            <div class="col-md-6">
                <div class="form-group">
                    <label for="color" class="control-label">Bike Color</label>
                    <input type="text" name="colour" id="colour" class="form-control form-control-sm rounded-0" value="<?php echo isset($colour) ? $colour : ''; ?>" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="engine_number" class="control-label">Engine Number</label>
                    <input type="text" name="engine_number" id="engine_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($engine_number) ? $engine_number : ''; ?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="chassis_number" class="control-label">Chassis Number</label>
                    <input type="text" name="chassis_number" id="chassis_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($chassis_number) ? $chassis_number : ''; ?>" required />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="battery_maker" class="control-label">Battery Maker</label>
                    <input type="text" name="battery_maker" id="battery_maker" class="form-control form-control-sm rounded-0" value="<?php echo isset($battery_maker) ? $battery_maker : ''; ?>" required />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="battery_number" class="control-label">Battery Number</label>
                    <input type="text" name="battery_number" id="battery_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($battery_number) ? $battery_number : ''; ?>" required />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ex_showroom_price" class="control-label">Ex-showroom Price</label>
                    <input type="number" step="any" name="ex_showroom_price" id="ex_showroom_price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($ex_showroom_price) ? $ex_showroom_price : 0; ?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="on_road_price" class="control-label">On-road Price</label>
                    <input type="number" step="any" name="on_road_price" id="on_road_price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($on_road_price) ? $on_road_price : 0; ?>" required />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mileage" class="control-label">Mileage</label>
                    <input type="text" name="mileage" id="mileage" class="form-control form-control-sm rounded-0" value="<?php echo isset($mileage) ? $mileage : ''; ?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="engine_details" class="control-label">Engine Details</label>
                    <input type="text" name="engine_details" id="engine_details" class="form-control form-control-sm rounded-0" value="<?php echo isset($engine_details) ? $engine_details : ''; ?>" required />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="brakes" class="control-label">Brakes</label>
                    <input type="text" name="brakes" id="brakes" class="form-control form-control-sm rounded-0" value="<?php echo isset($brakes) ? $brakes : ''; ?>" required />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="hsn_code" class="control-label">HSN Code</label>
                    <input type="text" name="hsn_code" id="hsn_code" class="form-control form-control-sm rounded-0" value="<?php echo isset($hsn_code) ? $hsn_code : ''; ?>" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="key_number" class="control-label">Key Number</label>
                    <input type="text" name="key_number" id="key_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($key_number) ? $key_number : ''; ?>" required />
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    $(document).ready(function() {
        $('#vehicle-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_vehicle",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast(resp.msg, 'success')
                        uni_modal('<i class="fa fa-th-list"></i> Vehicle Details', 'models/view_vehicle.php?id=' + resp.vid)
                        $('#uni_modal').on('hide.bs.modal', function() {
                            location.reload()
                        })
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
        })

    })
</script>