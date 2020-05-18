
<?php

//---------Function to get products------------//

function getPro()
{


    require("connection.php");



    echo "<div class='Pcontainer'>
    <ul>
";



    $get_products = "select * from product order by 1 DESC LIMIT 0,8";

    $run_products = mysqli_query($conn, $get_products);

    while ($row_products = mysqli_fetch_array($run_products)) {

        $pro_id = $row_products['productID'];

        $pro_title = $row_products['productName'];

        $pro_price = $row_products['unitPrice'];

        $pro_img = $row_products['imageLocation'];

        echo "
    
    <li>
        
            <a href='productDetail.php?pro_id=$pro_id'>
            
                <img class='Pimg' src='../source/Images/product_images//$pro_img'>
            
            </a>
            
            <div class='text'>
            
                <h3>
        
                    <a class='Ptitle' href='productDetail.php?pro_id=$pro_id'>

                        $pro_title

                    </a>
                
                </h3>
                
                <p class='price'>
                
                RS: $pro_price
                
                </p>
                
                <p>
                
                    <a class='buttonD' href='productDetail.php?pro_id=$pro_id'>

                        View Details

                    </a>
                
                    <a  class='button' href='productDetail.php?add_cart=$pro_id'>

                         Add to Cart

                    </a>
                
                </p>
            
            </div>
        
        
    
    </li>
    
    ";
    }

    echo " </ul>
    </div>";
}

//---------Function to get categories------------//

function getCat()
{

    require("connection.php");
    $get_category = "select * from category";

    $run_category = mysqli_query($conn, $get_category);



    while ($row_category = mysqli_fetch_array($run_category)) {

        $cat_id = $row_category['categoryID'];

        $cat_title = $row_category['categoryName'];
        echo "
    
    <li>
         <a class='Ctitle' href='products.php?cat=$cat_id'>

            $cat_title

         </a>

    </li>
    
    ";
    }
}

//---------Function to get categories Products------------//


function getpcatpro()
{

    require("connection.php");
    if (isset($_GET['cat'])) {

        $p_cat_id = $_GET['cat'];

        $get_p_cat = "select * from category where categoryID='$p_cat_id'";

        $run_p_cat = mysqli_query($conn, $get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['categoryName'];

        $p_cat_desc = $row_p_cat['discription'];

        $get_products = "select * from product where categoryID='$p_cat_id'";

        $run_products = mysqli_query($conn, $get_products);

        $count = mysqli_num_rows($run_products);

        if ($count == 0) {

            echo "
            
                <div class='box'>
                
                    <h1> No Product Found In This Product Categories </h1>
                
                </div>
            
            ";
        } else {

            echo "
            
            <div class='box' style='padding:20px; margin-left:50px; margin-top:40px; margin-right:20px; border-radius:10px;   box-shadow: 5px 5px 7px #cbcecf, -5px -5px 7px #ffffff;'>
            
                
                    <h1> $p_cat_title </h1>
                    
                    <p> $p_cat_desc </p>
                
                </div>
            
            ";
        }

        echo "<div class='Pcontainer'>
        <ul>
    ";

        while ($row_products = mysqli_fetch_array($run_products)) {


            $pro_id = $row_products['productID'];

            $pro_title = $row_products['productName'];

            $pro_price = $row_products['unitPrice'];

            $pro_img = $row_products['imageLocation'];

            echo "
        
        <li>
            
                <a href='productDetail.php?pro_id=$pro_id'>
                
                    <img class='Pimg' src='../source/Images/product_images//$pro_img'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a class='Ptitle' href='productDetail.php?pro_id=$pro_id'>
    
                            $pro_title
    
                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $ $pro_price
                    
                    </p>
                    
                    <p>
                    
                        <a class='buttonD' href='productDetail.php?pro_id=$pro_id'>
    
                            View Details
    
                        </a>
                    
                        <a  class='button' href='productDetail.php?add_cart=$pro_id'>
    
                             Add to Cart
    
                        </a>
                    
                    </p>
                
                </div>
            
            
        
        </li>
        
        ";
        }

        echo " </ul>
    </div>";
    }
}



//---------Function to add Products to cart------------//

function add_card()
{
    require("connection.php");

    if (isset($_GET['add_cart'])) {
        if (isset($_SESSION['userEmail'])) {
            $userEmail = $_SESSION['userEmail'];
            $p_id = $_GET['add_cart'];

            $product_qty = $_POST['quantity'];

            if ($product_qty == 0) {
                $product_qty = 1;
            }

            $get_price = "select unitPrice from product where productID='$p_id'";

            $p_price = mysqli_query($conn, $get_price);

            $s_price = mysqli_fetch_array($p_price);

            $totalPrice = $product_qty * $s_price[0];

            $check_product = "select * from cart where userEmail='$userEmail' AND productID='$p_id'";

            $run_check = mysqli_query($conn, $check_product);



            if (mysqli_num_rows($run_check) > 0) {

                echo "<script>alert('This product has already added in cart')</script>";
                echo "<script>window.open('productDetail.php?pro_id=$p_id','_self')</script>";
            } else {

                $query = "insert into cart (userEmail,productID,numOfProducts,totalPrice) values ('$userEmail','$p_id','$product_qty','$totalPrice')";

                $run_query = mysqli_query($conn, $query);


                echo "<script>window.open('productDetail.php?pro_id=$p_id','_self')</script>";
            }
        } else {
            echo "<script>alert('You Have to login first')</script>";
            echo "<script>window.open('login.php','_self')</script>";
        }
    }
}
