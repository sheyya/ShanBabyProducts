<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shan Baby Products</title>
  <link href="../source/css/style.css" rel="stylesheet" type="text/css" />

  <link href="../source/css/imgSlider.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php require 'header.php' ?>
  <?php require 'navbar.php' ?>
  <div id="slider">
    <figure>
      <img src="../source/images/slide1.png">
      <img src="../source/images/slide2.png">
      <img src="../source/images/slide3.png">
      <img src="../source/images/slide4.png">
      <img src="../source/images/slide5.png">
    </figure>
  </div>
</body>

</html>