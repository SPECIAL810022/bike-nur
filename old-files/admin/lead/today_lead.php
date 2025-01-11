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
            background-color: green;
        }

        25% {
            background-color: white;
        }

        50% {
            background-color: green;
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
</style>

<!-- modal section -->
<?php include('followup_modal.php'); ?>

<!-- List of today leads section -->
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
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Bike Inserest</th>
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
                    $user_type = $_settings->userdata('type');
                    if ($user_type == 1) {
                        $qry = $conn->query("SELECT l.*, f.`FollowUpID`, f.`FollowUpDate`, f.`FollowUpType`, f.`FollowUpStatus`, f.`Notes`
                    FROM `leads` l
                    LEFT JOIN (
                        SELECT `LeadID`, MAX(`FollowUpID`) AS max_followup_id
                        FROM `followups`
                        GROUP BY `LeadID`
                    ) latest_followup ON l.`LeadID` = latest_followup.`LeadID`
                    LEFT JOIN `followups` f ON latest_followup.`max_followup_id` = f.`FollowUpID`
                    WHERE l.`user_name` = $specific_user_id AND l.NextFollowUpDate = CURRENT_DATE
                    ORDER BY f.`FollowUpID` DESC;
                    ");
                    } else {
                        $qry = $conn->query("SELECT l.*, f.`FollowUpID`, f.`FollowUpDate`, f.`FollowUpType`, f.`FollowUpStatus`, f.`Notes`
                        FROM `leads` l
                        LEFT JOIN (
                            SELECT `LeadID`, MAX(`FollowUpID`) AS max_followup_id
                            FROM `followups`
                            GROUP BY `LeadID`
                        ) latest_followup ON l.`LeadID` = latest_followup.`LeadID`
                        LEFT JOIN `followups` f ON latest_followup.`max_followup_id` = f.`FollowUpID`
                        WHERE DATE(l.NextFollowUpDate) = CURRENT_DATE
                        ORDER BY f.`FollowUpID` DESC;
                    ");
                    }

                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                            <td class=""><?= $row['LeadName'] ?></td>
                            <td class=""><?= $row['ContactInformation'] ?></td>
                            <td class=""><?= $row['BikeOfInterest'] ?></td>
                            <td class=""><?= $row['LeadSource'] ?></td>
                            <?php
                            $leadStatus = $row['LeadStatus'];
                            $class = '';
                            switch ($leadStatus) {
                                case 'DEALFINAL':
                                    $class = 'deal-final';
                                    break;
                                case 'DEALCANCELLED':
                                    $class = 'deal-closed';
                                    break;
                                case 'NEXTFOLLOWUP':
                                    $class = 'next-followup';
                                    break;
                                default:
                                    $class = '';
                                    break;
                            }
                            ?>
                            <td class="lead-status <?= $class ?>"><?= htmlspecialchars($leadStatus) ?></td>
                            <td class="next-followup-cell"><?= $row['NextFollowUpDate'] ?></td>
                            <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_lead" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <a class="dropdown-item edit_lead" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['LeadID'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                        <?php if ($row['LeadStatus'] !== 'DEAL FINAL') : ?>
                                            <a class="dropdown-item next_followup" href="javascript:void(0)" onclick="openNextFollowupModal('<?php echo $row['LeadID'] ?>')">
                                                <span class="fa fa-calendar-check text-success"></span> Follow-up
                                            </a>
                                        <?php endif; ?>

                                        <!-- <?php if ($row['LeadStatus'] == 'DEAL FINAL') : ?>
                                            <a class="dropdown-item booking" href="javascript:void(0)" onclick="openBookingModal('<?php echo $row['LeadID'] ?>')">
                                                <span class="fa fa-book text-info"></span> Booking
                                            </a>
                                        <?php endif; ?> -->
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