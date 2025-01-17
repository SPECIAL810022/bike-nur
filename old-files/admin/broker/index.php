<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<style>
    .brand-img {
        width: 3em;
        height: 3em;
        object-fit: cover;
        object-position: center center;
    }
</style>
<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">List of Brokers</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span> Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="broker_list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="35%">
                    <col width="25%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $specific_user_id = $_settings->userdata('id');
                    $user_type = $_settings->userdata('type');
                    $qry = $conn->query("SELECT * FROM `brokers` ORDER BY `created_at` DESC");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                            <td class=""><?= $row['broker_name'] ?></td>
                            <td class=""><?= $row['broker_phone'] ?></td>
                            <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_broker" href="javascript:void(0)" data-id="<?php echo $row['broker_id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <?php if ($user_type !== 2) : ?>
                                            <a class="dropdown-item edit_broker" href="javascript:void(0)" data-id="<?php echo $row['broker_id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                            <a class="dropdown-item delete_broker" href="javascript:void(0)" data-id="<?php echo $row['broker_id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
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
        $('#create_new').click(function() {
            uni_modal('<i class="far fa-plus-square"></i> Add Broker Details', 'broker/manage_borker.php', 'modal-small');
        })

        $('.view_broker').click(function() {
            uni_modal('<i class="fa fa-th-list"></i> Broker Details', 'broker/view_broker.php?id=' + $(this).attr('data-id'), 'modal-small');
        })

        $('.edit_broker').click(function() {
            uni_modal('<i class="fa fa-edit"></i> Update Broker Details', 'broker/manage_borker.php?id=' + $(this).attr('data-id'), 'modal-small');
        })

        $('.delete_broker').click(function() {
            _conf("Are you sure to delete this broker permanently?", "delete_broker", [$(this).attr('data-id')])
        })
        $('#broker_list').dataTable({
            columnDefs: [{
                orderable: false,
                targets: [4]
            }],
            order: [0, 'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
    })

    function delete_broker($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_broker",
            method: "POST",
            data: {
                id: $id
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>