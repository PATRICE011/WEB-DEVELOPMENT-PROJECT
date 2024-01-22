<?php 
  // database connection
  include("include/connect.php");
  // common functions
  include("functions/myfunctions.php");
 
  @session_start();
  $user_id = getUserIdFromSession() ;
  // if add to cart button is clicked
  if(isset($_GET['add_to_cart'])){
    if(!isset($user_id)){
      echo"<script>alert('Please Log in to your account')</script>";
      echo"<script>window.open('users_area/user_login.php','_self')</script>";
    }else{
      mycart();
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YESBREW</title>
    <!-- css link -->
    <link rel="stylesheet" href="style.css">
    <!-- BOOTSTRAP LINK -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME ICONS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   
  <style>
   
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000; 
      background-color: #563314 !important;
      /* padding-top: 15px;
      padding-bottom: 15px; */
    }
    .navbar-brand {
      font-size: 24px;
      font-weight: bold;
      color: #fff;
      margin-right: 50px;
    }
    .navbar-brand i {
      margin-right: 10px;
    }
    .navbar-nav .nav-link {
      color: #fff !important;
      margin-right: 15px;
    }
    .navbar-nav .nav-link:hover {
      color: #ffc107 !important;
    }
    .navbar-nav img {
      width: 50px; 
      height: 50px; 
      border-radius: 50%; 
      object-fit: cover; 
    }
    .dropdown-toggle::after {
      display: none;
    }
    .search-form {
      position: relative;
    }
    .search-form input[type="search"] {
      padding-right: 35px; 
    }
    .search-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      color: #ccc;
      cursor: pointer;
      padding: 8px;
    }
    .navbar-cart {
      display: flex;
      align-items: center;
      margin-bottom: 0; 
      padding-right: 15px;
    }

    .cart-icon {
      font-size: 20px; 
      color: #fff !important;
    }
    sup{
      color: #fff;
      padding-left: 7px;
      
    }
  
    .footer {
      background-color: #563314;
      color: #fff;
      padding: 20px 0;
      text-align: center;
      margin-top: 50px;
    }

    .social-icons {
      margin-top: 10px;
      margin-bottom: 20px;
    }

    .social-icons a {
      display: inline-block;
      color: #fff;
      margin: 0 10px;
      text-decoration: none;
      font-size: 24px;
    }
    .credit span{
      font-weight: bold;
    }
  </style>
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">
      <i class="fas fa-mug-hot"></i> YesBrew
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#reviews">Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0 mr-3 search-form">
        <div class="position-relative">
          <input class="form-control mr-sm-2" type="search" id="live-search-input" placeholder="Search" aria-label="Search">
          <i class="fas fa-search search-icon"></i>
        </div>
      </form>
      <div class="navbar-cart">
        <a class="nav-link" href="mycart.php"><i class="fas fa-shopping-cart cart-icon"></i><sup><?php getcartnumbers();?></sup></a>
      </div>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php 
          if(!isset($_SESSION["user_id"])){
            echo"<img src='https://via.placeholder.com/50' alt='Profile' class=''>";
          }else{
              $select_image = "SELECT * FROM `user_table` WHERE user_id = '$user_id'";
              $result = mysqli_query($con, $select_image);
              $row_image = mysqli_fetch_array($result);
              $user_image = $row_image["user_image"];
              echo"<img src='users_area/user_images/$user_image' alt='Profile' class=''>";
          }
        ?>  
        
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
                  if(!isset($_SESSION['user_id'])){
                    echo"<a class='dropdown-item' href='users_area/user_login.php'><i class='fas fa-sign-out-alt mr-2'></i>Login/Register</a>";
                  }else{
                    
                    echo"
                    <a class='dropdown-item' href='users_area/myorders.php'><i class='fas fa-shopping-bag mr-2'></i>My Orders</a>
                    <a class='dropdown-item' href='#'><i class='fas fa-cog mr-2'></i>Settings</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='users_area/logout.php'><i class='fas fa-sign-out-alt mr-2'></i>Log out</a>";
                    
                  }
            ?>
        </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

  
    <!-- hero -->
    <section id="home">
    <div class="content">
      <h3>Start Your Day With a <br> Fresh Coffee</h3>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero, fugit
         <br>ipsum dolor sit amet consectetur.
      </p>
      <button id="btn">Shop Now</button>
    </div>
   </section>
    <!-- hero ends -->

     <!-- menu section -->
     <section class="menu" id="Menu">
         <h1>Our<span>Menu</span></h1>
        <!-- fetch products -->
        <div class='filter filter-button-group'>
          <button type='button' class='active-filter-btn' data-filter='*'>All</button>
          
          <?php 
              // categories
              $select_category = "select * from `categories`";
              $result_category = mysqli_query($con,$select_category);
              while($row_category = mysqli_fetch_assoc($result_category)){
                $category_name = $row_category["category_title"];
                $cat_id = $row_category['category_id']; 
                echo "<button type='button' data-filter='.category-$cat_id'>$category_name </button>";
            }
            ?>
         
        
        <?php 
          // Fetch products
          $select_query = "SELECT * FROM `products`";
          $result_query = mysqli_query($con, $select_query);

          echo "<div class='menu_box'>";

          while ($row = mysqli_fetch_assoc($result_query)) { 
              $prod_id = $row['product_id'];
              $prod_title = $row['product_title']; 
              $prod_desc = $row['product_description']; 
              $prod_image = $row['product_image']; 
              $prod_price = $row['product_price']; 
              $cat_id = $row['category_id'];  
              
              // Display dynamic products
              echo "
              <div class='menu_card category-$cat_id'>
                  <div class='menu_images'>
                    
                      <img src='admin/product_images/$prod_image' alt ='$prod_title'>
                  </div>
                  <div class='menu_info'>
                      <h2>$prod_title</h2>
                      <p>$prod_desc</p>
                      <h3>₱ $prod_price.00</h3>
                      <div class='buttons'>
                          <a href='#' class='menu_btn text-decoration-none'>Buy now</a>
                          <a href='index.php?add_to_cart=$prod_id' class='add_to_cart_btn text-decoration-none' >Add to Cart</a>
                          
                      </div>
                  </div>
              </div>";
          } 

          echo "</div>"; 
          
        ?>

        
    </section>
    <!-- menu section ends -->
     <!-- Reviews section -->
     <section class="container-fluid" id="reviews">
        <h1>Customer<span>Reviews</span></h1>
            
              <div class="row review align-items-center justify-content-center ">
                <!-- 1 -->
                <div class="col-lg-6 mb-3">
                  <div class="review-box">
                    <div class="box-top">
                      <div class="profile">
                        <div class="profile-img">
                          <img src="images/review/brayan.jpg" />
                        </div>
                        <div class="name-user">
                          <strong>Brayan Hufalar</strong>
                          <span>@bry1009</span>
                        </div>
                      </div>
                      <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                    </div>
                    <div class="customer-comment">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat quis? Provident temporibus architecto asperiores nobis maiores nisi a. Quae doloribus ipsum aliquam tenetur voluptates incidunt blanditiis
                        sed atque cumque.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 2 -->
                <div class="col-lg-6 mb-3">
                  <div class="review-box">
                    <div class="box-top">
                      <div class="profile">
                        <div class="profile-img">
                          <img src="images/review/griella.jpg" />
                        </div>
                        <div class="name-user">
                          <strong>Griella Autida</strong>
                          <span>@jhenggay</span>
                        </div>
                      </div>
                      <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="customer-comment">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat quis? Provident temporibus architecto asperiores nobis maiores nisi a. Quae doloribus ipsum aliquam tenetur voluptates incidunt blanditiis
                        sed atque cumque.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 3 -->
                <div class="col-lg-6 mb-3">
                  <div class="review-box">
                    <div class="box-top">
                      <div class="profile">
                        <div class="profile-img">
                          <img src="images/review/marchel.jpg" />
                        </div>
                        <div class="name-user">
                          <strong>Marchel Maugdang</strong>
                          <span>@chel.eme</span>
                        </div>
                      </div>
                      <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                    </div>
                    <div class="customer-comment">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat quis? Provident temporibus architecto asperiores nobis maiores nisi a. Quae doloribus ipsum aliquam tenetur voluptates incidunt blanditiis
                        sed atque cumque.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 4 -->
                <div class="col-lg-6 mb-3">
                  <div class="review-box">
                    <div class="box-top">
                      <div class="profile">
                        <div class="profile-img">
                          <img src="images/review/anthony.jpg" />
                        </div>
                        <div class="name-user">
                          <strong>Anthony Lapada</strong>
                          <span>@junior22</span>
                        </div>
                      </div>
                      <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                    <div class="customer-comment">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat quis? Provident temporibus architecto asperiores nobis maiores nisi a. Quae doloribus ipsum aliquam tenetur voluptates incidunt blanditiis
                        sed atque cumque.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <p class="text-center text-black-50 pt-2 pb-3 read-all">Read all reviews <img src="https://img.icons8.com/ios-filled/14/000000/up-right-arrow.png" /></p>
            </div>
          
    </section>
    <!-- reviews section ends -->
    <!-- contact section -->
    <section class="contact" id="contact">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.2103900630364!2d120.98191187423335!3d14.587084177409176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca21ac302015%3A0x92dcca0f915010d9!2sTechnological%20University%20of%20the%20Philippines%20(TUP)%20-%20Manila!5e0!3m2!1sen!2sph!4v1702905709455!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contact-form">
            <h1>Contact Us</h1>
            <form>
                <input type="text" placeholder="Name" class="contact-form-txt" />
                <input type="text" placeholder="email" class="contact-form-txt" />
                <input type="text" placeholder="Phone Number" class="contact-form-txt" />
                <textarea placeholder="Message" class="contact-form-textarea"></textarea>
                <input type="submit" name="Submit" class="contact-form-btn" />
            </form>
        </div>
    </section>
    <!-- contact section ends -->

    <footer class="footer">
    <div class="container">
      <div class="social-icons">
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
      </div>
      <div class="credit">created by <span>Patrice Quitoles</span> | all rights reserved</div>
    </div>
  </footer>
    
    <!-- scripts -->
   
     <!-- jquery -->
     <script src="jquery-3.7.1.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <!-- isotope filtering -->
     <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <script src="script.js"></script>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/784fd7c1bd.js" crossorigin="anonymous"></script>
    <!-- search -->
    <script src="search.js"></script>
</body>
</html>