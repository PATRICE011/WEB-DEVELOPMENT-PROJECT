<?php 
  include("../include/connect.php"); 
  include("../functions/myfunctions.php");
  @session_start();
  $user_id = getUserIdFromSession() ;
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom Styles */
    body {
      background-color: #563314;
    }
    .form-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-heading {
      text-align: center;
    }
    .login-btn {
      background-color: #563314;
      color: #fff;
      border: none;
    }
    .login-btn:hover {
      background-color: #563314; 
    }
    .google-btn {
      background-color: red;
      color: #fff;
      border: none;
    }
    .google-btn:hover {
      background-color: red; 
    }
    .google-btn i {
      color: #fff;
    }
    .form-group:first-child {
      margin-bottom: 20px; 
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container ">
      <h2 class="login-heading">Log in</h2>
      <form method="post">
        <div class="form-group">
          <label for="username" >Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button class="btn login-btn btn-block" type="submit" name="login">Login</button>
      </form>
      <hr>
      <div class="text-center">
        <p>Don't have an account? <a href="user_reg.php">Register</a></p>
        <button class="btn google-btn btn-block" name="login_google"><i class="fab fa-google"></i> Login with Google</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
  if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    

    $select_query = "SELECT * FROM `user_table` WHERE user_name = '$username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    // cart item
    
    $select_cart = "SELECT * FROM `cart-details` WHERE user_id = '$user_id' ";
    $result_cart = mysqli_query($con,$select_cart);
    $row_result_cart = mysqli_num_rows($result_cart);

    if($result && $row_data = mysqli_fetch_assoc($result)){
        // Password from database
        $hashed_password = $row_data['user_password'];

        // Verify the entered password with the hashed password from the database
        if(password_verify($password, $hashed_password)){
            echo "<script>alert('You are logged in')</script>";
            $_SESSION['user_id'] = $row_data['user_id'];
            if($row_count == 1 and $row_result_cart == 0){
                  $_SESSION['user_id'] = $row_data['user_id'];
                    
                    echo "<script>window.open('../index.php','_self')</script>";
            }else{
                  $_SESSION['user_id'] = $row_data['user_id'];
                    
                   echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials 1')</script>";
        }
    }   else {
          echo "<script>alert('Invalid credentials 2')</script>";
    }
}

?>