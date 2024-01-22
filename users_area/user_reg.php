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
  <title>Registration Form</title>
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
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .reg-heading {
      text-align: center;
    }
    .signup-btn {
      background-color: #563314;
      color: #fff;
      border: none;
    }
    .signup-btn:hover {
      background-color: #563314;
      color: #fff;
    }
    .google-btn {
      background-color: red;
      color: #fff;
      border: none;
    }
    .google-btn:hover {
      background-color: red;
      color: #fff;
    }
    .google-btn i {
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
  <div class="form-container">
    <h2 class="reg-heading">Sign Up</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <!-- first name -->
        <div class="col-md-6 mb-3">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="fname" placeholder="Enter your first name" autocomplete="off" required>
        </div>
        <!-- last name -->
        <div class="col-md-6 mb-3">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lname" placeholder="Enter your last name" required>
        </div>
      </div>
      <!-- user name -->
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
        </div>
        <!-- email -->
        <div class="col-md-6 mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
        </div>
      </div>
      <!-- password -->
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <!-- confirm password -->
        <div class="col-md-6 mb-3">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" name="c_password" placeholder="Confirm your password" required>
        </div>
      </div>
      <!-- phone number -->
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="phoneNumber">Phone Number</label>
          <input type="tel" class="form-control" id="phoneNumber" name="cpnumber" placeholder="Enter your phone number" required>
        </div>
        <!-- home address -->
        <div class="col-md-6 mb-3">
          <label for="address">Home Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter your home address" required>
        </div>
      </div>
      <!-- profile image -->
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
      </div>
      <input type="submit" class="btn signup-btn btn-block" name="signup_button" value="Sign Up">
    </form>
    <hr>
    <!-- google sign up option -->
    <div class="text-center">
      <!-- <p>or sign up with</p> -->
      <button class="btn google-btn btn-block " name="sign_up_google"><i class="fab fa-google"></i> Register with Google</button>
    </div>
    <p class="text-center my-3">Already have an account? <a href="user_login.php">Login</a></p>
  </div>
</div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!-- php code -->
<?php 
  if(isset($_POST["signup_button"])){
      $signup_fname = $_POST['fname'];
      $signup_lname = $_POST['lname'];
      $signup_username = $_POST['username'];
      $signup_email = $_POST['email'];
      $signup_password= $_POST['password'];
      // password hashing
      // If a website is hacked, password hashing helps prevent cybercriminals from getting access to your passwords.
      $hash_password = password_hash($signup_password, PASSWORD_DEFAULT);
      $signup_cpassword = $_POST['c_password'];
      $signup_cpnumber = $_POST['cpnumber'];
      $signup_address = $_POST['address'];
      $signup_image = $_FILES['image']['name'];
      $signup_image_tmp = $_FILES['image']['tmp_name'];
    
      // fecth username
      $select_username = "SELECT * FROM `user_table` WHERE user_name = '$signup_username' ";
      $result_username = mysqli_query($con, $select_username);
      $row_username = mysqli_num_rows($result_username);
      // fecth email
      $select_email = "SELECT * FROM `user_table` WHERE user_email = '$signup_email' ";
      $result_email = mysqli_query($con, $select_email);
      $row_email = mysqli_num_rows($result_email);

      // conditions
      if($row_username > 0){
        echo "<script>alert('username already exist')</script>";
      }else if($row_email > 0){
        echo "<script>alert(' email already exist')</script>";
      }else if($signup_password != $signup_cpassword){
        echo "<script>alert('password do not match')</script>";
      }
      else{
        move_uploaded_file($signup_image_tmp,"./user_images/$signup_image");
      
      // for admin
        // $insert_admin = "INSERT INTO `admin_table` (username,admin_password,firstname,lastname,admin_profile)
        // VALUES ('$signup_username','$hash_password','$signup_fname','$signup_lname','$signup_image')" ;
        // mysqli_query($con, $insert_admin);
      $insert_query = "INSERT INTO `user_table` 
      (user_fname,user_lname,user_name,user_email,user_password,user_image,user_address,user_number)
      VALUES ('$signup_fname','$signup_lname','$signup_username','$signup_email','$hash_password','$signup_image','$signup_address','$signup_cpnumber')";
      $sql_execute=mysqli_query($con, $insert_query);
      echo "<script>window.open('user_login.php','_self')</script>";
    
    }
      
  }
?>