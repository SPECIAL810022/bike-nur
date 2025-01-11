<?php
require_once('./../../config.php');

// Fetch lead data if ID is provided
$lead_data = [];
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM `leads` WHERE LeadID = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $lead_data = $qry->fetch_assoc();
    }
}

// Prepare form data
$LeadID = $lead_data['LeadID'] ?? '';
$LeadName = $lead_data['LeadName'] ?? '';
$ContactInformation = $lead_data['ContactInformation'] ?? '';
$BikeOfInterest = $lead_data['BikeOfInterest'] ?? '';
$BrokerName = $lead_data['BrokerName'] ?? '';
$BrokerBrokerageAmount = $lead_data['BrokerBrokerageAmount'] ?? '';
$LeadSource = $lead_data['LeadSource'] ?? '';
$LeadType = $lead_data['LeadType'] ?? '';
$CashAmount = $lead_data['CashAmount'] ?? '';
$ORPPrice = $lead_data['ORPPrice'] ?? '';
$MR = $lead_data['MR'] ?? '';
$InsuranceProvider = $lead_data['InsuranceProvider'] ?? '';
$Scheme = $lead_data['Scheme'] ?? '';
$DownPayment = $lead_data['DownPayment'] ?? '';
$Exchange = $lead_data['Exchange'] ?? '';
$BikeName = $lead_data['BikeName'] ?? '';
$BikeValue = $lead_data['BikeValue'] ?? '';
$CashPaid = $lead_data['CashPaid'] ?? '';
$LeadStatus = $lead_data['LeadStatus'] ?? '';
$CreationDate = $lead_data['CreationDate'] ?? date('Y-m-d');
$NextFollowUpDate = $lead_data['NextFollowUpDate'] ?? '';
$Notes = $lead_data['Notes'] ?? '';
?>
<div class="container-fluid">
    <form action="" id="lead-form">
        <input type="hidden" name="LeadID" value="<?php echo isset($LeadID) ? $LeadID : '' ?>">

        <div class="form-group">
            <label for="name" class="control-label">Name<sup style="color:red;">*</sup></label>
            <input type="text" name="LeadName" id="LeadName" class="form-control form-control-sm rounded-0" value="<?php echo isset($LeadName) ? $LeadName : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="contact_info" class="control-label">Contact Number <sup style="color:red;">*</sup></label>
            <input type="number" name="ContactInformation" id="contact_info" class="form-control form-control-sm rounded-0" value="<?php echo isset($ContactInformation) ? $ContactInformation : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="bike_of_interest" class="control-label">Bike of Interest</label>
            <input type="text" name="BikeOfInterest" id="bike_of_interest" class="form-control form-control-sm rounded-0" value="<?php echo isset($BikeOfInterest) ? $BikeOfInterest : ''; ?>" required />
        </div>
        <!-- BOKRER -->
        <div class="form-group">
            <label for="broker_name" class="control-label">Select Broker</label>
            <select name="BrokerName" id="broker_name" class="form-control form-control-sm rounded-0" required>
                <?php
                $query = "SELECT * FROM brokers";
                $result = $conn->query($query);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = (isset($BrokerName) && $BrokerName == $row['broker_name']) ? 'selected' : '';
                        echo '<option value="' . $row['broker_name'] . '" ' . $selected . '>' . $row['broker_name'] . '</option>';
                    }
                    // Free result set
                    $result->free_result();
                }
                ?>
                <option value="NA">NA</option>
            </select>
        </div>
        <div class="form-group" id="broker_brokerage_amt_container" style="display: none;">
            <label for="broker_brokerage_amt" class="control-label">Broker Brokerage Amount</label>
            <input type="number" name="BrokerBrokerageAmount" id="broker_brokerage_amt" class="form-control form-control-sm rounded-0" value="<?php echo isset($BrokerBrokerageAmount) ? $BrokerBrokerageAmount : ''; ?>" />
        </div>

        <div class="form-group">
            <label for="lead_source" class="control-label">Lead Source</label>
            <input type="text" name="LeadSource" id="lead_source" class="form-control form-control-sm rounded-0" value="<?php echo isset($LeadSource) ? $LeadSource : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="lead_type" class="control-label">Lead Type</label>
            <select name="LeadType" id="lead_type" class="form-control form-control-sm rounded-0" required>
                <option value="">SELECT TYPE</option>
                <option value="CASH" <?php echo (isset($LeadType) && $LeadType == 'CASH') ? 'selected' : ''; ?>>CASH</option>
                <option value="EMI" <?php echo (isset($LeadType) && $LeadType == 'EMI') ? 'selected' : ''; ?>>EMI</option>
            </select>
        </div>
        <!-- EXTRA FIELD -->
        <div class="form-group" id="cash_amount_field" style="display: none;">
            <label for="cash_amount" class="control-label">Cash Amount</label>
            <input type="number" name="CashAmount" id="cash_amount" class="form-control form-control-sm rounded-0" />
        </div>
        <!-- FOR EMI -->
        <div class="form-group additional-field" id="orp_price" style="display: none;">
            <label for="orp_price" class="control-label">ORP Price</label>
            <input type="number" name="ORPPrice" id="orp_price" class="form-control form-control-sm rounded-0" />
        </div>

        <div class="form-group additional-field" id="mr" style="display: none;">
            <label for="mr" class="control-label">MR</label>
            <input type="number" name="MR" id="mr" class="form-control form-control-sm rounded-0" />
        </div>
        <div class="form-group additional-field" id="insurance_provider" style="display: none;">
            <label for="insurance_provider" class="control-label">Insurance Provider</label>
            <input type="text" name="InsuranceProvider" id="insurance_provider" class="form-control form-control-sm rounded-0" />
        </div>


        <div class="form-group additional-field" id="scheme" style="display: none;">
            <label for="scheme" class="control-label">Scheme</label>
            <input type="text" name="Scheme" id="scheme" class="form-control form-control-sm rounded-0" />
        </div>

        <div class="form-group additional-field" id="dp" style="display: none;">
            <label for="dp" class="control-label">Down Payment</label>
            <input type="number" name="DownPayment" id="dp" class="form-control form-control-sm rounded-0" />
        </div>


        <!-- FOR EXCHANGE -->
        <!-- exchnage check box -->
        <div class="form-group">
            <input type="checkbox" id="exchange_checkbox" name="Exchange" onchange="toggleExchangeFields(this.checked)">
            <label for="exchange_checkbox">Exchange</label>
        </div>
        <div id="exchange_fields" style="display: none;">
            <div class="form-group additional-field" id="bike_name">
                <label for="bike_name" class="control-label">Bike Name</label>
                <input type="text" name="BikeName" id="bike_name" class="form-control form-control-sm rounded-0" />
            </div>

            <div class="form-group additional-field" id="bike_value">
                <label for="bike_value" class="control-label">Bike Value</label>
                <input type="number" name="BikeValue" id="bike_value" class="form-control form-control-sm rounded-0" />
            </div>

            <div class="form-group additional-field" id="cash_paid">
                <label for="cash_paid" class="control-label">Cash Paid</label>
                <input type="number" name="CashPaid" id="cash_paid" class="form-control form-control-sm rounded-0" />
            </div>
        </div>

        <!-- ALL FIELDS -->
        <div class="form-group">
            <label for="lead_status" class="control-label">Lead Status</label>
            <select name="LeadStatus" id="lead_status" class="form-control form-control-sm rounded-0" required>
                <option value="NEW LEAD" <?php echo (isset($LeadStatus) && $LeadStatus == 'NEW LEAD') ? 'selected' : ''; ?>>NEW LEAD</option>
                <option value="DEAL FINAL" <?php echo (isset($LeadStatus) && $LeadStatus == 'DEAL FINAL') ? 'selected' : ''; ?>>DEAL FINAL</option>
                <option value="DEAL CANCELLED" <?php echo (isset($LeadStatus) && $LeadStatus == 'DEAL CANCELLED') ? 'selected' : ''; ?>>DEAL CLOSED</option>
                <option value="FOLLOWUP" <?php echo (isset($LeadStatus) && $LeadStatus == 'FOLLOWUP') ? 'selected' : ''; ?>>DEAL NEXT FOLLOWUP</option>
            </select>
        </div>



        <div class="form-group">
            <label for="creation_date" class="control-label">Creation Date</label>
            <input type="date" name="CreationDate" id="creation_date" class="form-control form-control-sm rounded-0" value="<?php echo isset($CreationDate) ? $CreationDate : date('Y-m-d'); ?>" required />
        </div>

        <div class="form-group">
            <label for="next_follow_up_date" class="control-label">Next Follow-up Date</label>
            <input type="date" name="NextFollowUpDate" id="next_follow_up_date" class="form-control form-control-sm rounded-0" value="<?php echo isset($NextFollowUpDate) ? $NextFollowUpDate : ''; ?>" required />
        </div>
        <div class="form-group">
            <label for="notes" class="control-label">Notes</label>
            <textarea name="Notes" id="Notes" class="form-control form-control-sm rounded-0" required><?php echo isset($Notes) ? $Notes : ''; ?></textarea>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // LEAD FORM SUBMIT

        $('#lead-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();

            // Validation for LeadName and contact_info
            var leadName = $('#LeadName').val().trim();
            var contactInfo = $('#contact_info').val().trim();

            if (leadName === '' || contactInfo === '') {
                var el = $('<div>');
                el.addClass("alert alert-danger err-msg").text('Lead Name and Contact Information are required.');
                _this.prepend(el);
                el.show('slow');
                $("html, body").scrollTop(0);
                return false;
            }

            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_lead",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast(resp.msg, 'success');
                        location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>');
                        el.addClass("alert alert-danger err-msg").text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        $("html, body").scrollTop(0);
                    } else {
                        alert_toast("An error occurred", 'error');
                    }
                    end_loader();
                }
            });
        });

        // Add event listener to Lead Type select
        $('#lead_type').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'CASH') {
                $('#cash_amount_field').show();
                $('#orp_price').hide();
                $('#mr').hide();
                $('#scheme').hide();
                $('#dp').hide();
            } else if (selectedValue == 'EMI') {
                showAdditionalFields(['orp_price', 'mr', 'scheme', 'dp', 'insurance_provider']);
                $('#cash_amount_field').hide();
            } else if (selectedValue == 'EXCHANGE') {
                showAdditionalFields(['bike_name', 'bike_value', 'cash_paid']);
                $('#cash_amount_field').hide();
                $('#orp_price').hide();
                $('#mr').hide();
                $('#scheme').hide();
                $('#dp').hide();
            } else {
                hideAdditionalFields();
                $('#cash_amount_field').hide();
            }
        });

        $('#exchange_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('#exchange_fields').show();
            } else {
                $('#exchange_fields').hide();
            }
        });

        $('#broker_name').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue !== 'NA') {
                $('#broker_brokerage_amt_container').show();
            } else {
                $('#broker_brokerage_amt_container').hide();
            }
        });

        // Function to show additional fields
        function showAdditionalFields(fields) {
            fields.forEach(function(fieldId) {
                $('#' + fieldId).closest('.form-group').show();
            });
        }

        // Function to hide additional fields
        function hideAdditionalFields() {
            $('.additional-field').hide();
        }

        // Ensure the correct initial state on page load
        var brokerInitialValue = $('#broker_name').val();
        if (brokerInitialValue !== 'NA') {
            $('#broker_brokerage_amt_container').show();
        } else {
            $('#broker_brokerage_amt_container').hide();
        }
    });
</script>