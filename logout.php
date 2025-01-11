<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="css/logout.css">
</head>
<body class="bg_login">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 w-100" style="max-width: 400px;">
      <div class="text-center mb-4">
        <img src="img/logo.png" alt="Logo" style="width: 50px;">
        <h5 class="mt-2">Login to Auto</h5>
      </div>
      <form>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter your Username" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </form>
      <div class="text-center mt-3 forgot">
        <a href="myaccount">Forgot Password?</a>
      </div>
     
      
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
