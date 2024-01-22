<?php 
  include("../include/connect.php");
  include("../functions/myfunctions.php");
  @session_start();
  
  if(!isset($_SESSION['username'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
  $admin_username = $_SESSION['username'];
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for styling */
    :root {
      --theme-color: #563314;
      --hover-color: #B8860B;
      --body-bg-color: #E1D9D1; /* Darker body background color */
      --sidebar-width: 200px; /* Adjust sidebar width */
    }

    .navbar {
      background-color: var(--theme-color);
      color: white;
      position: fixed;
      width: 100%; 
      top: 0;
      z-index: 1001;
      border-bottom: 4px solid #40180D; 
      height: 76px; 
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: white;
    }

    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      object-position: center;
      margin-bottom: 20px; 
      margin-top: 6px; 
    }

    .fixed-menu {
      background-color: var(--theme-color);
      color: white;
      height: 100vh;
      width: var(--sidebar-width); 
      position: fixed;
      top: 76px; 
      left: 0;
      overflow-y: auto;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      align-items: center; 
      padding-top: 20px; 
    }

    .main-content {
      margin-left: var(--sidebar-width); 
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      padding-top: 80px; 
    }

    .list-group-item {
      text-align: left; 
      border: none; 
      border-radius: 0; 
      background-color: transparent !important; 
      color: white; 
      transition: color 0.3s; 
    }

    .list-group-item:hover {
      color: var(--hover-color); 
    }

    .list-group-item:last-child {
      margin-top: auto; 
    }

    /* @media (max-width: 767px) {
      body {
        padding-top: 56px;
      }
    } */
    
    .insert-category{
        margin-top: 100px;
        margin-left: 150px;
    
    }
    .container-form {
        width: 70%;
        margin: 0 auto;
        border: 2px solid #E1D9D1;
        padding: 2rem;
        border-radius: 10px;
    }

    .input {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        
    }

    .input i {
        margin-right: 10px; 
        border: 1px solid #563314;
        padding: 10px;
        font-size: 20px;
        color: #563314;
        border-radius: 10px;
    }

    .input-category {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        color: #563314;
    }
    
    button {
        padding: 8px 20px;
        font-size: 16px;
        border: 1px;
        border-radius: 10px;
        background-color: #563314;
        color: #ffffff;
        cursor: pointer;
    }
    
    .container-form2 {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        max-width: 750px; 
        margin: 70px auto;
        border: 2px solid #E1D9D1;
        padding: 1rem 2rem;
        border-radius: 10px;
    }

    .input-prod {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .form-label {
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .btn-custom {
    background-color: #563314;
    color: #fff;
    
    }
    .btn-custom:hover{
        color: #fff;
    }
    @media (max-width: 767px) {
      body {
        padding-top: 56px;
      }

      .fixed-menu {
        display: none; 
        position: fixed;
        top: 56px; 
        left: 0;
        width: 100%;
        height: calc(100% - 56px); 
        background-color: var(--theme-color);
        color: white;
        z-index: 1000;
        padding-top: 20px;
        text-align: center; 
      }

      .fixed-menu .profile-img {
        margin: 20px auto; 
      }

      .fixed-menu a {
        color: white;
        padding: 10px;
        text-decoration: none;
        display: block;
        text-align: center; 
        margin-top: 10px; 
      }

      #menu-toggle {
        display: block;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1002;
        color: white;
        cursor: pointer;
      }

      .menu-open {
        display: block !important; 
      }
      .insert-category{
        margin-top: 100px;
        margin-left: auto;
    
    }
    }
  </style>
</head>

<body>
      <?php 
        $select_image = "SELECT * FROM `admin_table` WHERE username = '$admin_username' ";
        $result = mysqli_query($con, $select_image);
        $fetch_image = mysqli_fetch_assoc($result);
        $admin_image = $fetch_image['admin_profile'];
        $admin_fname = $fetch_image['firstname'];
        $admin_lname = $fetch_image['lastname'];
      ?>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand mx-auto" href="#"><h4>Welcome back, <?php echo $admin_fname; echo" "; echo $admin_lname; echo" ! ";?></h4></a>
    
  </nav>
  <div id="menu-toggle">&#9776;</div>
  <div class="fixed-menu">
    <div class="profile-img">
      
      <img src="../users_area/user_images/<?php echo $admin_image; ?>" alt="Profile Image" class="profile-img">
 
    </div>
    
    <div class="list-group text-center mt-3">
      <a href="index.php?insert_product" class="list-group-item list-group-item-action">Insert Products</a>
      <a href="index.php?view_product" class="list-group-item list-group-item-action">View Products</a>
      <a href="index.php?insert_category" class="list-group-item list-group-item-action">Insert Categories</a>
      <a href="index.php?view_categories" class="list-group-item list-group-item-action">View Categories</a>
      <a href="index.php?all_orders" class="list-group-item list-group-item-action">All Orders</a>
      <a href="index.php?all_users" class="list-group-item list-group-item-action">List Users</a>
      <a href="index.php?logout" class="list-group-item list-group-item-action">Log out</a>
    </div>
  </div>

  
  <?php 

    if(isset($_GET["insert_category"])){
        include("insert_categories.php");
    }
    if(isset($_GET["view_categories"])){
      include("view_categories.php");
  }
    if(isset($_GET["insert_product"])){
        include("insert_products.php");
    }
    if(isset($_GET["view_product"])){
      include("view_products.php");
    }
    if(isset($_GET["all_orders"])){
        include("all_orders.php");
    }
    if(isset($_GET["all_users"])){
      include("view_users.php");
    }
    if(isset($_GET["logout"])){
        include("admin_logout.php");
        
    }
?>
  
  
</section>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- font awesome icons -->
  <script src="https://kit.fontawesome.com/784fd7c1bd.js" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
      // Toggle the fixed-menu on button click
      $("#menu-toggle").click(function () {
        $(".fixed-menu").toggleClass("menu-open");
      });
    });
  </script>
</body>

</html>
