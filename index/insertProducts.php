<?php session_start();
require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="../source/css/navbar.css" rel="stylesheet" type="text/css" />
    <link href="../source/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../source/css/insertProduct.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="subheader">
                <div class="container">
                    <p>Admin Dashboard > Insert Prducts</p>
                    <?php
                    if (isset($_SESSION['adminsUsername'])) {
                        echo '<a href="logout.php">Logout</a>';
                        echo '<a href="dashboard.php">Dashboard</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="insertProduct">
        <div class="title">
            <h3>Insert Products</h3>
        </div>
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product Title</label>
                <input name="product_title" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Product Category</label>
                <select name="product_cat" class="form-control">

                    <option> Select a Category Product </option>

                    <?php

                    $get_p_cats = "select * from category";
                    $run_p_cats = mysqli_query($conn, $get_p_cats);

                    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                        $p_cat_id = $row_p_cats['categoryID'];
                        $p_cat_title = $row_p_cats['categoryName'];

                        echo "
                                  
                                  <option value='$p_cat_id'> $p_cat_title </option>
                                  
                                  ";
                    }

                    ?>

                </select>
            </div>
            <div class="form-group">
                <label>Product Quantity</label>
                <input name="product_qty" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input name="product_price" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Product Discount (%)</label>
                <input name="product_discount" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input name="product_img1" type="file" style="margin-left: -110px" required>
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea name="product_desc" cols="19" rows="6" class="form-control" style="height: 150px"></textarea>
            </div>
            <div class="form-group">
                <input name="submit" value="Insert Product" type="submit" class="btn">
            </div>
        </form>
    </div>


</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $product_discount = $_POST['product_discount'];
    $product_desc = $_POST['product_desc'];

    $product_img1 = $_FILES['product_img1']['name'];

    $temp_name1 = $_FILES['product_img1']['tmp_name'];

    move_uploaded_file($temp_name1, "../source/Images/product_images/$product_img1");

    $insert_product = "insert into product (productName,quantity,unitPrice,description,discount,imageLocation,categoryID,adminID) values ('$product_title','$product_qty','$product_price','$product_desc','$product_discount','$product_img1','$product_cat','1')";

    $run_product = mysqli_query($conn, $insert_product);

    if ($run_product) {

        echo "<script>alert('Product has been inserted sucessfully')</script>";
        echo "<script>window.open('insertProducts.php','_self')</script>";
    }
}

?>