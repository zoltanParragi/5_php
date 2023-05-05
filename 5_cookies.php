<?php
    $cookie_name = "user";
    $cookie_value = "Mr X";
    setcookie($cookie_name, $cookie_value, time() + (86400*30), "/" );

    $cookie_value2 = "Mrs Y";
    setcookie($cookie_name, $cookie_value2, time() + (86400*30), "/" );

    setcookie("test", "test", time() + 3600, "/");

    //To delete a cookie:
    //setcookie("user", null, time()-3600, "/");
    //OR: setcookie("user", null, -1, "/");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>
<body>
    <?php 
        if(!isset($_COOKIE[$cookie_name])) {
            print "Cookie named '" . $cookie_name . "' is not set.";
        } else {
            print " Cookie '" . $cookie_name . "' is set. " ;
            print "The value is '" . $_COOKIE[$cookie_name] . "'."; 
        }
    ?>
    <h1>Cookies</h1>

    <h2>What is a cookie?</h2>
    <p>A cookie is a small file that the server embeds on the user's computer. Each time the same computer requests a page with a browser, it will send the cookie too. Often used to identify a user.</p>

    <h2>Create cookie</h2>
    <p>setcookie(name, value, expire, path, domain, secure, httponly);</p>
    <p>The value of the cookie is automatically URLencoded when sending the cookie, and automatically decoded when received (to prevent URLencoding, use setrawcookie() instead).</p>

    <h2>Modify a Cookie Value</h2>
    <p>To modify a cookie, just set (again) the cookie using the setcookie() function.</p>

    <h2>Delete a Cookie Value</h2>
    <p>To delete a cookie, use the setcookie() function with an expiration date in the past.</p>

    <h2>Check if Cookies are Enabled</h2>
    <p>A small script that checks whether cookies are enabled. First, try to create a test cookie with the setcookie() function, then count the $_COOKIE array variable.</p>

    <?php 
        if(count($_COOKIE) > 0) {
            print "Cookies are enabled.";
          } else {
            print "Cookies are disabled.";
          }
    ?>

</body>
</html>