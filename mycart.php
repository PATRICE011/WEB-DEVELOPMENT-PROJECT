<?php 
  // database connect
  include("include/connect.php");
  // common functions
  include("functions/myfunctions.php");
  @session_start();
   $user_id = getUserIdFromSession() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <!-- css link -->
    <link rel="stylesheet" href="mycart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000; 
        background-color: #563314 !important;
        
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
    .dropdown-toggle::after {
        display: none;
    }
    .align-center {
        display: flex;
        align-items: center;
    }
    .dropdown img {
      width: 50px; 
      height: 50px; 
      border-radius: 50%; 
      object-fit: cover; 
    }
    .navbar-nav .nav-link.dropdown-toggle {
    position: relative;
    }

    .dropdown-menu-right {
    right: 0; /* Adjust as needed to position the dropdown on the right side */
    left: auto !important;
    }

  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <div class="row w-100">
      <div class="col-6  align-center">
        <a class="navbar-brand" href="#">
          <i class="fas fa-mug-hot"></i> YesBrew
        </a>
      </div>
      <div class="col-6 d-flex justify-content-end">
        <div class="dropdown">
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
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <?php 
                  if(!isset($_SESSION['user_id'])){
                    echo"<a class='dropdown-item' href='users_area/user_login.php'><i class='fas fa-sign-out-alt mr-2'></i>Log in</a>";
                  }else{
                    
                    echo"
                    <a class='dropdown-item' href='users_area/myorders.php'><i class='fas fa-shopping-bag mr-2'></i>My Orders</a>
                    <a class='dropdown-item' href='#'><i class='fas fa-cog mr-2'></i>Settings</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='users_area/logout.php'><i class='fas fa-sign-out-alt mr-2'></i>Log out</a>";
                    
                  }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>


    <section class="checkout-container ">
    <form action="" method="post">
<?php 
            
            global $con;
            $select_query = "SELECT * FROM `cart-details` WHERE user_id = '$user_id' ";
            
            $result = mysqli_query($con,$select_query);
            $result_count = mysqli_num_rows($result);
            
            // check if cart is empty or not
            if($result_count > 0){
                echo "
        <div class='container px-3 my-5 clearfix'>
            <div class='card'>
                <div class='card-header'>
                    <h2>Shopping Cart</h2>
                </div>
                <div class='card-body'>
                      <div class='table-responsive'>
                         <table class='table table-bordered m-0'>
                            <thead>
                               <tr>
                                  <th class='text-center py-3 px-4' style='min-width: 400px;'>Product Name &amp; Details</th>
                                  <th class='text-right py-3 px-4' style='width: 100px;'>Price</th>
                                  <th class='text-center py-3 px-4' style='width: 120px;'>Quantity</th>
                                  <th class='text-right py-3 px-4' style='width: 100px;'>Total</th>
                                  <th class='text-center align-middle py-3 px-0' style='width: 40px;'><a href='#' class='shop-tooltip float-none text-light' title data-original-title='Clear cart'><i class='ino ion-md-trash'></i></a></th>
                               </tr>
                            </thead>
                <tbody>";
                
                
                $total_price = 0;
                while($row = mysqli_fetch_array($result)){
                    
                    $product_id=$row['product_id'];
                    $select_products="SELECT * FROM `products` WHERE product_id = $product_id ";
                   
                    $result_products = mysqli_query($con,$select_products);
                    
                    // fetch item quantity
                    $quantity_item =getProductQuantity($product_id, $con);
                    // remove item button
                                    
                    while($row_products_price = mysqli_fetch_array($result_products)){
                        // all price
                        $product_price=array($row_products_price['product_price']);
                        
                        // each product
                        $price_table = $row_products_price['product_price'];
                        $product_name = $row_products_price['product_title'];
                        $product_image = $row_products_price['product_image'];
                        
                        $item_total = $price_table * $quantity_item;
                        $total_price += ($price_table * $quantity_item);
                        
                                echo"
                            <!-- data of product -->
                            
                            <tr>
                            <td class='p-4'>
                            <div class='media align-items-center'>
                            <img src='admin/product_images/$product_image' class='d-block ui-w-40 ui-bordered mr-4' alt>
                            <div class='media-body'>
                            
                            <p class='d-block text-dark'>$product_name</p>
                            <td class='text-right font-weight-semibold align-middle p-4'>$price_table</td>
                            <td class='align-middle p-4'><input type='text' class='form-control text-center' name='item_quantity[$product_id]' value =' $quantity_item'></td>
                            <td class='text-right font-weight-semibold align-middle p-4'> $item_total  </td>
                            <td class='text-center align-middle px-0'>
                            <form method='post'>
                                <input type='hidden' name='remove_item_id' value='$product_id'>
                                <button type='submit' name='remove_item' class='shop-tooltip close float-none text-danger' title data-original-title='Remove'>×</button>
                            </form>
                        </td>
                            </tr>
                        <!-- end of data of product -->
                            ";
   
                    }
                    
                }
                // if apply button is clicked
                if (isset($_POST['apply_change'])) {
                    foreach ($_POST['item_quantity'] as $key => $value) {
                        $quantity = (int)$value;
                        $product_id = (int)$key;
                
                        if ($quantity > 0) {
                            
                            
                            $update_query = "UPDATE `cart-details` SET quantity = $quantity WHERE  product_id = $product_id AND user_id ='$user_id'";
                            
                            
                            mysqli_query($con, $update_query);
                            
        
                            $total_price = 0;
                        
                            $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' ";
                            
                            $result = mysqli_query($con, $select_query);

                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM `products` WHERE product_id =$product_id";
                                
                                $result_products = mysqli_query($con, $select_products);
                                
                                while ($row_products_price = mysqli_fetch_array($result_products)) {
                                    $product_price = (float)$row_products_price['product_price'];
                                    $quantity = $row['quantity'];
                                    $total_price += ($product_price * $quantity);
                                    
                                }
                            }
                           
                            $change_applied = true;
                        }
                        
                    }

                    if ($change_applied) {
                       
                        echo "<script>window.location.href = window.location.href;</script>";
                        exit; 
                    }else{
                        echo "<script>alert('input quantity')</script>";
                    }
                }
                
                
                // if remove button is clicked
                if (isset($_POST['remove_item'])) {
                    $remove_product_id = $_POST['remove_item_id'];
                    $remove_query = "DELETE FROM `cart-details` WHERE user_id ='$user_id' AND product_id = '$remove_product_id' ";
                    
                    mysqli_query($con, $remove_query);
                
                    // Redirect back to refresh the cart after removal
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit; 
                }
            echo"
            
            </tbody>
          </table>
       </div>
       <div class='d-flex flex-wrap justify-content-between align-items-center pb-4'>
          <div class='mt-4'>
             <label class='text-muted font-weight-normal'>Promocode</label>
             <input type='text' placeholder='ABC' class='form-control'>
          </div>
          <div class='d-flex'>
             <div class='text-right mt-4 mr-5'>
                <label class='text-muted font-weight-normal m-0'>Discount</label>
                <div class='text-large'><strong>$0</strong></div>
             </div>
             <div class='text-right mt-4'>
                <label class='text-muted font-weight-normal m-0'>Total price</label>
                <div class='text-large'><strong>$total_price</strong></div>
             </div>
          </div>
       </div>
       <div class='float-right'>
            <a href='index.php'><button type='button' class='btn btn-lg btn-default md-btn-flat mt-2 '>Back to shopping</button></a>
            <input type='submit' value ='Apply' class='btn btn-lg btn-warning mt-2' name='apply_change'>
            
            <a href='users_area/checkout.php'><button type='button' class='btn btn-lg btn-primary mt-2'>Checkout</button></a>
        </div>
      </div>
   </div>
</div>
            ";
            }else{
                echo"
                <div class='container px-3 my-5 clearfix'>
            <div class='card'>
                <div class='card-header'>
                    <h2 class='text-danger' >Cart is empty</h2>
                </div>
                <div class='card-body'>
                      <div class='table-responsive'>
                         <table class='table table-bordered m-0'>
                            <thead>
                               <tr>
                                  <th class='text-center py-3 px-4' style='min-width: 400px;'>Product Name &amp; Details</th>
                                  <th class='text-right py-3 px-4' style='width: 100px;'>Price</th>
                                  <th class='text-center py-3 px-4' style='width: 120px;'>Quantity</th>
                                  <th class='text-right py-3 px-4' style='width: 100px;'>Total</th>
                                  <th class='text-center align-middle py-3 px-0' style='width: 40px;'><a href='#' class='shop-tooltip float-none text-light' title data-original-title='Clear cart'><i class='ino ion-md-trash'></i></a></th>
                               </tr>
                            </thead>
                <tbody>
                <!-- data of product -->
                            
                <tr>
                <td class='p-4'>
                <div class='media align-items-center'>
                <img src='' class='d-block ui-w-40 ui-bordered mr-4' alt>
                <div class='media-body'>
                
                <p class='d-block text-dark'></p>
                <td class='text-right font-weight-semibold align-middle p-4'></td>
                <td class='align-middle p-4'><input type='text' class='form-control text-center' name='item_quantity[]' value =' '></td>
                <td class='text-right font-weight-semibold align-middle p-4'>  </td>
                <td class='text-center align-middle px-0'>
                <form method='post'>
                    <input type='hidden' name='remove_item_id' value=''>
                    <button type='submit' name='' class='shop-tooltip close float-none text-danger' title data-original-title='Remove'>×</button>
                </form>
            </td>
                </tr>
            </tbody>
          </table>
       </div>
       <div class='d-flex flex-wrap justify-content-between align-items-center pb-4'>
          <div class='mt-4'>
             <label class='text-muted font-weight-normal'>Promocode</label>
             <input type='text' placeholder='ABC' class='form-control'>
          </div>
          <div class='d-flex'>
             <div class='text-right mt-4 mr-5'>
                <label class='text-muted font-weight-normal m-0'>Discount</label>
                <div class='text-large'><strong>$0</strong></div>
             </div>
             <div class='text-right mt-4'>
                <label class='text-muted font-weight-normal m-0'>Total price</label>
                <div class='text-large'><strong>0</strong></div>
             </div>
          </div>
       </div>
       <div class='float-right'>
            <a href='index.php'><button type='button' class='btn btn-lg btn-default md-btn-flat mt-2 '>Back to shopping</button></a>
            
        </div>
      </div>
   </div>
</div>
            ";

            }
            
          
                ?>
                
</form>
    </section>
     

    <!-- footer section -->
    
    
    <!-- footer section ends -->
    
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/784fd7c1bd.js" crossorigin="anonymous"></script>
</body>
</html>

