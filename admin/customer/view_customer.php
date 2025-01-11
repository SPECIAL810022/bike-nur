<?php
require_once('./../../config.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM `customers` WHERE id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $customer = $qry->fetch_assoc();
    } else {
        echo '<script>alert("Customer ID is not valid."); location.replace("./?page=customers")</script>';
    }
} else {
    echo '<script>alert("Customer ID is Required."); location.replace("./?page=customers")</script>';
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
                <th class="text-muted">Name</th>
                <td><?= isset($customer['name']) ? $customer['name'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Father's Name</th>
                <td><?= isset($customer['father_name']) ? $customer['father_name'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Address</th>
                <td><?= isset($customer['address']) ? $customer['address'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Post Office</th>
                <td><?= isset($customer['post_office']) ? $customer['post_office'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Police Station</th>
                <td><?= isset($customer['police_station']) ? $customer['police_station'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">District</th>
                <td><?= isset($customer['district']) ? $customer['district'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Pin</th>
                <td><?= isset($customer['pin']) ? $customer['pin'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Contact Number</th>
                <td><?= isset($customer['contact_number']) ? $customer['contact_number'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Age</th>
                <td><?= isset($customer['age']) ? $customer['age'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Nominee Name</th>
                <td><?= isset($customer['NomineeName']) ? $customer['NomineeName'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Relationship</th>
                <td><?= isset($customer['Relationship']) ? $customer['Relationship'] : "" ?></td>
            </tr>
            <tr>
                <th class="text-muted">Documents</th>
                <td>
                    <div class="d-flex flex-wrap">
                        <?php if (!empty($customer['aadhaar_card'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['aadhaar_card'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['aadhaar_card'] ?>" alt="Aadhaar Card" width="100px" height="100px" class="rounded" title="Aadhaar Card">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($customer['pan_card'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['pan_card'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['pan_card'] ?>" alt="PAN Card" width="100px" height="100px" class="rounded" title="PAN Card">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($customer['dl_or_ll'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['dl_or_ll'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['dl_or_ll'] ?>" alt="DL/LL" width="100px" height="100px" class="rounded" title="DL/LL">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($customer['voter_file'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['voter_file'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['voter_file'] ?>" alt="Voter Card" width="100px" height="100px" class="rounded" title="Voter File">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($customer['bank_passbook'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['bank_passbook'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['bank_passbook'] ?>" alt="Bank Passbook" width="100px" height="100px" class="rounded" title="Bank Passbook">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($customer['other_document'])) : ?>
                            <div class="image-container mx-1">
                                <a href="customer/docs/<?php echo $customer['other_document'] ?>" download>
                                    <img src="customer/docs/<?php echo $customer['other_document'] ?>" alt="Bank Passbook" width="100px" height="100px" class="rounded" title="Other Document">
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>
<hr class="mx-n3">
<div class="py-1 text-right">
    <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>