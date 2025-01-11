<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> My Account </title>
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
        body {
  background-color: #f8f9fa;
}

.card {
  border-radius: 8px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.card-header {
  background-color: #007bff;
  color: #fff;
  border-bottom: 0;
  font-weight: bold;
}
.mc-file-upload {
    background-color: #e6e1e1;
    border-radius: 8px;
    color:#000;
    margin: 0 auto;
    position: relative;
    transition: all .3s linear;
    -webkit-transition: all .3s linear;
    -moz-transition: all .3s linear;
    -ms-transition: all .3s linear;
    -o-transition: all .3s linear;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
}
.mc-file-upload input {
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    visibility: hidden;
    width: 100%;
    z-index: 1;
}
.mc-file-upload.button label {
    align-items: center;
    cursor: pointer;
    display: flex;
    font-size: 13px;
    font-weight: 500;
    gap: 8px;
    justify-content: center;
    letter-spacing: .3px;
    padding: 10px 22px;
    text-transform: uppercase;
}
.mc-file-upload .bx{
    font-size: 20px;
}

     </style>
   </head>
<body>
<?php
include('assets/componets/sidebar.php');
?>
  <section class="home-section">
  <?php
include('assets/componets/header.php');
?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="container ">
            <h2 class="text-center mb-4">My Account</h2>
            <div class="row align-items-center ">
              <!-- Profile Info -->
              <div class="col-lg-4 mb-4">
                <div class="card">
                  <div class="card-body text-center">
                    <img src="img/logo.png" alt="Profile Picture" class="rounded-circle mb-3" width="120">
                    <h5>Admin Name</h5>
                    <div class="mc-file-upload button"><input type="file" id="avatar"><label for="avatar"><i class='bx bx-cloud-upload'></i><span>upload</span></label></div>
                  </div>
                </div>
              </div>
              
              <!-- Account Details -->
              <div class="col-lg-8 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h5>Account Details</h5>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-row">
                        <div class="form-group ">
                          <label for="firstName">First Name</label>
                          <input type="text" class="form-control" id="firstName" value="Admin" required>
                        </div>
                        <div class="form-group ">
                          <label for="lastName">Last Name</label>
                          <input type="text" class="form-control" id="lastName" value="User" required>
                        </div>
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input type="text" class="form-control" id="Username" value="admin">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" value="rgdsasa" required>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
              
              <!-- Account Settings -->
              <div class="col-12 mt-4">
                <div class="card">
                  <div class="card-header bg-danger">
                    <h5>Account Settings</h5>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="newPassword">New Password</label>
                          <input type="password" class="form-control" id="newPassword">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="confirmPassword">Confirm New Password</label>
                          <input type="password" class="form-control" id="confirmPassword">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-danger mt-3">Change Password</button>
                    </form>
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