<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<!--sidebar-->
<?php
include('assets/componets/sidebar.php');
?>
  <section class="home-section">
  <?php
include('assets/componets/header.php');
?>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="brand box">
          <div class="right-side">
            <div class="box-topic">Brands</div>
          </div>
          <i class='bx bx-list-ul cart'></i>
        </div>
        <div class="models box">
            <div class="right-side">
              <div class="box-topic">Bikes Models</div>
            </div>
            <i class='bx bxs-car cart'></i>
          </div>
          <div class="available box">
            <div class="right-side">
              <div class="box-topic">Available Vehicles</div>
            </div>
            <i class='bx bxs-car cart'></i>
          </div>
          <div class="sold box">
            <div class="right-side">
              <div class="box-topic">Sold Vehicles</div>
            </div>
            <i class='bx bxs-car cart'></i>
          </div>
          <div class="leads box">
            <div class="right-side">
              <div class="box-topic">Total Leads</div>
            </div>
            <i class='bx bxs-user cart'></i>
          </div>
          <div class="follow box">
            <div class="right-side">
              <div class="box-topic">Today's Followup</div>
            </div>
            <i class='bx bxs-user cart'></i>
          </div>
          <div class="overdue box">
            <div class="right-side">
              <div class="box-topic">Overdue Leads</div>
            </div>
            <i class='bx bxs-user cart'></i>
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
    <script src="jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>