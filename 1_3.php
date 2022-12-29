<?php
/* 
    Open a terminal to the actual php file's folder. 
    Type in the terminal the next command: php 1_3.php
                                                ^php file name
    The php file will be executed and the result (print) will be shown in the terminal.
*/

$a = 10.54;
print gettype($a);
$b = 28;
//settype mtates, return value is boolean
settype($b, 'string');

print getType($b);
//  Variable names are case sensitive.
// Function names are NOT case sensitive.