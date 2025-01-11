<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
            <h4>List of Transactions By Dealer</h4>
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
                  <th class="bg-warning">Customer Name</th>
                  <th class="bg-warning">Dealer Name</th>
                  <th class="bg-warning">Bike Name</th>
                  <th class="bg-warning">Engine Number</th>
                  <th class="bg-warning">Chassis Number</th>
                  <th class="bg-warning">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>IMARUL MALLICK</td>
            <td>BAJAJ MAIN DEALER</td>
            <td>hero passion pro 15</td>
            <td>eng255</td>
            <td>chis62648</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " style="display: flex; align-items: center;" href="transactions_view" role="button" >
                              <i class='bx bx-show me-2'></i><span>View</span>
                            </a>
                          </div>
                    </td>
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