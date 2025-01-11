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
        <h3 class="card-title">List of Transactions</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Boker Name</th>
                        <th>Customer Name</th>
                        <th>Father's Name</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->prepare("SELECT t.*, customers.*, t.id, brokers.*
                    FROM transaction_list t
                    LEFT JOIN customers ON customers.id = t.customer_id
                    LEFT JOIN brokers ON brokers.broker_id = t.broker_id
                    WHERE t.broker_id = ?
                    ORDER BY ABS(UNIX_TIMESTAMP(t.date_created)) ASC");

                    // Assuming $_GET['broker_id'] and $_GET['id'] are set
                    $qry->bind_param("i", $_GET['broker_id']);
                    $qry->execute();
                    $result = $qry->get_result();

                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center"><?php echo $row['broker_name'] ?></td>
                            <td class="text-center"><?php echo $row['name'] ?></td>
                            <td class="text-center"><?php echo $row['father_name'] ?></td>
                            <td class="text-center"><?php echo $row['contact_number'] ?></td>
                            <td align="center" class='text-center'>
                                <div class="dropdown">
                                    <button class="btn btn-flat btn-light bg-gradient-light btn-sm border dropdown-toggle" type="button" id="dropdownMenuButton<?= $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $row['id'] ?>">
                                        <a class="dropdown-item" href="./?page=vehicles/view_transaction&id=<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#payCommissionModal<?= $row['id'] ?>">
                                            <i class="fas fa-money-bill"></i> Pay Commission
                                        </button>
                                    </div>
                                </div>
                            </td>


                        </tr>
                    <?php
                    endwhile;
                    ?>

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