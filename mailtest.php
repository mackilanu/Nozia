<?php

require_once("includes/config.php");
require_once("MySQL/DBconnect.php");
require_once("includes/error_log.php");
require_once("MySQL/epostsender.php");

$epost = send_epost("mackilanu@gmail.com", "test", "Tjena!");


echo $epost;