<?php
    session_start(); // $_SESSION is created
    // the content of $_SESSION is stored on the server in the 'temp' folder with 'sess_...id...' name
    $_SESSION["adatok"] = range(1, 10);
    
    $_SESSION["user"] = ["name"=>"Mr X", "email"=>"qw@qwe.hu", "something"=>"anything"];
    //phpinfo();
    print_r($_SESSION["adatok"]["3"]);

    //unset($_SESSION["user"]); no user data in $_SESSION

    /* 
        session_unset(); 
        
        Frees every variable in $_SESSION. Returns true on success or false on failure.
        The use of session_unset() is identical to $_SESSION = []

        session_unset just clears out the session for usage. The session is still on the users computer. Note that by using session_unset, the variable still exists. session_unset just remove all session variables. it does not destroy the session....so the session would still be active.


        unset($_SESSION["adatok"]) 
        deletes the $_SESSION["adatok"]


        session_destroy();
        Destroys all data registered to a session.

        Returns true on success or false on failure.

        destroys all of the data associated with the current session. It does not unset any of the global variables associated with the session, or unset the session cookie. To use the session variables again, session_start() has to be called.

        FURTHER NOTES
        #1 In order to kill the session altogether, the session ID must also be unset. If a cookie is used to propagate the session ID (default behavior), then the session cookie must be deleted. setcookie() may be used for that.

        #2 Using session_unset in tandem with session_destroy however, is a much more effective means of actually clearing out data. As stated in the example above, this works very well, cross browser. session_destroy is destroy the session. session_destroy() to kill all session information.....This is the more secure function to use.
        
        #3 I was having a problem clearing all session variables, deleting the session, and creating a new session without leaving old session stuff behind in all browsers.  The below code is perfect for a logout script to totally delete everything and start new.  It even works in Chrome which seems to not work as other browsers when trying do logout and start a new session.
            <?php
                session_start();
                session_unset();
                session_destroy();
                session_write_close();
                setcookie(session_name(),'',0,'/');
                session_regenerate_id(true);
            ?>
    */

?>
<h1>Page 1</h1>
<a href="page2.php">page 2 >>></a>