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
        border: 1px solid #ddd; S
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
            margin-left: auto ;
            
            
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
                    <th class='text-center'>Image</th>
                    <th class='text-center'>Name</th>
                    <th class='text-center'>Username</th>
                    <th class='text-center'>Email</th>
                    <th class='text-center'>Home Address</th>
                    <th class='text-center'>Mobile Number</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_users = "SELECT * FROM `user_table`";
                    $result = mysqli_query($con, $get_users);
                    $increment = 1;
                    while($row = mysqli_fetch_assoc($result)){
                        $image = $row['user_image'];
                        $fname = $row['user_fname'];
                        $lname = $row['user_lname'];
                        $username = $row['user_name'];
                        $email = $row['user_email'];
                        $address = $row['user_address'];
                        $number = $row['user_number'];

                        echo"
                        <tr>
                            <td class='text-center'>$increment</td>
                            <td class='text-center'><img src='../users_area/user_images/$image' alt='person'></td>
                            <td class='text-center'>$fname $lname</td>
                            <td class='text-center'>$username</td>
                            <td class='text-center'>$email</td>
                            <td class='text-center'>$address</td>
                            <td class='text-center'>$number</td>
                        </tr>";
                        $increment ++;
                    }
                ?>
                
            </tbody>
        </table>
       
    </div>
</body>
</html>

