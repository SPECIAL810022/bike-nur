<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Booking</title>
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
              <h4>List of Bookings</h4>
              
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
                    <th class="bg-warning">Booking Date</th>
                    <th class="bg-warning">Scheme</th>
                    <th class="bg-warning">Amount</th>
                    <th class="bg-warning">Name</th>
                    <th class="bg-warning">Contact Number</th>
                    <th class="bg-warning">Bike Interest</th>
                    <th class="bg-warning">Broker Name</th>
                    <th class="bg-warning">User Name</th>
                    <th class="bg-warning">Notes</th>
                    <th class="bg-warning">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td valign="top" colspan="11" class="dataTables_empty text-center">No data available in table</td>
                  </tr>
                 
                  <!-- Repeat rows as needed -->
                </tbody>
              </table>
            </div>
            <div class="  d-flex align-items-center justify-content-between">
                <p>Showing 1 to 3 of 3 entries</p>
                
                <!-- Pagination -->
                <div aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
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