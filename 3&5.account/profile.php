<?php
    session_start();

    if(!isset($_SESSION["user"])) {
        $_SESSION["flash"]["msg"] = ['value' => ['Az oldal megtekintéséhez belépés szükséges.'], 'type' => 'errormsg'];
        header("location: login.php");
        //http_response_code(403);
        exit;
    }

    ini_set("display_errors", 1);
    error_reporting(E_ALL);
    /* 
        ini_set("display_errors", 0);
        error_reporting(~E_ALL);
    */

    $connection = mysqli_connect("localhost", "root", "1234", "test");
    if($err = mysqli_connect_error()) {
        exit($err);
    }

    $user = mysqli_fetch_assoc(mysqli_query($connection, "select * from users where id = '".$_SESSION["user"]["id"]."'"));

    
    function getinput($key, $user) {
        if(isset($_SESSION["flash"]["post"][$key])){
            print($_SESSION["flash"]["post"][$key]??'');
        } else {
            print($user[$key]??'');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .errormsg, .successmsg{
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
        }
        .errormsg{
            background: rgba(255, 0, 0, 0.6);
            color: #fff;
        }
        .successmsg{
            background: green;
            color: #fff;
        }
    </style>
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
    <h1>Profilom</h1>
    <h4>Adatok módosítása</h4>
    <form action="server3.php" method="post">
        <label for="name">Név: </label>
        <input type="text" value="<?php getinput("name", $user) ?>" name="name" id="name" placeholder="Add meg a neved!">
        <!-- Muting warnings:
        #1 @       @print($_SESSION["post"]["name"])
        #2 ?? ''   print($_SESSION["post"]["name"])??''
        -->
        <br><br>
        <label for="name">Email: </label>
        <input type="text" value="<?php getinput("email", $user) ?>" name="email" id="email" placeholder="Add meg az email címed!">
        <br><br>
        <!-- <input type="password" name="password" placeholder="Add meg a jelszavad!">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Add meg a jelszavad mégegyszer!">
        <br><br> -->
        <button>Mentés</button>
    </form>
</body>
</html>
<?php unset($_SESSION["flash"]);?>