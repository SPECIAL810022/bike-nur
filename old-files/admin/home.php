<style>
  #site-cover {
    width: 100%;
    height: 40em;
    object-fit: cover;
    object-position: center center;
  }

  .animated-icon {
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.1);
    }

    100% {
      transform: scale(1);
    }
  }

  .clickable {
    cursor: pointer;
  }

  .clickable:hover {
    background-color: #f0f0f0;
  }
</style>

<div class="row">
  <?php if ($_settings->userdata('type') == 1) : ?>
    <div class="col-12 col-sm-4 col-md-4 animated fadeIn">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-th-list"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Brands</span>
          <span class="info-box-number text-right h5">
            <?php
            $brand = $conn->query("SELECT * FROM brand_list where delete_flag = 0 and `status` = 1")->num_rows;
            echo format_num($brand);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-4 col-md-4 animated fadeIn">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-car"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Bikes Models</span>
          <span class="info-box-number text-right h5">
            <?php
            $models = $conn->query("SELECT id FROM model_list where delete_flag = 0 and `status` = 1")->num_rows;
            echo format_num($models);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-4 col-md-4 animated fadeIn">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-car"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Available Vehicles</span>
          <span class="info-box-number text-right h5">
            <?php
            $vehicles = $conn->query("SELECT id FROM vehicle_list where delete_flag = 0 and `status` = 0")->num_rows;
            echo format_num($vehicles);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-4 col-md-4 animated fadeIn">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-car"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Sold Vehicles</span>
          <span class="info-box-number text-right h5">
            <?php
            $vehicles = $conn->query("SELECT id FROM vehicle_list where delete_flag = 0 and `status` = 1")->num_rows;
            echo format_num($vehicles);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  <?php endif; ?>


  <!-- all leads -->
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box clickable" onclick="window.location.href='./?page=lead'">
      <span class="info-box-icon bg-gradient-primary elevation-1 animated-icon"><i class="fas fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Leads</span>
        <span class="info-box-number text-right h5">
          <?php
          // Retrieve user ID and type
          $specific_user_id = $_settings->userdata('id');
          $user_type = $_settings->userdata('type');

          // Prepare the SQL query to count the total leads
          if ($user_type == 1) {
            $leads_query = "
                          SELECT COUNT(l.user_name) AS total_leads
                          FROM leads l
                          LEFT JOIN users u ON l.user_name = u.id
                      ";
          } else {
            $leads_query = "
                          SELECT COUNT(l.user_name) AS total_leads
                          FROM leads l
                          LEFT JOIN users u ON l.user_name = u.id
                          WHERE l.user_name = '{$specific_user_id}'
                      ";
          }

          // Execute the query
          $leads_result = $conn->query($leads_query);

          // Check if the query was successful and fetch the count
          if ($leads_result && $leads_result->num_rows > 0) {
            $leads_count = $leads_result->fetch_assoc()['total_leads'];
            echo format_num($leads_count);
          } else {
            echo "0"; // If there are no leads for the specified user, display 0
          }
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
  <!-- Today Leads -->
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box clickable" onclick="window.location.href='./?page=lead/today_lead'">
      <span class="info-box-icon bg-gradient-danger elevation-1 animated-icon"><i class="fas fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Today's Followup</span>
        <span class="info-box-number text-right h5">
          <?php
          // Retrieve user ID and type
          $specific_user_id = $_settings->userdata('id');
          $user_type = $_settings->userdata('type');

          // Prepare the SQL query to count today's followups
          if ($user_type == 1) {
            $leads_query = "
                            SELECT COUNT(l.user_name) AS total_leads
                            FROM leads l
                            LEFT JOIN users u ON l.user_name = u.id
                            WHERE DATE(l.NextFollowUpDate) = CURRENT_DATE
                        ";
          } else {
            $leads_query = "
                            SELECT COUNT(l.user_name) AS total_leads
                            FROM leads l
                            LEFT JOIN users u ON l.user_name = u.id
                            WHERE l.user_name = '{$specific_user_id}' AND DATE(l.NextFollowUpDate) = CURRENT_DATE
                        ";
          }

          // Execute the query
          $leads_result = $conn->query($leads_query);

          // Check if the query was successful and fetch the count
          if ($leads_result && $leads_result->num_rows > 0) {
            $leads_count = $leads_result->fetch_assoc()['total_leads'];
            echo format_num($leads_count);
          } else {
            echo "0"; // If there are no followups for the specified user, display 0
          }
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- over duw lead -->
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box clickable" onclick="window.location.href='./?page=lead/over_due_lead'">
      <span class="info-box-icon bg-gradient-warning elevation-1 animated-icon"><i class="fas fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Overdue Leads</span>
        <span class="info-box-number text-right h5">
          <?php
          // Retrieve user ID and type
          $specific_user_id = $_settings->userdata('id');
          $user_type = $_settings->userdata('type');

          // Prepare the SQL query to count overdue leads
          if ($user_type == 1) {
            $leads_query = "
                        SELECT COUNT(l.user_name) AS total_leads
                        FROM leads l
                        LEFT JOIN users u ON l.user_name = u.id
                        WHERE DATE(l.NextFollowUpDate) < CURRENT_DATE
                    ";
          } else {
            $leads_query = "
                        SELECT COUNT(l.user_name) AS total_leads
                        FROM leads l
                        LEFT JOIN users u ON l.user_name = u.id
                        WHERE l.user_name = '{$specific_user_id}' AND DATE(l.NextFollowUpDate) < CURRENT_DATE
                    ";
          }

          // Execute the query
          $leads_result = $conn->query($leads_query);

          // Check if the query was successful and fetch the count
          if ($leads_result && $leads_result->num_rows > 0) {
            $leads_count = $leads_result->fetch_assoc()['total_leads'];
            echo format_num($leads_count);
          } else {
            echo "0"; // If there are no overdue leads for the specified user, display 0
          }
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>



  <script>
    document.querySelector('.info-box.clickable').addEventListener('click', function() {
      window.location.href = './?page=lead/over_due_lead';
    });
  </script>




</div>
</div>

<!-- <div class="container-fluid">
  <center>
    <img src="<?= validate_image($_settings->info('cover')) ?>" id="site-cover" alt="" class="img-fluid">
  </center>
</div> -->


<script>
  var anchortag = document.querySelectorAll('a')
  for (let index = 0; index < anchortag.length; index++) {
    const element = anchortag[index];
    console.log(element);
    if (element.innerHTML == "Developed by Deltaminds") {
      element.parentElement.style.display = "none"
    }
  }
</script>