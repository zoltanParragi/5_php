<?php
session_start();
ini_set("error_reporting", 1);

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

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email validation error<br>";
}

if(count($errors) > 0){
    $_SESSION["flash"]["post"] = $post;
    $_SESSION["flash"]["msg"] = ['value' => $errors, 'type' => 'errormsg'];
} else {
    $password = mysqli_real_escape_string($connection, $password);
    $email = mysqli_real_escape_string($connection, $email);

    $user_in_db_row = mysqli_query($connection, "select * from users where email = '$email' ");

    if( mysqli_num_rows($user_in_db_row) === 1 ) {
        $user_in_db = mysqli_fetch_assoc($user_in_db_row);
        $user_password_in_db = $user_in_db["password"];
        
        if( !password_verify( $password , $user_password_in_db )) {
            $_SESSION["flash"]["post"] = $post;
            $_SESSION["flash"]["msg"] = ['value' => ['Hibás belépési adatok.'], 'type' => 'errormsg'];
        } else {
            $_SESSION["flash"]["msg"] = ['value' => ['Sikeres belépés.'], 'type' => 'successmsg'];
            $_SESSION["user"] = $user_in_db;
            header("location: index.php");
            exit; // OR return;
        }
    }
}

header("location: ". $_SERVER["HTTP_REFERER"]);
