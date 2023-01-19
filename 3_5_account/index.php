<?php
    session_start();
    ini_set("display_errors", 0);
    error_reporting(~E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>
<body>
    <?php 
        include("navbar.php");
    ?>
    <div class="mainWrapper">
        <h1>Welocome to my page</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum recusandae, voluptate repellendus minus beatae ipsum quibusdam facere explicabo id vero quam animi qui cum, adipisci laborum tenetur debitis nam consequuntur!</p>
    </div>
</body>
</html>




