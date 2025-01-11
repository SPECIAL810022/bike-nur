<?php
require_once('./../../config.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM `brokers` LEFT JOIN gram_panchayat g ON brokers.gram_panchayat = g.id WHERE broker_id = '{$_GET['id']}'");

    if ($qry->num_rows > 0) {
        $broker = $qry->fetch_assoc();
    } else {
        echo '<script>alert("Broker ID is not valid."); location.replace("./?page=brokers")</script>';
    }
} else {
    echo '<script>alert("Broker ID is Required."); location.replace("./?page=brokers")</script>';
}
?>
<style>
    #uni_modal .modal-footer {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <table class="table">
        <tbody>
            <tr>
                <th class="text-muted">Broker Name</th>
                <td><?= isset($broker['broker_name']) ? htmlspecialchars($broker['broker_name']) : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Broker Phone</th>
                <td><?= isset($broker['broker_phone']) ? htmlspecialchars($broker['broker_phone']) : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Gram Panchayat</th>
                <td><?= isset($broker['gram_panchayat_name']) ? htmlspecialchars($broker['gram_panchayat_name']) : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Additional Address</th>
                <td><?= isset($broker['additional_address']) ? htmlspecialchars($broker['additional_address']) : "" ?></td>
            </tr>
        </tbody>
    </table>
</div>

<hr class="mx-n3">
<div class="py-1 text-right">
    <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>