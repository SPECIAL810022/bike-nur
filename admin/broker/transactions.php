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
        <h3 class="card-title">List of Transactions By Broker</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Borker Name</th>
                        <th>Phone Number</th>
                        <th>Total Customer</th>
                        <th>Total Sales</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT
                                            t.broker_id,
                                            t.id as transaction_id,
                                            COUNT(t.id) AS num_sales,
                                            brokers.*,
                                            COUNT(DISTINCT t.customer_id) AS num_customers
                                        FROM
                                            transaction_list t
                                        LEFT JOIN
                                            vehicle_list v ON t.vehicle_id = v.id
                                        LEFT JOIN
                                            model_list m ON v.model_id = m.id
                                        LEFT JOIN
                                            brand_list b ON m.brand_id = b.id
                                        LEFT JOIN
                                            brokers ON brokers.broker_id = t.broker_id
                                        LEFT JOIN
                                            customers ON customers.id = t.customer_id
                                        WHERE
                                            v.status = 1
                                        AND
                                            v.delete_flag = 0
                                        AND
                                            t.broker_id <> 0 
                                        GROUP BY
                                            t.broker_id
                                        ORDER BY
                                            ABS(UNIX_TIMESTAMP(v.date_created)) ASC");

                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center"><?php echo $row['broker_name'] ?></td>
                            <td class="text-center"><?php echo $row['broker_phone'] ?></td>
                            <td class="text-center"><?php echo $row['num_customers'] ?></td>
                            <td class="text-center"><?php echo $row['num_sales'] ?></td>
                            <td align="center" class='text-center'>
                                <a class="btn btn-flat btn-light bg-gradient-light btn-sm border" href="./?page=broker/view_transaction&broker_id=<?= $row['broker_id'] ?>&id=<?= $row['transaction_id'] ?>"><i class="fa fa-eye"></i> View</a>
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