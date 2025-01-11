<!-- FOLLOW UP MODAL BOX -->
<div class="modal fade" id="nextFollowupModal" tabindex="-1" aria-labelledby="nextFollowupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nextFollowupModalLabel">Set Next Follow-up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nextFollowupForm">
                    <input type="hidden" id="leadIdInput">

                    <div class="form-group">
                        <label for="lead_status">Status</label>
                        <select name="LeadStatus" id="lead_status" class="form-control form-control-sm rounded-0" required>
                            <option value="NEW LEAD" <?php echo (isset($LeadStatus) && $LeadStatus == 'NEW LEAD') ? 'selected' : ''; ?>>NEW LEAD</option>
                            <option value="DEAL FINAL" <?php echo (isset($LeadStatus) && $LeadStatus == 'DEAL FINAL') ? 'selected' : ''; ?>>DEAL FINAL</option>
                            <option value="DEAL CLOSED" <?php echo (isset($LeadStatus) && $LeadStatus == 'DEAL CLOSED') ? 'selected' : ''; ?>>DEAL CLOSED</option>
                            <option value="FOLLOWUP" <?php echo (isset($LeadStatus) && $LeadStatus == 'FOLLOWUP') ? 'selected' : ''; ?>>DEAL NEXT FOLLOWUP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarksInput">Remarks</label>
                        <textarea class="form-control" id="remarksInput" rows="3"></textarea>
                    </div>
                    <div class="form-group" id="nextFollowupDateGroup" style="display: none;">
                        <label for="nextFollowupDateInput">Next Follow-up Date</label>
                        <input type="date" class="form-control" id="nextFollowupDateInput">
                    </div>
                    <div class="form-group">
                        <label for="schemeInput">NEW OFFER </label>
                        <input type="text" class="form-control" id="schemeInput">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveNextFollowup()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">New Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" enctype="multipart/form-data">
                    <input type="hidden" id="leadIdInputBooking" name="LeadID">
                    <div class="form-group">
                        <label for="bookingDateInput">Booking Date</label>
                        <input type="date" class="form-control" id="bookingDateInput" name="BookingDate" required>
                    </div>
                    <div class="form-group">
                        <label for="schemeInputBooking">Scheme</label>
                        <input type="text" class="form-control" id="schemeInputBooking" name="Scheme" required>
                    </div>
                    <div class="form-group">
                        <label for="amountInput">Amount</label>
                        <input type="number" class="form-control" id="amountInput" name="Amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethodInput">Payment Method</label>
                        <select class="form-control" id="paymentMethodInput" name="PaymentMethod" required>
                            <option value="CASH">CASH</option>
                            <option value="UPI">UPI</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="CARD">CARD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bookingTypeInput">Booking Type</label>
                        <select class="form-control" id="bookingTypeInput" name="BookingType" required onchange="toggleBikeDetails()">
                            <option value="NEW">NEW</option>
                            <option value="EXCHANGE">EXCHANGE</option>
                            <option value="EMI">EMI</option>
                        </select>
                    </div>
                    <div class="form-group" id="bikeDetailsGroup" style="display: none;">
                        <label for="bikeDetailsInput">Bike Details</label>
                        <input type="text" class="form-control" id="bikeDetailsInput" name="BikeDetails">
                    </div>
                    <div class="form-group">
                        <label for="refNumberInput">Reference Number</label>
                        <input type="text" class="form-control" id="refNumberInput" name="refNumberInput">
                    </div>
                    <div class="form-group">
                        <label for="giftItemsInput">Gift Items</label>
                        <input type="text" class="form-control" id="giftItemsInput" name="GiftItemsInput">
                    </div>
                    <div class="form-group">
                        <label for="documentUploadInput">Upload Document</label>
                        <input type="file" class="form-control" id="documentUploadInput" name="DocumentUpload">
                    </div>
                    <div class="form-group">
                        <label for="notesInputBooking">Notes</label>
                        <textarea class="form-control" id="notesInputBooking" name="Notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveBooking()">Save Booking</button>
            </div>
        </div>
    </div>
</div>