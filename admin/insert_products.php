<?php 
    include("../include/connect.php");
    if(isset($_POST['insert_product'])){
        // assign data from input fields
        $prod_title = $_POST['product_name'];
        $prod_desc = $_POST['product_description'];
        $prod_keyword = $_POST['product_keyword'];
        $prod_cat = $_POST['product_category'];
        $prod_price = $_POST['product_price'];
        $product_status = 'true';
        // image
        $prod_image = $_FILES['product_image']['name'];
        // temporary image name
         $temp_image = $_FILES['product_image']['tmp_name'];
        //empty condition
        if($prod_title == '' or $prod_desc == '' or $prod_keyword == '' or $prod_cat == '' or
        $prod_price == '' or $prod_image == '' ){
            echo "<script>alert('Please fill all the empty fields') </script>";
            exit();
        }else{
            move_uploaded_file($temp_image,"./product_images/$prod_image");
            // insert query
            $insert_query = "insert into `products` (product_title,product_description,product_keywords,category_id,product_image,product_price,date,status) 
            values ('$prod_title','$prod_desc','$prod_keyword','$prod_cat','$prod_image','$prod_price',NOW(),'$product_status')";
            $result = mysqli_query($con, $insert_query);
            if($result){
                echo "<script>alert('inserted successfully')</script>";
            }
        }
    }
?>

<form action="" method="POST" enctype="multipart/form-data" class="product_form">
    <div class="container-form2">
        <div class="input-prod">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name" required="required" autocomplete="off">
        </div>
        <div class="input-prod">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product Description" required="required" autocomplete="off">
        </div>
        <div class="input-prod">
            <label for="product_keyword" class="form-label">Product Keywords</label>
            <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter Product Keywords" required="required" autocomplete="off">
        </div>
        <div class="input-prod">
            <select name="product_category" id="product_category" class="form-select form-control">
                <option value="">Select a Category</option>
                <?php 
                // Retrieve data from database
                $select_query="Select * from `categories`";
                $result_query = mysqli_query($con, $select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo"<option value='$category_id'>$category_title</option>";
                }    
                ?>
            </select>
        </div>
        <div class="input-prod">
            <label for="product_image" class="form-label">Upload Image</label>
            <input type="file" name="product_image" id="product_image" class="form-control-file" required="required">
        </div>
        <div class="input-prod">
            <label for="product_price" class="form-label">Product Price</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="0.00" required="required" autocomplete="off">
            </div>
        </div>
        <button type="submit" name="insert_product" class="btn btn-custom">Insert</button>
    </div>
</form>
