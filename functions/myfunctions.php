<?php 
    @session_start();
    
    // cart
    function mycart(){
        
        if (isset($_GET['add_to_cart'])){
            global $user_id;
            global $con;
          
            $get_prod_id = $_GET['add_to_cart'];
            
            $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' AND product_id='$get_prod_id'";
            $result = mysqli_query($con,$select_query);
            $row = mysqli_num_rows($result);
            if($row>0){
                echo "<script>alert('Item already present inside cart') </script>";
                echo "<script>window.open('index.php','_Self') </script>";
            }else{
                
                $insert_query="INSERT INTO `cart-details` (product_id,user_id,quantity) VALUES ('$get_prod_id','$user_id',0)";
                $result = mysqli_query($con,$insert_query);
                // echo "<script>alert('Item added inside cart') </script>";
                echo "<script>window.open('index.php','_Self') </script>";
            }
            

        }
    }
    // get numbers in cart
    function getcartnumbers(){
        if (isset($_GET['add_to_cart'])){
            global $con;
            global $user_id;
            
            $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' ";
            $result = mysqli_query($con,$select_query);
            $count_numbers = mysqli_num_rows($result);
        }else{
            global $con;
            global $user_id;
           
            $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' ";
            $result = mysqli_query($con,$select_query);
            $count_numbers = mysqli_num_rows($result);
        }
        echo $count_numbers;
    }
    // total price
    function total_price(){
        global $con;
        global $user_id;
        
        $total = 0;
        
        $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' ";
        $result = mysqli_query($con,$select_query);
        while($row = mysqli_fetch_array($result)){
            $product_id=$row['product_id'];
            $select_products="SELECT * FROM `products` WHERE product_id ='$product_id' ";
            $result_products = mysqli_query($con,$select_products);
            while($row_products_price = mysqli_fetch_array($result_products)){
                $product_price=array($row_products_price['product_price']);
                $product_values=array_sum($product_price);
                $total+=$product_values;
            }
        }
        echo $total;
    }
    // fetch item quantity alone
    function getProductQuantity($productId, $con)
    {
        if(!isset($_SESSION['user_id'])){
            
            //echo"<script>alert('no users found')</script>";
        }else{
            $user_id =$_SESSION['user_id'];
            $productId = (int)$productId; 

            $query = "SELECT quantity FROM `cart-details` WHERE product_id = '$productId' AND user_id=$user_id";
            $result = mysqli_query($con, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                return $row['quantity'];
            } else {
                
                return 0;
            }
          }
        
    }
   
    //session user id
    function getUserIdFromSession() {
       
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            return null; 
        }
    }

    function checkadmin(){
        if(!isset($_SESSION['username'])){
            echo "<script>window.open('admin_login.php','_self')</script>";
        }else{
            return;
        }
    }
?>