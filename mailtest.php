<?php

require_once("includes/config.php");
require_once("MySQL/DBconnect.php");
require_once("includes/error_log.php");
require_once("MySQL/epostsender.php");


// if (!($smtp = fsockopen("smtp.gmail.com", 465, $errno, $errstr, 15))) {
//     die("Unable to connect");
// }
 $epost = send_epost("mackilanu@gmail.com", "test", "Tjena!");


 echo $epost;

