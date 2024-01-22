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
    <title>view categories</title>
    <style>
    .custom-table {
        margin-top: 100px;
        border: 1px solid #ccc;
        margin-left: 200px;
        margin-top: 150px;
        width: 45%;
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
            margin-left: 100px;
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
                    <th class='text-center'>Category Name</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_categories = "SELECT * FROM `categories` ";
                    $result = mysqli_query($con, $get_categories);
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['category_id'];
                        $cat_name = $row['category_title'];

                        echo"
                        <tr>
                            <td class='text-center '>$cat_id</td>
                            <td class='text-center '>$cat_name</td>
                        
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
       
    </div>
</body>
</html>

