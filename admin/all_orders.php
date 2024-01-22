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
    <title>view all orders</title>
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
                    <th class='text-center'>#</th>
                    <th class='text-center'>Due Amount</th>
                    <th class='text-center'>Invoice Number</th>
                    <th class='text-center'>Product Type Quantity</th>
                    <th class='text-center'>Order Date</th>
                    <th class='text-center'>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_orders = "SELECT * FROM `user_orders`";
                    $result = mysqli_query($con, $get_orders);
                    $increment = 1;
                    while($row = mysqli_fetch_assoc($result)){
                        $amount = $row['amount_due'];
                        $number = $row['invoice_number'];
                        $total_products = $row['total_products'];
                        $date= $row['order_date'];

                        echo"
                        <tr>
                            <td class='text-center'>$increment</td>
                            <td class='text-center'> $amount</td>
                            <td class='text-center'>$number</td>
                            <td class='text-center'>$total_products</td>
                            <td class='text-center'>$date</td>
                            <td class='text-center'>complete</td>
                        </tr>";
                        $increment++;
                    }
                ?>
                
            </tbody>
        </table>
       
    </div>
</body>
</html>

