<?php
    session_start(); // when session has started on page 1, it is used on page 2
    print_r($_SESSION["user"]);
?>
<h1>Page 2</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptate nulla animi iste dolores tenetur voluptatum, aspernatur perspiciatis mollitia illum. Repellendus distinctio amet voluptatibus itaque ut reiciendis, excepturi tenetur eligendi?</p>
<a href="page1.php">page 1 >>></a>