<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>  Customers </title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
        .table-responsive {
  margin-top: 1rem;
}

.d-flex.justify-content-between {
  padding-bottom: 1rem;
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
              <h4>List of Customers</h4>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">+ Create New</button>
            </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="addBrokerModalLabel">Add Customer Details</h5>
          
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group ">
              <label for="brokerName" class="mb-2">Name</label>
              <input type="text" class="form-control" id="brokerName" placeholder="Enter broker name" required>
            </div>
            <div class="form-group mt-4">
                <label for="brokerName" class="mb-2">Father's Name</label>
                <input type="text" class="form-control" id="brokerName" placeholder="Enter broker name" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerAddress" class="mb-2">Address</label>
                <textarea class="form-control" id="brokerAddress" rows="3" placeholder="Enter address"></textarea>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Post Office</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Post Office" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Police Station</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Police Station" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">District</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter District" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Pincode</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Pincode" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Contact Number</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Contact Number" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Age</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Age" required>
              </div>
              <div class="form-group mt-4">
                <label for="brokerPhone" class="mb-2">Nominee Name</label>
                <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Nominee Name" required>
              </div>
            <div class="form-group mt-4">
              <label for="brokerPhone" class="mb-2">Relationship</label>
              <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Relationship" required>
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
                    <th class="bg-warning">Father's Name</th>
                    <th class="bg-warning">Phone</th>
                    <th class="bg-warning">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>2024-07-14 13:33</td>
                    <td>Aubal ns sarvis</td>
                    <td>MM</td>
                    <td>9231904316</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>2024-07-14 13:33</td>
                    <td>Aubal ns sarvis</td>
                    <td>MM</td>
                    <td>9231904316</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>2024-07-14 13:33</td>
                    <td>Aubal ns sarvis</td>
                    <td>MM</td>
                    <td>9231904316</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
                            </ul>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>2024-07-14 13:33</td>
                    <td>Aubal ns sarvis</td>
                    <td>MM</td>
                    <td>9231904316</td>
                    <td>
                        <div class="dropdown text-center">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                          
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal" href="#"><div><i class='bx bx-low-vision me-2' ></i><span>View</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" href="#"><div><i class='bx bxs-edit me-2 ' style="color: #1887FF;"></i><span>Edit</span></div></a></li>
                              <li><a class="dropdown-item" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" href="#"><div><i class='bx bxs-trash-alt me-2 ' style="color: #DC3545;"></i><span>Delete</span></div></a></li>
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
                    <h5 class="modal-title" id="addBrokerModalLabel">Customer Details</h5>
                    
                  </div>
                  <div class="modal-body">
                  
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong> Name</strong>
                          <span>Aubal ns sarvis</span>
                      </div>
                     
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong> Father's Name</strong>
                          <span>demo</span>
                      </div>
                      
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Address	</strong>
                          <span>adas</span>
                      </div>
                      
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Post Office	</strong>
                          <span></span>
                      </div>
                     
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Police Station	</strong>
                          <span></span>
                      </div>
                      
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>District</strong>
                          <span></span>
                      </div>
                      
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Pin</strong>
                          <span></span>
                      </div>
                     
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Contact Number</strong>
                          <span></span>
                      </div>
                  
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Age</strong>
                          <span></span>
                      </div>
                  
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Nominee Name</strong>
                          <span></span>
                      </div>
                   
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Relationship	</strong>
                          <span></span>
                      </div>
                  
                      
                      <div class="mb-3 d-flex align-items-center justify-content-between">
                          <strong>Documents</strong>
                          <span><img src="img/01.webp" alt=""></span>
                      </div>
                
                 
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
                    <h5 class="modal-title" id="addBrokerModalLabel">Add Broker Details</h5>
                    
                  </div>
                  <div class="modal-body">
                    <form>
                        <div class="form-group ">
                          <label for="brokerName" class="mb-2">Name</label>
                          <input type="text" class="form-control" id="brokerName" placeholder="Enter broker name" required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="brokerName" class="mb-2">Father's Name</label>
                            <input type="text" class="form-control" id="brokerName" placeholder="Enter broker name" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerAddress" class="mb-2">Address</label>
                            <textarea class="form-control" id="brokerAddress" rows="3" placeholder="Enter address"></textarea>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Post Office</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Post Office" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Police Station</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Police Station" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">District</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter District" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Pincode</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Pincode" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Contact Number</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Contact Number" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Age</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Age" required>
                          </div>
                          <div class="form-group mt-4">
                            <label for="brokerPhone" class="mb-2">Nominee Name</label>
                            <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Nominee Name" required>
                          </div>
                        <div class="form-group mt-4">
                          <label for="brokerPhone" class="mb-2">Relationship</label>
                          <input type="tel" class="form-control" id="brokerPhone" placeholder="Enter Relationship" required>
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