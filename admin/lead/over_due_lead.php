<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        showAlert("<?php echo $_settings->flashdata('success') ?>", 'success');
    </script>
<?php endif; ?>


<style>
    .brand-img {
        width: 3em;
        height: 3em;
        object-fit: cover;
        object-position: center center;
    }

    @keyframes highlight {
        0% {
            background-color: red;
        }

        25% {
            background-color: white;
        }

        50% {
            background-color: red;
        }

        100% {
            background-color: white;
        }
    }

    .next-followup-cell.highlight {
        animation: highlight 2s infinite;
    }

    /* In your CSS file or <style> block */
    .lead-status {
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    .lead-status.deal-final {
        background-color: green;
        color: #FFF;
    }

    .lead-status.deal-closed {
        background-color: red;
        color: #000;
    }

    .lead-status.next-followup {
        background-color: yellow;
        color: #000;
    }

    .lead-status.new-lead {
        background-color: #b5f2fd;
        color: #000;
    }
</style>

<?php include('followup_modal.php'); ?>

<!-- over due section -->
<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">List of Leads</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span> Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <?php
                        $user_type = $_settings->userdata('type');
                        if ($user_type == 1) { ?>

                            <th>User Name</th>
                        <?php   }
                        ?>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Bike Interest</th>
                        <th>Lead Source</th>
                        <th>Follow Up Status</th>
                        <th>Next Followup Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $specific_user_id = $_settings->userdata('id');
                    // Query for admin (user_type == 1) to show all overdue leads excluding DEAL FINAL
                    if ($user_type == 1) {
                        $qry = $conn->query("SELECT l.*, f.`FollowUpID`, f.`FollowUpDate`, f.`FollowUpType`, f.`FollowUpStatus`, f.`Notes`,
                            DATEDIFF(CURRENT_DATE, l.NextFollowUpDate) AS DaysOverdue,
                            CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname) as username
                            FROM `leads` l
                            LEFT JOIN (
                                SELECT `LeadID`, MAX(`FollowUpID`) AS max_followup_id
                                FROM `followups`
                                GROUP BY `LeadID`
                            ) latest_followup ON l.`LeadID` = latest_followup.`LeadID`
                            LEFT JOIN `followups` f ON latest_followup.`max_followup_id` = f.`FollowUpID`
                            LEFT JOIN `users` u ON l.`user_name` = u.`id`
                            WHERE l.NextFollowUpDate < CURRENT_DATE AND l.LeadStatus != 'DEAL FINAL'
                            ORDER BY f.`FollowUpID` DESC;
                     ");
                    } else {
                        // Query for other users to show their specific overdue leads excluding DEAL FINAL
                        $qry = $conn->query("SELECT l.*, f.`FollowUpID`, f.`FollowUpDate`, f.`FollowUpType`, f.`FollowUpStatus`, f.`Notes`,
                            DATEDIFF(CURRENT_DATE, l.NextFollowUpDate) AS DaysOverdue
                            FROM `leads` l
                            LEFT JOIN (
                                SELECT `LeadID`, MAX(`FollowUpID`) AS max_followup_id
                                FROM `followups`
                                GROUP BY `LeadID`
                            ) latest_followup ON l.`LeadID` = latest_followup.`LeadID`
                            LEFT JOIN `followups` f ON latest_followup.`max_followup_id` = f.`FollowUpID`
                            WHERE l.`user_name` = $specific_user_id AND l.NextFollowUpDate < CURRENT_DATE AND l.LeadStatus != 'DEAL FINAL'
                            ORDER BY f.`FollowUpID` DESC;
                         ");
                    }
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                            <?php if ($user_type == 1) { ?>
                                <td class=""><?= $row['username'] ?></td>
                            <?php   }
                            ?>
                            <td class=""><?= $row['LeadName'] ?></td>
                            <td class=""><?= $row['ContactInformation'] ?></td>
                            <td class=""><?= $row['BikeOfInterest'] ?></td>
                            <td class=""><?= $row['LeadSource'] ?></td>
                            <?php
                            $leadStatus = $row['LeadStatus'];
                            $class = '';
                            switch ($leadStatus) {
                                case 'DEAL FINAL':
                                    $class = 'deal-final';
                                    break;
                                case 'DEAL CANCELLED ':
                                    $class = 'deal-closed';
                                    break;
                                case 'FOLLOWUP':
                                    $class = 'next-followup';
                                    break;
                                case 'NEW LEAD':
                                    $class = 'new-lead';
                                    break;
                                default:
                                    $class = '';
                                    break;
                            }
                            ?>
                            <td class="lead-status <?= $class ?>"><?= htmlspecialchars($leadStatus) ?></td>
                            <td class="next-followup-cell highlight"><?= $row['NextFollowUpDate'] ?> (<?= $row['DaysOverdue'] ?> days overdue)</td>
                            <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_lead" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <?php if ($user_type !== 2) : ?>
                                            <a class="dropdown-item edit_lead" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                        <?php endif; ?>
                                        <?php if ($row['LeadStatus'] !== 'DEAL FINAL') : ?>
                                            <a class="dropdown-item next_followup" href="javascript:void(0)" onclick="openNextFollowupModal('<?php echo $row['LeadID'] ?>')">
                                                <span class="fa fa-calendar-check text-success"></span> Follow-up
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($user_type !== 2) : ?>
                                            <?php if ($row['LeadStatus'] == 'DEALFINAL') : ?>
                                                <a class="dropdown-item booking" href="javascript:void(0)" onclick="openBookingModal('<?php echo $row['LeadID'] ?>')">
                                                    <span class="fa fa-book text-info"></span> Booking
                                                </a>
                                            <?php endif; ?>
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

<?php include('lead_js.php'); ?>