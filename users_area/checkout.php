<?php 
  // database connect
  include("../include/connect.php");
  session_start();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- css link -->
    <link rel="stylesheet" href="style.css">
    <!-- BOOTSTRAP LINK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <!-- <header class=" nav-section">
        <div class="container-nav">
            
            <div class="logo">
                <a href="#hero"><h2><span>YES</span>BREW</h2></a>
            </div>
            
            <div class="user-cart">

                
                <a href=""><span class="material-symbols-outlined">person</span></a>
                
            </div>
             
        </div>
    </header>  -->
   <section class="checkout-container">
        <?php 
            // check if logged in
            if(!isset($_SESSION['user_id'])){
                include('user_login.php');
            }else{
                include('payment.php');
            }
        ?>
   </section>

    <!-- footer section
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h4>our branches</h4>
                <a href="#"><i class="fas fa-arrow-right"></i> Philippines</a>
                <a href="#"><i class="fas fa-arrow-right"></i> USA</a>
                <a href="#"><i class="fas fa-arrow-right"></i> France</a>
                <a href="#"><i class="fas fa-arrow-right"></i> Africa</a>
                <a href="#"><i class="fas fa-arrow-right"></i> Japan</a>
            </div>

            <div class="box">
                <h4>contact info</h4>
                <a href="#"><i class="fas fa-phone"></i> +123-456-7890</a>
                <a href="#"><i class="fas fa-phone"></i> +111-222-3333</a>
                <a href="#"><i class="fas fa-envelope"></i> yes.brew@gmail.com</a>
                <a href="#"><i class="fas fa-envelope"></i> yes.brew.ph@gmail.com</a>
            </div>

            <div class="box">
                <h4>contact info</h4>
                <a href="https://www.facebook.com/phatttrice/"><i class="fab fa-facebook-f"></i> facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> instagram</a>
                <a href="https://www.linkedin.com/in/patrice-quitoles/"><i class="fab fa-linkedin"></i> linkedin</a>
                <a href="#"><i class="fab fa-twitter"></i> twitter</a>
            </div>
        </div>

        <div class="credit">created by <span>Patrice Quitoles</span> | all rights reserved</div>
    </section>
     -->
    <!-- footer section ends -->
    
    <!-- scripts -->
   
     <!-- jquery -->
     <script src="jquery-3.7.1.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/784fd7c1bd.js" crossorigin="anonymous"></script>
</body>
</html>
