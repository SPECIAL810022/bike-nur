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
        <h3 class="card-title">List of Insurances</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span> Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="50%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Insurance Provider</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * from `insurance` where delete_flag = 0 order by `provider` asc ");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td class=""><?= $row['provider'] ?></td>
                            <td class=""><?= $row['email'] ?></td>
                            <td class=""><?= $row['phone'] ?></td>
                            <td class="text-center">
                                <?php if ($row['status'] == 1) : ?>
                                    <span class="badge badge-success px-3 rounded-pill">Active</span>
                                <?php else : ?>
                                    <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item view_insurance" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item edit_insurance" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
            uni_modal('<i class="far fa-plus-square"></i> Add Insurance Details', 'insurance/manage_insurance.php')
        })
        $('.view_insurance').click(function() {
            uni_modal('<i class="fa fa-th-list"></i> Insurance Details', 'insurance/view_insurance.php?id=' + $(this).attr('data-id'))
        })
        $('.edit_insurance').click(function() {
            uni_modal('<i class="fa fa-edit"></i> Update Insurance Details', 'insurance/manage_insurance.php?id=' + $(this).attr('data-id'))
        })
        $('.delete_data').click(function() {
            _conf("Are you sure to delete this insurance permanently?", "delete_insurance", [$(this).attr('data-id')])
        })
        $('.table').dataTable({
            columnDefs: [{
                orderable: false,
                targets: [4]
            }],
            order: [0, 'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
    })

    function delete_insurance($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_insurance",
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