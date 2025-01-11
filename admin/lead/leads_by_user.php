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

<!-- All lead section -->
<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">List of Leads</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" onclick="history.back();" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-arrow-left"></span> Back</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Lead Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $user_type = $_settings->userdata('type');
                    $specific_user_id = $_settings->userdata('id');

                    // Modify the query to count leads by user
                    if ($user_type == 1) {
                        $qry = $conn->query("
                            SELECT u.id, CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname) as username, COUNT(l.LeadID) as lead_count
                            FROM users u
                            LEFT JOIN leads l ON u.id = l.user_name
                            GROUP BY u.id
                            ORDER BY lead_count DESC
                        ");
                    } else {
                        $qry = $conn->query("
                            SELECT u.id, CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname) as username, COUNT(l.LeadID) as lead_count
                            FROM users u
                            LEFT JOIN leads l ON u.id = l.user_name
                            WHERE u.id = $specific_user_id
                            GROUP BY u.id
                            ORDER BY lead_count DESC
                        ");
                    }

                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class=""><?= $row['username'] ?></td>
                            <td class="text-center"><?= $row['lead_count'] ?></td>
                            <td align="center">
                                <div class="btn-group">
                                    <a href="./?page=lead/view_leads_by_user&user_id=<?php echo $row['id']; ?>" class="btn btn-flat btn-sm btn-primary"><span class="fa fa-eye"></span> View</a>
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