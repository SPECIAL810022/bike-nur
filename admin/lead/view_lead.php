<?php
require_once('./../../config.php');

// Check if lead ID is set and valid
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $lead_id = $_GET['id'];

    // Fetch lead details
    $qry = $conn->query("SELECT * FROM `leads` WHERE LeadID = '{$lead_id}'");
    if ($qry->num_rows > 0) {
        $lead = $qry->fetch_assoc();

        // Fetch follow-ups for the lead
        $followup_qry = $conn->query("SELECT `FollowUpID`, `FollowUpDate`, `FollowUpType`, `FollowUpStatus`, `Notes` FROM `followups` WHERE `LeadID` = '{$lead_id}'");
        $followups = [];
        if ($followup_qry->num_rows > 0) {
            while ($row = $followup_qry->fetch_assoc()) {
                $followups[] = $row;
            }
        }
    } else {
        echo '<script>alert("Lead ID is not valid."); location.replace("./?page=leads")</script>';
    }
} else {
    echo '<script>alert("Lead ID is Required."); location.replace("./?page=leads")</script>';
}
?>
<style>
    #uni_modal .modal-footer {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <div style="height: 400px; overflow-y: auto;">
        <table class="table table-bordered table-striped">
            <tbody>
                <!-- Lead details -->
                <tr>
                    <th class="">Name</th>
                    <th class="">Number</th>
                    <th class="">Source</th>
                    <th class="">Interest</th>
                    <th class="">CreationDate</th>
                    <th class="">Broker Name</th>
                    <th class="">Brokerage Amount</th>
                    <th class="">Lead Status</th>
                    <th class="">Follow-up Date</th>
                    <th class="">Type</th>
                    <?php if ($lead['LeadType'] == 'CASH') : ?>
                        <th class="">Cash Amount</th>
                    <?php endif; ?>
                    <?php if ($lead['LeadType'] == 'EMI') : ?>
                        <th class="">Provider</th>
                        <th class="">ORP Price</th>
                        <th class="">MR</th>
                        <th class="">Scheme</th>
                        <th class="">Down Payment</th>
                    <?php endif; ?>
                    <?php if (!empty($lead['Exchange'])) : ?>
                        <th class="">Exchange</th>
                        <th class="">Bike Name</th>
                        <th class="">Bike Value</th>
                        <th class="">Cash Paid</th>
                    <?php endif; ?>
                    <th class="">Notes</th>
                </tr>
                <tr>
                    <td><?= isset($lead['LeadName']) ? $lead['LeadName'] : "" ?></td>
                    <td><?= isset($lead['ContactInformation']) ? $lead['ContactInformation'] : "" ?></td>
                    <td><?= isset($lead['BikeOfInterest']) ? $lead['BikeOfInterest'] : "" ?></td>
                    <td><?= isset($lead['LeadSource']) ? $lead['LeadSource'] : "" ?></td>
                    <td><?= isset($lead['CreationDate']) ? $lead['CreationDate'] : "" ?></td>
                    <td><?= isset($lead['BrokerName']) ? $lead['BrokerName'] : "" ?></td>
                    <td><?= isset($lead['BrokerBrokerageAmount']) ? $lead['BrokerBrokerageAmount'] : "" ?></td>
                    <td><?= isset($lead['LeadStatus']) ? $lead['LeadStatus'] : "" ?></td>
                    <td><?= isset($lead['NextFollowUpDate']) ? $lead['NextFollowUpDate'] : "" ?></td>
                    <td><?= isset($lead['LeadType']) ? $lead['LeadType'] : "" ?></td>
                    <?php if ($lead['LeadType'] == 'CASH') : ?>
                        <td><?= isset($lead['CashAmount']) ? $lead['CashAmount'] : "" ?></td>
                    <?php endif; ?>
                    <?php if ($lead['LeadType'] == 'EMI') : ?>
                        <td><?= isset($lead['InsuranceProvider']) ? $lead['InsuranceProvider'] : "" ?></td>
                        <td><?= isset($lead['ORPPrice']) ? $lead['ORPPrice'] : "" ?></td>
                        <td><?= isset($lead['MR']) ? $lead['MR'] : "" ?></td>
                        <td><?= isset($lead['Scheme']) ? $lead['Scheme'] : "" ?></td>
                        <td><?= isset($lead['DownPayment']) ? $lead['DownPayment'] : "" ?></td>
                    <?php endif; ?>
                    <?php if (!empty($lead['Exchange'])) : ?>
                        <td><?= isset($lead['Exchange']) ? $lead['Exchange'] : "" ?></td>
                        <td><?= isset($lead['BikeName']) ? $lead['BikeName'] : "" ?></td>
                        <td><?= isset($lead['BikeValue']) ? $lead['BikeValue'] : "" ?></td>
                        <td><?= isset($lead['CashPaid']) ? $lead['CashPaid'] : "" ?></td>
                    <?php endif; ?>
                    <td><?= isset($lead['Notes']) ? $lead['Notes'] : "" ?></td>
                </tr>
                <tr>
                    <th colspan="<?= (($lead['LeadType'] != 'CASH' && $lead['LeadType'] != 'EMI') || empty($lead['Exchange'])) ? '14' : '17' ?>">Followup Details</th>
                </tr>
                <?php if (!empty($followups)) :
                    $a = 1;
                ?>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Notes</th>
                    </tr>
                    <?php foreach ($followups as $followup) : ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $followup['FollowUpDate'] ?></td>
                            <td><?= $followup['FollowUpType'] ?></td>
                            <td><?= $followup['FollowUpStatus'] ?></td>
                            <td><?= $followup['Notes'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No follow-ups found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<hr class="mx-n3">
<div class="py-1 text-right">
    <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>