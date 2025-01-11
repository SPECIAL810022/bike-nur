<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> User List </title>
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
              <h4>System Information</h4>
              
            </div>
            <div>
                <form>
                    <div class="form-group ">
                        <label for="brokerName" class="mb-2">System Name</label>
                        <input type="text" class="form-control" id="brokerName" placeholder="Enter System Name" required>
                      </div>
                      <div class="form-group mt-4">
                          <label for="brokerName" class="mb-2">System Short Name</label>
                          <input type="text" class="form-control" id="brokerName" placeholder="Enter System Short Name" required>
                        </div>
                        <div class="form-group mt-4">
                          <label for="brokerName" class="mb-2">System Logo</label>
                          <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                        <div class="text-center mt-3">
                            <img src="img/logo.png" alt="" style="width: 100px; border: 1px solid black; border-radius: 50%;">
                        </div>
                      <div class="form-group mt-4">
                        <label for="brokerPhone" class="mb-2">Website Cover</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                      </div>
                      <div class="mt-3 text-center">
                        <img src="img/cover.png" alt="" style="width: auto; height: 90vh;" >
                      </div>
                      <div class="form-group mt-4">
                          <label for="brokerPhone" class="mb-2">Banner Images</label>
                          <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                        <div class="mt-4">
                            <button type="update" class="btn btn-primary mb-3">Update</button>
                          </div>
                </form>
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