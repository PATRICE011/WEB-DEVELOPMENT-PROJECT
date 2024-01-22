<?php 
    include("../include/connect.php");
    // common functions
    include("../functions/myfunctions.php");
    @session_start();
    $user_id = getUserIdFromSession() ;
    global $con;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Orders</title>
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
            right: 0; 
            left: auto !important;
        }
        .custom-table {
            margin-top: 150px;
            border: 1px solid #ccc;
        }
        .custom-table {
        margin-top: 150px;
        border: 1px solid #ccc;
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
                                    echo"<img src='user_images/$user_image' alt='Profile' class=''>";
                                }
                            ?>  
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <?php 
                                if(!isset($_SESSION['user_id'])){
                                    echo"<a class='dropdown-item' href='users_area/user_login.php'><i class='fas fa-sign-out-alt mr-2'></i>Log in</a>";
                                }else{
                                    echo"
                                        <a class='dropdown-item' href='#'><i class='fas fa-shopping-bag mr-2'></i>My Orders</a>
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

    <!-- table -->
    <div class="container">
        <table class="table custom-table">
            <thead class="thead-dark">
                <tr>
                    <th class='text-center'>#</th>
                    <th class='text-center'>Amount Due</th>
                    <th class='text-center'>Total Products</th>
                    <th class='text-center'>Invoice Number</th>
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Complete/Incomplete</th>
                    <th class='text-center'>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_orders = "SELECT * FROM `user_orders` WHERE user_id = '$user_id'";
                    $result = mysqli_query($con, $get_orders);
                    $increment = 1;
                    while($row = mysqli_fetch_assoc($result)){
                        $order_id = $row['order_id'];
                        $amount_due = $row['amount_due'];
                        $total_products = $row['total_products'];
                        $invoice_number = $row['invoice_number'];
                        $order_status = $row['order_status'];
                        $date = $row['order_date'];
                        
                        echo"
                        <tr>
                            <td class='text-center'>$increment</td>
                            <td class='text-center'>$amount_due</td>
                            <td class='text-center'>$total_products</td>
                            <td class='text-center'>$invoice_number</td>
                            <td class='text-center'>$date</td>
                            <td class='text-center'>Complete</td>
                            <td class='text-center'>$order_status</td>
                        </tr>";
                        $increment++;
                    }
                ?>
            </tbody>
        </table>
        <div class='float-right'>
            <a href='../index.php'><button type='button' class='btn btn-lg btn-default md-btn-flat mt-2 '>Back to shopping</button></a>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/784fd7c1bd.js" crossorigin="anonymous"></script>
</body>
</html>
