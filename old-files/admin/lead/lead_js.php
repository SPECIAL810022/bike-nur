<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleBikeDetails() {
        var bookingType = document.getElementById('bookingTypeInput').value;
        var bikeDetailsGroup = document.getElementById('bikeDetailsGroup');
        if (bookingType === 'EXCHANGE') {
            bikeDetailsGroup.style.display = 'block';
        } else {
            bikeDetailsGroup.style.display = 'none';
        }
    }


    function openBookingModal(leadId) {
        $('#leadIdInputBooking').val(leadId);
        $('#bookingModal').modal('show');
    }

    function saveBooking() {
        var formData = new FormData(document.getElementById('bookingForm'));

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

        $('.delete_data').click(function() {
            _conf("Are you sure to delete this lead permanently?", "delete_lead", [$(this).attr('data-id')]);
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

    function openNextFollowupModal(leadId) {
        $('#leadIdInput').val(leadId);
        $('#nextFollowupModal').modal('show');
    }

    function toggleNextFollowupDate() {
        var status = $('#lead_status').val();
        var nextFollowupDateGroup = $('#nextFollowupDateGroup');

        if (status === "FOLLOWUP") {
            nextFollowupDateGroup.show();
        } else {
            nextFollowupDateGroup.hide();
        }
    }

    function saveNextFollowup() {
        var leadId = $('#leadIdInput').val();
        var remarks = $('#remarksInput').val();
        var nextFollowupDate = $('#nextFollowupDateInput').val();
        var status = $('#lead_status').val();
        var scheme = $('#schemeInput').val();

        if (status === 'next_follow_up' && !nextFollowupDate) {
            showAlert('Next Follow-up Date is required.', 'error');
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
                if (response.status === 'success') {
                    alert('Next follow-up saved successfully');
                    $('#nextFollowupModal').modal('hide');
                    // Refresh the page after saving
                    location.reload();
                } else {
                    showAlert('Error saving next follow-up.', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                showAlert('An error occurred.', 'error');
            }
        });
    }

    function showAlert(message, type) {
        if (type === 'success') {
            alert('Lead Stage Added Successfully');
            location.reload();
        } else {
            alert('Lead Stage Added Successfully');
            location.reload();
        }
    }
</script>