<?php
    include("../include/connect.php");
    // common functions
    include("../functions/myfunctions.php");
    @session_start();
    $user_id = getUserIdFromSession() ;
    global $con;

    $total_price = 0;
    $cart_query = "SELECT * FROM `cart-details` WHERE user_id = '$user_id'";
    $cart_result = mysqli_query($con, $cart_query);
    // generate invoice number
    $invoice_number = mt_rand();
    //echo $invoice_number;
    $status = 'paid';
    
    $count_products = mysqli_num_rows($cart_result);
    while($row = mysqli_fetch_array($cart_result)){
        $product_id = $row ["product_id"];
        $select_product = "SELECT * FROM `products` WHERE product_id = '$product_id'";
        // get quantity
         $get_quanity =  getProductQuantity($product_id, $con);
        $product_result = mysqli_query($con, $select_product);
        while($row_product = mysqli_fetch_array($product_result)){
            $product = array ($row_product ["product_price"]);
            $product_price = array_sum ( $product);
            $item_total = $product_price * $get_quanity;
            $total_price +=$item_total;
        }
    }
    // sub total
    

    // insert data to database
    $insert_order = "INSERT INTO `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) 
    VALUES ($user_id,$total_price,$invoice_number,$count_products,NOW(),'$status')";
    $result_query = mysqli_query($con, $insert_order);
    if($result_query){
        echo"<script>alert('orders placed')</script>";
        // profile.php
        
        $order_id = mysqli_insert_id($con);
        
        $cart_result = mysqli_query($con, $cart_query);
        while ($row = mysqli_fetch_array($cart_result)) {
            $product_id = $row["product_id"];
            $quantity = getProductQuantity($product_id, $con);

            // Insert product quantity into the order_details table
            $insert_order_details = "INSERT INTO `total_product_sold` (product_id, quantity) 
                                    VALUES ($product_id, $quantity)";
            mysqli_query($con, $insert_order_details);
        }
        // delete cart after order confirmed
        $remove_query = "DELETE  FROM `cart-details` WHERE user_id ='$user_id' ";
        mysqli_query($con, $remove_query);
        echo "<script>window.open('../mycart.php','_self')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>