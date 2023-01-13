<?php
session_start();
ini_set("error_reporting", 1);

if(!isset($_SESSION["user"])) {
    $_SESSION["flash"]["msg"] = ['value' => ['Az oldal megtekintéséhez belépés szükséges.'], 'type' => 'errormsg'];
    header("location: login.php");
    //http_response_code(403);
    exit;
}

if($_SERVER["REQUEST_METHOD"] !== 'POST') {
    http_response_code(403);
    exit;
}

$connection = mysqli_connect("localhost", "root", "1234", "test");
if($err = mysqli_connect_error()) {
    exit($err);
}

$post = $_POST;

extract($post); 

$errors = Array();

$length = mb_strlen(trim($name), 'UTF-8');
if($length < 4 or $length > 30) {
    $errors[] = "name length error<br>";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email validation error<br>";
} else {
    $result = mysqli_query($connection, "select id from users where email ='$email' and id !='".$_SESSION["user"]["id"]."'");
    $found = mysqli_num_rows($result);
    if( $found ) {
        $errors[] = "Az email cím már foglalt.";
    }
}

/* $length = mb_strlen(trim($password), 'UTF-8');
if($length < 4 or $length > 20) {
    $errors[] = "password length error<br>";
} elseif($password !== $password_confirmation) {
    $errors[] = "password confirmation error<br>";
} */

if(count($errors) > 0){
    $_SESSION["flash"]["post"] = $post;
    $_SESSION["flash"]["msg"] = ['value' => $errors, 'type' => 'errormsg'];
} else {
    //$password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($connection, $email);
    $name = mysqli_real_escape_string($connection, $name);
    
    mysqli_query($connection, "update users set name='$name', email='$email' where id='".$_SESSION["user"]["id"]."' limit 1");

    if($err = mysqli_error($connection)){
        exit($err);
    }

    $_SESSION["flash"]["msg"] = ['value' => ['Successful update. :)'], 'type' => 'successmsg'];
}

header("location: ". $_SERVER["HTTP_REFERER"]);

