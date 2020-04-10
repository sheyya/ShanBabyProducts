<?php
require 'connection.php';

if (isset($_POST["create"])) {
    $fname = $_POST["txtfName"];
    $lname = $_POST["txtlName"];
    $phone = $_POST["txtPhone"];
    $email = $_POST["txtEmail"];
    $address = $_POST["txtAddress"];
    $city = $_POST["txtCity"];
    $pw = $_POST["txtPassword"];
    $postal = $_POST["txtPostal"];
    $country = $_POST["txtCountry"];
    $pw = $_POST["txtPassword"];




    $sql = "INSERT INTO `customer` (`firstName`, `lastName`, `email`, `address`, `country`, `postalCode`, `phone`, `password`, `city`) VALUES ('" . $fname . "', '" . $lname . "', '" . $email . "', '" . $address . "', '" . $country . "', '" . $postal . "', '" . $phone . "', '" . $pw . "', '" . $city . "');";

    mysqli_query($conn, $sql);
    
    header('Location:login.php');
}
