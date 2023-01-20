<?php
session_start();
ini_set("error_reporting", 1);

if(!isset($_SESSION["user"])) {
    $_SESSION["flash"]["msg"] = ['value' => ['Az oldal megtekintéséhez belépés szükséges.'], 'type' => 'errormsg'];
    header("location: login.php");
    //http_response_code(403);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Feladatok</title>
</head>
<body> 
    <?php 
        include("navbar.php");
    ?>
    
    <div class="mainWrapper">
        <h1>Oldd meg a következő feladatokat!</h1>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio iste aliquam doloremque, similique dolor magnam sequi consequatur iure consectetur mollitia, placeat aspernatur libero veniam sapiente architecto minima nobis ducimus quam!</p>
    </div>
</body>
</html>