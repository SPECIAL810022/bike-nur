<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Leads By User </title>
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
              <div class=" text-center">
                <a class="btn btn-primary d-flex align-items-center" href="allleads" role="button" >
                    <i class='bx bx-left-arrow-alt me-2'></i><span>Back</span>
                </a>
              </div>
            </div>
  
            <div class="table-responsive ">
              <table class="table table-bordered table-hover">
                <thead class="thead-light ">
                  <tr >
                    <th class="bg-warning">#</th>
                    <th class="bg-warning">User</th>
                    <th class="bg-warning">Lead Count</th>
                    <th class="bg-warning">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
            <td>Somras</td>
            <td>9</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " style="display: flex; align-items: center;" href="allleads" role="button" >
                              <i class='bx bx-show me-2'></i><span>View</span>
                            </a>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>Somras</td>
            <td>9</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " href="allleads" role="button" >
                                <i class='bx bx-low-vision me-2' ></i><span>View</span>
                            </a>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>Somras</td>
            <td>9</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " href="allleads" role="button" >
                                <i class='bx bx-low-vision me-2' ></i><span>View</span>
                            </a>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
            <td>Somras</td>
            <td>9</td>
                    <td>
                        <div class=" text-center">
                            <a class="btn btn-primary " href="allleads" role="button" >
                                <i class='bx bx-low-vision me-2' ></i><span>View</span>
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