<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // bike details
    function toggleBikeDetails() {
        var bookingType = document.getElementById('bookingTypeInput').value;
        var bikeDetailsGroup = document.getElementById('bikeDetailsGroup');
        if (bookingType === 'EXCHANGE') {
            bikeDetailsGroup.style.display = 'block';
        } else {
            bikeDetailsGroup.style.display = 'none';
        }
    }
    // booking modal
    function openBookingModal(leadId, leadName, contactNumber, bikeOfInterest, contactInfo) {
        $('#leadIdInputBooking').val(leadId);
        $('#nameInput').val(leadName);
        $('#contactNumber').val(contactNumber);
        $('#schemeInputBooking').val(bikeOfInterest);
        $('#bookingModal').modal('show');
    }
    // booking save
    function saveBooking() {
        var formData = new FormData(document.getElementById('bookingForm'));
        var estimateDeliveryDate = document.getElementById('estimateDeliveryDateInput').value;

        // Check if Estimate Delivery Date is empty
        if (!estimateDeliveryDate) {
            alert('Please select an Estimate Delivery Date.');
            return; // Prevent form submission
        }

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_booking",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var resp = JSON.parse(response);
                if (resp.status === 'success') {
                    alert(resp.msg);
                    $('#bookingModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error saving booking: ' + resp.err);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while saving the booking.');
            }
        });
    }

    // delete
    $(document).ready(function() {
        // Click event for delete buttons
        $('.delete_data').click(function() {
            const dataId = $(this).attr('data-id');
            _conf("Are you sure to delete this lead permanently?", "delete_lead", [dataId]);
        });
    });
    // delete a lead
    function delete_lead(id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_lead",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",

            error: function(err) {
                console.log(err);
                alert_toast("An error occurred while deleting the lead.", 'error');
                end_loader();
            },
            success: function(resp) {
                end_loader();
                if (resp && resp.status === 'success') {
                    alert_toast("Lead deleted successfully.", 'success');
                    location.reload();
                } else {
                    console.log(resp);
                    alert_toast("Failed to delete the lead.", 'error');
                }
            }
        });
    }
    // all click events
    $(document).ready(function() {
        $('#create_new').click(function() {
            uni_modal('<i class="far fa-plus-square"></i> Add Lead Details', 'lead/manage_leads.php', 'modal-lg');
        });
        $('.view_lead').click(function() {
            uni_modal('<i class="fa fa-th-list"></i> Lead Details', 'lead/view_lead.php?id=' + $(this).attr('data-id'), 'modal-lg');
        });
        $('.edit_lead').click(function() {
            uni_modal('<i class="fa fa-edit"></i> Update Lead Details', 'lead/manage_leads.php?id=' + $(this).attr('data-id'), 'modal-lg');
        });

        $('#lead_status').change(function() {
            toggleNextFollowupDate();
        });

        $('#nextFollowupForm').submit(function(e) {
            e.preventDefault();
            saveNextFollowup();
        });

        $('#list').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [4]
            }],
            order: [0, 'asc']
        });

    });



    // Function to open the assignLeadModal
    function openAssignLeadModal(leadId) {
        // Set the LeadID input field value in the modal
        $('#assignLeadID').val(leadId);

        // Show the modal
        $('#assignLeadModal').modal('show');
    }

    // next follow up
    function openNextFollowupModal(leadId) {
        $('#leadIdInput').val(leadId);
        $('#nextFollowupModal').modal('show');
    }

    // toggle next follow
    function toggleNextFollowupDate() {
        var status = $('#lead_status').val();
        var nextFollowupDateGroup = $('#nextFollowupDateGroup');

        if (status === "FOLLOWUP") {
            nextFollowupDateGroup.show();
        } else {
            nextFollowupDateGroup.hide();
        }
    }

    // next follow up
    function saveNextFollowup() {
        var leadId = $('#leadIdInput').val();
        var remarks = $('#remarksInput').val();
        var nextFollowupDate = $('#nextFollowupDateInput').val();
        var status = $('#lead_status').val();
        var scheme = $('#schemeInput').val();

        if (status == '') {
            alert('Lead stage is required.');
            return;
        }

        // Check if remarks and status are filled
        if (!remarks) {
            alert('Remarks is required.');
            return;
        }

        // If status is 'FOLLOWUP', check if nextFollowupDate is filled
        if (status === 'FOLLOWUP' && !nextFollowupDate) {
            alert('Next Follow-up Date is required.');
            return;
        }

        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_next_followup",
            method: 'POST',
            data: {
                leadId: leadId,
                remarks: remarks,
                nextFollowupDate: nextFollowupDate,
                status: status,
                scheme: scheme
            },
            success: function(response) {
                console.log(response); // Log the response to the console

                // Assuming the response is a JSON string, parse it
                var parsedResponse;
                try {
                    parsedResponse = JSON.parse(response);
                } catch (e) {
                    alert('Error parsing server response.');
                    return;
                }

                if (parsedResponse.status === 'success') {
                    alert('Stage saved successfully');
                    $('#nextFollowupModal').modal('hide');
                    // Refresh the page after saving
                    location.reload();
                } else {
                    alert('Error saving next follow-up.');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred.');
            }
        });
    }

    // Function to assign lead
    function assignLead() {
        // Get the selected user ID from the select element
        var userId = $('#assignee').val();

        // Get the lead ID from the hidden input field
        var leadId = $('#assignLeadID').val();
        // Make AJAX call to update the leads table
        // Make AJAX call to update the leads table
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=assign_lead",
            type: "POST",
            data: {
                leadId: leadId,
                userId: userId
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    alert(responseData.msg);
                    location.href();
                } else {
                    alert(responseData.err);
                }
            },
            error: function(xhr, status, error) {
                alert("Error assigning lead: " + error);
            }
        });


    }
</script>