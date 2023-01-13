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
    <title>Profile</title>
</head>
<body>
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
    <h1>Profil</h1>
    <div>Azonosító: <?php print_r($_SESSION["user"]["id"]??'')?></div>
    <div>Név: <?php print_r($_SESSION["user"]["name"]??'')?></div>
    <div>Email: <?php print_r($_SESSION["user"]["email"]??'')?></div> 
</body>
</html>
<?php unset($_SESSION["flash"]);?>