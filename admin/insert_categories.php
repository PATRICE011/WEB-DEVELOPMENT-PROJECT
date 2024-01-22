<?php 
    include("../include/connect.php");
    if(isset($_POST['insert_category_name'])){
        $cat_title = $_POST['category_name']; 
        // check duplicate
        $select_query = "Select * from `categories` where category_title= '$cat_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);
        if($number > 0){
            echo "<script>alert('this category is already existing')</script>";
        }else{
            // insert category
            $insert_query = "insert into `categories` (category_title) values ('$cat_title')";
            $result = mysqli_query($con, $insert_query);
            if($result){
                echo "<script>alert('inserted successfully')</script>";
            }
        }
        
    }
?>

<form action="" method="POST" class="insert-category">
    <div class="container-form">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
            <input class="form-control" type="text" name="category_name" id="category_name" placeholder="Insert Categories">
        </div>
        <button type="submit" name="insert_category_name" class="btn btn-custom">Insert</button>
    </div>
</form>
