<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">List of Bookings</h3>

    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booking Date</th>
                        <th>Scheme</th>
                        <th>Amount</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Bike Interest</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT bookings.BookingID, bookings.LeadID, bookings.BookingDate, bookings.Scheme, bookings.Amount,leads.BrokerName, leads.LeadName, leads.ContactInformation, leads.BikeOfInterest, bookings.Notes 
                            FROM `bookings` 
                            LEFT JOIN `leads` ON leads.LeadID = bookings.LeadID 
                            ORDER BY BookingID DESC");

                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['BookingDate'])) ?></td>
                            <td class=""><?= $row['Scheme'] ?></td>
                            <td class=""><?= $row['Amount'] ?></td>
                            <td class=""><?= $row['LeadName'] ?></td>
                            <td class=""><?= $row['ContactInformation'] ?></td>
                            <td class=""><?= $row['BikeOfInterest'] ?></td>
                            <td class=""><?= $row['Notes'] ?></td>
                            <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item download_receipt" href="./pdfdowload/booking_receipt.php?transaction_id=<?php echo $row['BookingID'] ?>" target="_blank">
                                            <span class="fa fa-download text-primary"></span> Download Receipt
                                        </a>
                                        <a class="dropdown-item create_customer" href="javascript:void(0)">
                                            <span class="fa fa-user-plus text-primary"></span> Create Customer
                                        </a>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {
            _conf("Are you sure to delete this lead permanently?", "delete_lead", [$(this).attr('data-id')]);
        });
        // Add new functionality for creating a customer
        $('.create_customer').click(function() {
            uni_modal('<i class="far fa-plus-square"></i> Add Customer Details', 'customer/manage_customers.php', 'modal-lg');
        });

        $('#list').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [4]
            }],
            order: [0, 'asc']
        });
    });
</script>