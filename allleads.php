<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>All Leads</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
        .table-responsive {
  margin-top: 1rem;
}
.status-final {
      background-color: #28a745;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
    }


.form-group label {
  margin-right: 5px;
}
.modal-title {
  font-weight: bold;
  color: #fff;
}

.modal-footer .btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.modal-footer .btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
}
.text_body{
  font-weight: 300;
  font-size: 15px;
}
     </style>
   </head>
<body>
<?php
include('../assets/componets/sidebar.php');
?>
  <section class="home-section">
  <?php
include('../assets/componets/header.php');
?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="container bg-body pt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4>List of Brokers</h4>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">+ Create New</button>
            </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="addBrokerModalLabel">Add Lead Details</h5>
          
        </div>
        <div class="modal-body">
            <form>
                <!-- Name -->
                <div class="form-group">
                  <label for="name">Name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name" required>
                </div>
          
                <!-- Contact Number -->
                <div class="form-group mt-3">
                  <label for="contactNumber">Contact Number<span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number" required>
                </div>
          
                <!-- Bike of Interest -->
                <div class="form-group mt-3">
                  <label for="bikeOfInterest">Bike of Interest</label>
                  <input type="text" class="form-control" id="bikeOfInterest" placeholder="Enter bike of interest">
                </div>
          
                <!-- Select Broker -->
                <div class="form-group mt-3">
                  <label for="broker">Select Broker</label>
                  <select class="form-control" id="broker">
                    <option>IMRANUL</option>
                    <option>Other Broker 1</option>
                    <option>Other Broker 2</option>
                  </select>
                </div>
          
                <!-- Broker Brokerage Amount -->
                <div class="form-group mt-3">
                  <label for="brokerageAmount">Broker Brokerage Amount</label>
                  <input type="number" class="form-control" id="brokerageAmount" placeholder="Enter brokerage amount">
                </div>
          
                <!-- Lead Source -->
                <div class="form-group mt-3">
                  <label for="leadSource">Lead Source</label>
                  <input type="text" class="form-control" id="leadSource" placeholder="Enter lead source">
                </div>
          
                <!-- Lead Type -->
                <div class="form-group mt-3">
                  <label for="leadType">Lead Type</label>
                  <select class="form-control" id="leadType">
                    <option>New</option>
                    <option>Returning</option>
                    <option>Referral</option>
                  </select>
                </div>
          
                <!-- Exchange Checkbox -->
                <div class="form-group form-check mt-3">
                  <input type="checkbox" class="form-check-input" id="exchange">
                  <label class="form-check-label" for="exchange">Exchange</label>
                </div>
          
                <!-- Bike Name -->
                <div class="form-group mt-3">
                  <label for="bikeName">Bike Name</label>
                  <input type="text" class="form-control" id="bikeName" placeholder="Enter bike name">
                </div>
          
                <!-- Bike Value -->
                <div class="form-group mt-3">
                  <label for="bikeValue">Bike Value</label>
                  <input type="number" class="form-control" id="bikeValue" placeholder="Enter bike value">
                </div>
          
                <!-- Cash Paid -->
                <div class="form-group mt-3">
                  <label for="cashPaid">Cash Paid</label>
                  <input type="number" class="form-control" id="cashPaid" placeholder="Enter cash paid">
                </div>
          
                <!-- Lead Status -->
                <div class="form-group mt-3">
                  <label for="leadStatus">Lead Status</label>
                  <select class="form-control" id="leadStatus">
                    <option>New Lead</option>
                    <option>Follow-up</option>
                    <option>Closed</option>
                    <option>Lost</option>
                  </select>
                </div>
          
                <!-- Creation Date -->
                <div class="form-group mt-3">
                  <label for="creationDate">Creation Date</label>
                  <input type="date" class="form-control" id="creationDate" value="2024-11-03">
                </div>
          
                <!-- Next Follow-up Date -->
                <div class="form-group mt-3">
                  <label for="followUpDate">Next Follow-up Date</label>
                  <input type="date" class="form-control" id="followUpDate">
                </div>
          
                <!-- Notes -->
                <div class="form-group mt-3">
                  <label for="notes">Notes</label>
                  <textarea class="form-control" id="notes" rows="3" placeholder="Enter any notes"></textarea>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning">Save</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
            <div class="row justify-content-between">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="entriesSelect">Show</label>
                  <select id="entriesSelect" class="form-control d-inline-block w-auto">
                    <option>10 <i class='bx bxs-chevron-down'></i></option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                  </select>
                  entries
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-right">
                  <label for="searchInput">Search:</label>
                  <input type="text" id="searchInput" class="form-control d-inline-block w-auto">
                </div>
              </div>
            </div>
            
            <div class="table-responsive ">
              <table class="table table-bordered table-hover">
                <thead class="thead-light ">
                  <tr >
                    <th class="bg-warning">#</th>
                    <th class="bg-warning">Date Created</th>
                    <th class="bg-warning">Name</th>
                    <th class="bg-warning">Contact Number</th>
                    <th class="bg-warning">Bike Interest</th>
                    <th class="bg-warning">Lead Source</th>
                    <th class="bg-warning">Current Status</th>
                    <th class="bg-warning">Next Follow-up Date</th>
                    <th class="bg-warning">Created By</th>
                    <th class="bg-warning">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
            <td>2024-07-16 08:23</td>
            <td>Somras</td>
            <td>9333209044</td>
            <td>Apache 4v</td>
            <td></td> <!-- Empty cell for Lead Source -->
            <td><span class="status-final">DEAL FINAL</span></td>
            <td>0000-00-00</td>
            <td>Suman Ghosh</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" href="#"><div><i class='bx bxs-user me-2' style="color: #FFDF00;"></i><span>Booking</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>2024-07-16 08:23</td>
            <td>Somras</td>
            <td>9333209044</td>
            <td>Apache 4v</td>
            <td></td> <!-- Empty cell for Lead Source -->
            <td><span class="status-final">DEAL FINAL</span></td>
            <td>0000-00-00</td>
            <td>Suman Ghosh</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" href="#"><div><i class='bx bxs-user me-2' style="color: #FFDF00;"></i><span>Booking</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>2024-07-16 08:23</td>
            <td>Somras</td>
            <td>9333209044</td>
            <td>Apache 4v</td>
            <td></td> <!-- Empty cell for Lead Source -->
            <td><span class="status-final">DEAL FINAL</span></td>
            <td>0000-00-00</td>
            <td>Suman Ghosh</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" href="#"><div><i class='bx bxs-user me-2' style="color: #FFDF00;"></i><span>Booking</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>2024-07-16 08:23</td>
            <td>Somras</td>
            <td>9333209044</td>
            <td>Apache 4v</td>
            <td></td> <!-- Empty cell for Lead Source -->
            <td><span class="status-final">DEAL FINAL</span></td>
            <td>0000-00-00</td>
            <td>Suman Ghosh</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" href="#"><div><i class='bx bxs-user me-2' style="color: #FFDF00;"></i><span>Booking</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <!-- Repeat rows as needed -->
                </tbody>
              </table>
            </div>
            <!--Modal View-->
            <div class="modal fade modal_view" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="addBrokerModalLabel">Lead Details</h5>
                    
                  </div>
                  <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                          <th>Name</th>
                          <td>Somras</td>
                          <th>Number</th>
                          <td>9333209044</td>
                        </tr>
                        <tr>
                          <th>Source</th>
                          <td>Apache 4v</td>
                          <th>Interest</th>
                          <td>Apache 4v</td>
                        </tr>
                        <tr>
                          <th>Creation Date</th>
                          <td>2024-07-16</td>
                          <th>Broker Name</th>
                          <td>IMARUL</td>
                        </tr>
                        <tr>
                          <th>Brokerage Amount</th>
                          <td>0</td>
                          <th>Lead Status</th>
                          <td>DEAL FINAL</td>
                        </tr>
                        <tr>
                          <th>Follow-up Date</th>
                          <td>0000-00-00</td>
                          <th>Type</th>
                          <td></td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td></td> 
                            <td colspan="2"></td>
                        </tr>
                      </table>
            
                      <!-- Follow-up Details Table -->
                      <h6>Follow-up Details</h6>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Notes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>0000-00-00</td>
                            <td>Next Follow-up</td>
                            <td>DEAL FINAL</td>
                            <td>Apache 4v</td>
                          </tr>
                        </tbody>
                      </table>
                 
                  </div>
                  <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
            <!--Modal Edit-->
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="addBrokerModalLabel">Update Lead Details</h5>
                    
                  </div>
                  <div class="modal-body">
                    <form>
                        <!-- Name -->
                        <div class="form-group">
                          <label for="name">Name<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" placeholder="Enter name" required>
                        </div>
                  
                        <!-- Contact Number -->
                        <div class="form-group mt-3">
                          <label for="contactNumber">Contact Number<span class="text-danger">*</span></label>
                          <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number" required>
                        </div>
                  
                        <!-- Bike of Interest -->
                        <div class="form-group mt-3">
                          <label for="bikeOfInterest">Bike of Interest</label>
                          <input type="text" class="form-control" id="bikeOfInterest" placeholder="Enter bike of interest">
                        </div>
                  
                        <!-- Select Broker -->
                        <div class="form-group mt-3">
                          <label for="broker">Select Broker</label>
                          <select class="form-control" id="broker">
                            <option>IMRANUL</option>
                            <option>Other Broker 1</option>
                            <option>Other Broker 2</option>
                          </select>
                        </div>
                  
                        <!-- Broker Brokerage Amount -->
                        <div class="form-group mt-3">
                          <label for="brokerageAmount">Broker Brokerage Amount</label>
                          <input type="number" class="form-control" id="brokerageAmount" placeholder="Enter brokerage amount">
                        </div>
                  
                        <!-- Lead Source -->
                        <div class="form-group mt-3">
                          <label for="leadSource">Lead Source</label>
                          <input type="text" class="form-control" id="leadSource" placeholder="Enter lead source">
                        </div>
                  
                        <!-- Lead Type -->
                        <div class="form-group mt-3">
                          <label for="leadType">Lead Type</label>
                          <select class="form-control" id="leadType">
                            <option>New</option>
                            <option>Returning</option>
                            <option>Referral</option>
                          </select>
                        </div>
                  
                        <!-- Exchange Checkbox -->
                        <div class="form-group form-check mt-3">
                          <input type="checkbox" class="form-check-input" id="exchange">
                          <label class="form-check-label" for="exchange">Exchange</label>
                        </div>
                  
                        <!-- Bike Name -->
                        <div class="form-group mt-3">
                          <label for="bikeName">Bike Name</label>
                          <input type="text" class="form-control" id="bikeName" placeholder="Enter bike name">
                        </div>
                  
                        <!-- Bike Value -->
                        <div class="form-group mt-3">
                          <label for="bikeValue">Bike Value</label>
                          <input type="number" class="form-control" id="bikeValue" placeholder="Enter bike value">
                        </div>
                  
                        <!-- Cash Paid -->
                        <div class="form-group mt-3">
                          <label for="cashPaid">Cash Paid</label>
                          <input type="number" class="form-control" id="cashPaid" placeholder="Enter cash paid">
                        </div>
                  
                        <!-- Lead Status -->
                        <div class="form-group mt-3">
                          <label for="leadStatus">Lead Status</label>
                          <select class="form-control" id="leadStatus">
                            <option>New Lead</option>
                            <option>Follow-up</option>
                            <option>Closed</option>
                            <option>Lost</option>
                          </select>
                        </div>
                  
                        <!-- Creation Date -->
                        <div class="form-group mt-3">
                          <label for="creationDate">Creation Date</label>
                          <input type="date" class="form-control" id="creationDate" value="2024-11-03">
                        </div>
                  
                        <!-- Next Follow-up Date -->
                        <div class="form-group mt-3">
                          <label for="followUpDate">Next Follow-up Date</label>
                          <input type="date" class="form-control" id="followUpDate">
                        </div>
                  
                        <!-- Notes -->
                        <div class="form-group mt-3">
                          <label for="notes">Notes</label>
                          <textarea class="form-control" id="notes" rows="3" placeholder="Enter any notes"></textarea>
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Model Delete -->
            <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-danger">
                 
                    <h5 class="modal-title" id="addBrokerModalLabel">Confirmation</h5>
                    
                  </div>
                  <div class="modal-body">
                     <h5 class="text_body">Are you sure to delete this broker permanently?</h5>
                  </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">DELETE</button>
                  </div>
                </div>
              </div>
            </div>
            <!--Modal Booking-->
            <div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-danger">
                   
                      <h5 class="modal-title" id="addBrokerModalLabel">Confirmation</h5>
                      
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- Name -->
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" id="name" placeholder="Enter name">
                            </div>
                            
                            <!-- Mobile Number -->
                            <div class="form-group mt-3">
                              <label for="mobileNumber">Mobile Number</label>
                              <input type="text" class="form-control" id="mobileNumber" placeholder="Enter mobile number">
                            </div>
                            
                            <!-- Father's Name -->
                            <div class="form-group mt-3">
                              <label for="fathersName">Father's Name</label>
                              <input type="text" class="form-control" id="fathersName" placeholder="Enter father's name">
                            </div>
                            
                            <!-- Address -->
                            <div class="form-group mt-3">
                              <label for="address">Address</label>
                              <textarea class="form-control" id="address" rows="2" placeholder="Enter address"></textarea>
                            </div>
                            
                            <!-- Pincode -->
                            <div class="form-group mt-3">
                              <label for="pincode">Pincode</label>
                              <input type="text" class="form-control" id="pincode" placeholder="Enter pincode">
                            </div>
                            
                            <!-- Age -->
                            <div class="form-group mt-3">
                              <label for="age">Age</label>
                              <input type="number" class="form-control" id="age" placeholder="Enter age">
                            </div>
                            
                            <!-- Bike Name -->
                            <div class="form-group mt-3">
                              <label for="bikeName">Bike Name</label>
                              <input type="text" class="form-control" id="bikeName" placeholder="Enter bike name">
                            </div>
                            
                            <!-- Booking Amount -->
                            <div class="form-group mt-3">
                              <label for="bookingAmount">Booking Amount</label>
                              <input type="number" class="form-control" id="bookingAmount" placeholder="Enter booking amount">
                            </div>
                            
                            <!-- Payment Method -->
                            <div class="form-group mt-3">
                              <label for="paymentMethod">Payment Method</label>
                              <select class="form-control" id="paymentMethod">
                                <option>CASH</option>
                                <option>CARD</option>
                                <option>ONLINE</option>
                              </select>
                            </div>
                            
                            <!-- Booking Type -->
                            <div class="form-group mt-3">
                              <label for="bookingType">Booking Type</label>
                              <select class="form-control" id="bookingType">
                                <option>NEW</option>
                                <option>EXISTING</option>
                              </select>
                            </div>
                            
                            <!-- Reference Number -->
                            <div class="form-group mt-3">
                              <label for="referenceNumber">Reference Number</label>
                              <input type="text" class="form-control" id="referenceNumber" placeholder="Enter reference number">
                            </div>
                            
                            <!-- Gift Item -->
                            <div class="form-group mt-3">
                              <label for="giftItem">Gift Item</label>
                              <input type="text" class="form-control" id="giftItem" placeholder="Enter gift item">
                            </div>
                            
                            <!-- Document Type -->
                            <div class="form-group mt-3">
                              <label for="documentType">Document Type</label>
                              <select class="form-control" id="documentType">
                                <option>AADHAAR</option>
                                <option>PASSPORT</option>
                                <option>DRIVING LICENSE</option>
                              </select>
                            </div>
                            
                            <!-- Upload Document -->
                            <div class="form-group mt-3">
                              <label for="uploadDocument">Upload Document</label>
                              <input type="file" class="form-control-file" id="uploadDocument">
                            </div>
                            
                            <!-- Notes -->
                            <div class="form-group mt-3">
                              <label for="notes">Notes</label>
                              <textarea class="form-control" id="notes" rows="2" placeholder="Enter notes"></textarea>
                            </div>
                            
                            <!-- Estimate Delivery Date -->
                            <div class="form-group mt-3">
                              <label for="estimateDeliveryDate">Estimate Delivery Date</label>
                              <input type="date" class="form-control" id="estimateDeliveryDate">
                            </div>
                            
                          </form>
                    </div>
                    <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger">Save</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>

      </div>

     
    </div>
  </section>

  <script>
 

   let sidebar = document.querySelector(".sidebars");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>