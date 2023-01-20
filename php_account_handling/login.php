<?php
    session_start();

    ini_set("display_errors", 0);
    error_reporting(~E_ALL);
    /* 
        ini_set("display_errors", 1);
        error_reporting(E_ALL);
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>    
    <?php 
        include("navbar.php");
    ?>

    <?php
        if(isset($_SESSION["flash"]["msg"])){
    ?>
        <div class="<?php print $_SESSION["flash"]["msg"]["type"]?>">
            <?php 
                foreach($_SESSION["flash"]["msg"]["value"] as $value){
                    print "<li>$value</li>";
                }
            ?>
        </div>
    <?php
        }
    ?>

    
    <div class="mainWrapper">
        <h1>Belépés</h1>
        <form action="server2.php" method="post">
            <input type="text" value="<?php print($_SESSION["flash"]["post"]["email"]??'')?>" name="email" placeholder="Add meg az email címed!">
            <br><br>
            <input type="password" name="password" placeholder="Add meg a jelszavad!">
            <br><br>
            <button>Belépés</button>
        </form>
    </div>
</body>
</html>
<?php unset($_SESSION["flash"]);?>