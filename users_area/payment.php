
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="payment.css">
</head>
<body>

    <div class="checkout-container">
        <?php 
            include("../include/connect.php");
            // common functions
            include("../functions/myfunctions.php");
            @session_start();
            $user_id = getUserIdFromSession() ;
            global $con;

            // fetch user info
            $select_query = "SELECT * FROM `user_table` WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $select_query);
            $row_count = mysqli_num_rows($result);
            $row_data = mysqli_fetch_assoc($result);
            $fname = $row_data['user_fname'];
            $lname = $row_data['user_lname'];
            $phone = $row_data['user_number'];
            $home = $row_data['user_address'];
                
        ?>
        <h4>Delivery Address</h4>
        <p><?php echo "$fname $lname <br> $phone <br> $home"; ?></p>
        
        <hr>
        
        <h4>Item Description</h4>
        <div class="item-list">
            <?php
                $select_query = "SELECT * FROM `cart-details` WHERE user_id ='$user_id' ";
                $result = mysqli_query($con,$select_query);
                $result_count = mysqli_num_rows($result);
                // Loop through cart items and display them
                $total_price = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM `products` WHERE product_id ='$product_id' ";
                    $result_products = mysqli_query($con, $select_products);
                
                    // fetch item quantity
                    $quantity_item = getProductQuantity($product_id, $con);
                
                    // Loop through the products and display each item
                    if( $quantity_item == 0) {
                        // if product has no quantity it will automatically deleted
                        $remove_query = "DELETE  FROM `cart-details` WHERE user_id ='$user_id' AND product_id = $product_id";
                        mysqli_query($con, $remove_query);
                    }else{
                        while ($row_products_price = mysqli_fetch_array($result_products)) {
                            $product_price = $row_products_price['product_price'];
                            $product_name = $row_products_price['product_title'];
                            $product_image = $row_products_price['product_image'];
                    
                            $item_total = $product_price * $quantity_item;
                            $total_price += $item_total;
                    
                            echo "
                            <div class='item-row'>
                                <img class='item-image' src='../admin/product_images/$product_image' alt='Product Image'>
                                <div class='item-details'>
                                    <p>$product_name</p>
                                    <p>₱ $item_total</p>
                                    <p>Quantity: x$quantity_item</p>
                                </div>
                            </div>";
                        }
                    }
                    
                }
            ?>
        </div>
        
        <hr>
        
        <h4>Payment Options</h4>
        <div class="payment-options">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="paypalRadio">
                <label class="form-check-label" for="paypalRadio">
                    Paypal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="codRadio">
                <label class="form-check-label" for="codRadio">
                    Cash on Delivery
                </label>
            </div>
        </div>
        
        <hr>
        
        <h4 class="total-section">Total Payment</h4>
        <p>₱ <?php echo $total_price; ?></p>
        
        <a href="order.php?user_id=<?php echo $user_id ?>"><button class="btn btn-primary">Place Order</button></a>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
