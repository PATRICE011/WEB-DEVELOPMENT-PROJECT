<?php 
    include("../include/connect.php");
    // common functions
    //include("../functions/myfunctions.php");
    // @session_start();
    // $user_id = getUserIdFromSession() ;
    global $con;
?>

   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view products</title>
    <style>
    .custom-table {
        margin-top: 100px;
        border: 1px solid #ccc;
        margin-left: 100px;
    }
    .custom-table th,
    .custom-table td {
        text-align: center;
        border: 1px solid #ddd; /* Add this line to set borders between cells */
    }
    .custom-table th:last-child,
    .custom-table td:last-child {
        border-right: none;
    }
    .custom-table tbody tr {
        border-bottom: 1px solid #ddd;
    }
    .custom-table tbody tr:last-child {
        border-bottom: none;
    }
    tbody img{
        width: 40px;
        height: 40px;
    }
    @media (max-width: 767px){
        .custom-table{
            margin-left: auto;
        }
    }
</style>
</head>
<body>
<div class="container">
        <table class="table custom-table">
            <thead class="thead-dark">
                <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>Name</th>
                    <th class='text-center'>Image</th>
                    <th class='text-center'>Price</th>
                    <th class='text-center'>Total Sold</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_products = "SELECT * FROM `products`";
                    $result = mysqli_query($con, $get_products);

                    while($row = mysqli_fetch_assoc($result)){
                        $prod_id = $row['product_id'];
                        $prod_name = $row['product_title'];
                        $prod_price = $row['product_price'];
                        $prod_image = $row['product_image'];

                        // get total sold of each product
                        $get_total_sold = "SELECT SUM(quantity) AS total_sold FROM `total_product_sold` WHERE product_id = $prod_id";
                        $result_total_sold = mysqli_query($con, $get_total_sold);
                        $total_sold_row = mysqli_fetch_assoc($result_total_sold);
                        $total_sold = $total_sold_row['total_sold'];

                        echo"
                        <tr>
                            <td class='text-center'>$prod_id</td>
                            <td class='text-center'>$prod_name</td>
                            <td class='text-center'><img src='product_images/$prod_image' alt='$prod_name'></td>
                            <td class='text-center'>$prod_price</td>
                            <td class='text-center'>$total_sold</td>
                        </tr>";
                    }
                ?>
                
            </tbody>
        </table>
       
    </div>
</body>
</html>

