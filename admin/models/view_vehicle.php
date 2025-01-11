<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `vehicle_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
        echo '<script>alert("vehicle ID is not valid."); location.replace("./?page=vehicles")</script>';
    }
} else {
    echo '<script>alert("vehicle ID is Required."); location.replace("./?page=vehicles")</script>';
}
?>
<style>
    #uni_modal .modal-footer {
        display: none !important;
    }

    #uni_modal .modal-body {
        padding-bottom: 0px !important;
    }
</style>
<div class="container-fluid">
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Bike Name</div>
        <div class="col-9 mb-0 border"><?= isset($bike_name) ? $bike_name : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Colour</div>
        <div class="col-9 mb-0 border"><?= isset($colour) ? $colour : '' ?></div>
    </div>

    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Engine Number</div>
        <div class="col-9 mb-0 border"><?= isset($engine_number) ? $engine_number : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Chassis Number</div>
        <div class="col-9 mb-0 border"><?= isset($chassis_number) ? $chassis_number : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Key Number</div>
        <div class="col-9 mb-0 border"><?= isset($key_number) ? $key_number : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Battery Maker</div>
        <div class="col-9 mb-0 border"><?= isset($battery_maker) ? $battery_maker : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Battery Number</div>
        <div class="col-9 mb-0 border"><?= isset($battery_number) ? $battery_number : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Ex-showroom Price</div>
        <div class="col-9 mb-0 border"><?= isset($ex_showroom_price) ? format_num($ex_showroom_price, 2) : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">On-road Price</div>
        <div class="col-9 mb-0 border"><?= isset($on_road_price) ? format_num($on_road_price, 2) : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Mileage</div>
        <div class="col-9 mb-0 border"><?= isset($mileage) ? $mileage : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Engine Details</div>
        <div class="col-9 mb-0 border"><?= isset($engine_details) ? $engine_details : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-3 mb-0 border bg-gradient-secondary">Brakes</div>
        <div class="col-9 mb-0 border"><?= isset($brakes) ? $brakes : '' ?></div>
    </div>
    <div class="d-flex w-100 mb-3">
        <div class="col-3 mb-0 border bg-gradient-secondary">Status</div>
        <div class="col-9 mb-0 border">
            <td class="text-center">
                <?php if (isset($status)) : ?>
                    <?php if ($status == 0) : ?>
                        <span class="badge badge-success px-3 rounded-pill">Available</span>
                    <?php else : ?>
                        <span class="badge badge-danger px-3 rounded-pill">Sold</span>
                    <?php endif; ?>
                <?php else : ?>
                    <span class="badge badge-light border px-3 rounded-pill">N/A</span>
                <?php endif; ?>
            </td>
        </div>
    </div>
</div>


<hr class="mx-n4">
<div class="py-3 text-right">
    <button class="btn btn-sm btn-flat btn-navy bg-gradient-navy" id="edit-vehicle" type="button"><i class="fa fa-edit"></i> Edit</button>
    <button class="btn btn-sm btn-flat btn-danger bg-gradient-danger" id="delete-vehicle" type="button"><i class="fa fa-trash"></i> Delete</button>
    <button class="btn btn-sm btn-flat btn-light bg-gradient-light border" data-dismiss="modal" type="button"><i class="fa fa-close"></i> Close</button>
</div>
<script>
    $(function() {
        $('#delete-vehicle').click(function() {
            _conf("Are you sure to delete this vehicle permanently?", "delete_vehicle", ['<?= isset($id) ? $id : '' ?>'])
        })
        $('#edit-vehicle').click(function() {
            uni_modal('<i class="fa fa-edit"></i> Add Vehicle Entry', 'models/manage_vehicle.php?id=<?= isset($id) ? $id : '' ?>', 'modal-lg')
        })

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