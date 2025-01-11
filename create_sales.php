<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>create sales</title>
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
            <h4>List of Vehicles</h4>
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
                  <th class="bg-warning">Brand</th>
                  <th class="bg-warning">Model</th>
                  <th class="bg-warning">Vehicle</th>
                  <th class="bg-warning">ON Road</th>
                  <th class="bg-warning">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>HERO</td>
                  <td>Hero passion pro</td>
                  <td><b style="font-size: 14px;">Chassis Number.: 2900</b> <p style="font-size: 12px;">Engine Number: 1900</p></td>
                  <td>135,000.00</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " href="" role="button" >
                                <span>Sell</span>
                            </a>
                          </div>
                    </td>
                </tr>
               
                <!-- Repeat rows as needed -->
              </tbody>
            </table>
          </div>
      <div class="row justify-content-between mb-1">
            <div class="col-md-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                 
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
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