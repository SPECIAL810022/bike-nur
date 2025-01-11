<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Today Leads</title>
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
                    <th class="bg-warning">Next Follow-up Date</th>
                    <th class="bg-warning">Created By</th>
                    <th class="bg-warning">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td valign="top" colspan="9" class="dataTables_empty text-center">No data available in table</td>
                  </tr>
                 
                  <!-- Repeat rows as needed -->
                </tbody>
              </table>
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