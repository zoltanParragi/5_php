<?php
#5
session_start();
ini_set("error_reporting", 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include('config.php');
#3
//exits if $_SERVER["REQUEST_METHOD"] is not GET / POST / etc.:
/* if($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(403);
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
    $email = mysqli_real_escape_string($connection, $email);
    $name = mysqli_real_escape_string($connection, $name);

    $token = md5(rand(111111, 999999).time());
    
    //while() {} token összehasonlítása az adatbáziban taláhatókkal, út token generálás az egyediségig 

    //http://localhost/full-stack-course/5_php/3_5_account/activate.php?token=$token
    
    mysqli_query($connection, "insert into users (name, email, password, verification_token) values('$name', '$email', '$password', '$token')");

    //-- sending email ---
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = SMTP_USERNAME;                     //SMTP username
        $mail->Password   = SMTP_PASSWORD;                               //SMTP password
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('info@zoltan.com', 'Feladó: Zoltán');
        $mail->addAddress($email, $name);     //Add a recipient
        /* $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Regisztráció visszaigazolás';
        $mail->Body    = nl2br("Kedves $name!

        ".date('Y.m.d , H:i:s')."-kor, a(z) ".$_SERVER["REMOTE_ADDR"]." IP címről ezzel az email címmel regisztráltak.

        Ha te voltál kattints az alábbi linkre:
        http://localhost/full-stack-course/5_php/3_5_account/activate.php?token=$token
        
        
        Üdvözlettel
        
        Buga Jakab");
        // http://".$_SERVER["HTTP_HOST"]."/".$_SERVER[....].....

        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //-- sending email end ---

    if($err = mysqli_error($connection)){
        exit($err);
    }

    $_SESSION["flash"]["msg"] = ['value' => ['Successful registration. :)'], 'type' => 'successmsg'];
}

header("location: ". $_SERVER["HTTP_REFERER"]);
