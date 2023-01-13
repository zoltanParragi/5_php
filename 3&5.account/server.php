<?php
#5
session_start();

ini_set("error_reporting", 1);

#3
//exits if $_SERVER["REQUEST_METHOD"] is not GET / POST / etc.:
/* if($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(404);
    exit;
} */

// print $_REQUEST["name"]; A $_REQUEST egy asszociatív tömb, ami tartalmazza az elküldött adatokat.
// print $_POST["name"]; A $_POST egy asszociatív tömb, ami tartalmazza az elküldött adatokat.
// print_r($_POST); This command writes the $_POST in the document, so you can see the details.
//print_r($_REQUEST);

//!!!!! exit(print_r($_SERVER, 1));

$connection = mysqli_connect("localhost", "root", "1234", "test");
if($err = mysqli_connect_error()) {
    exit($err);
}

$post = $_POST;

extract($post); // extracting the elements of the $_POST as variables, eg.: $name will be = with the content of $_POST["name"]

// strlen(...) gives back the length of a string (assuming that every character takes 4 bits), BUT!!! some utf-8 characers takes 8 bits (eg.: the Hungarian é) so they would be counted as two characers

//mb_strlen(..., 'UTF-8') counts the characters properly
// trim() removes the white spaces from the beginning and end of a string

$errors = Array();

$length = mb_strlen(trim($name), 'UTF-8');
if($length < 4 or $length > 30) {
    $errors[] = "name length error<br>";
}

// filter_var() validating function, filter_var(..., FILTER_VALIDATE_EMAIL) email validating
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email validation error<br>";
} else {
    $result = mysqli_query($connection, "select id from users where email ='$email'");
    $found = mysqli_num_rows($result);
    if( $found ) {
        $errors[] = "Az email cím már foglalt.";
    }
}

$length = mb_strlen(trim($password), 'UTF-8');
if($length < 4 or $length > 20) {
    $errors[] = "password length error<br>";
} elseif($password !== $password_confirmation) {
    $errors[] = "password confirmation error<br>";
}

// $_SERVER("HTTP_REFERER") points to the referrer site, from where the request was launched
// goes back to the register.php: header("location: register.php");

if(count($errors) > 0){
    $_SESSION["flash"]["post"] = $post;
    $_SESSION["flash"]["msg"] = ['value' => $errors, 'type' => 'errormsg'];
} else {
    // data storing in the db
    $password = password_hash($password, PASSWORD_DEFAULT);
    // ???????????????????????????
    $email = mysqli_real_escape_string($connection, $email);
    $name = mysqli_real_escape_string($connection, $name);
    
    mysqli_query($connection, "insert into users (name, email, password) values('$name', '$email', '$password')");

    if($err = mysqli_error($connection)){
        exit($err);
    }

    $_SESSION["flash"]["msg"] = ['value' => ['Successful registration. :)'], 'type' => 'successmsg'];
}

header("location: ". $_SERVER["HTTP_REFERER"]);
