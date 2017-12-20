<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");
require_once ("../../MySQL/DBconnect.php");
require_once ("../../MySQL/epostsender.php");

$email = $_GET['Email'];
$str = random_str(128);
echo checkEmail($email, $str);

// This function checks if the input email exists in the database

function checkEmail($email, $str)
{
    $message_data = "SQL-ERROR AT register/ajax/resetPw.php function checkEmail($email, $str)";
    list($num_rows, $result) = opendb("", "CALL read_email('$email')");
    if ($num_rows == 0 or !$result) {
        return '{"status": "Error"}';
    }

    $arr = $result->fetch_assoc();
    $ID = $arr['ID'];

    // Insert reset string in database.

    $message_data = "SQL-ERROR AT register/ajax/resetPw.php function checkEmail($str, $ID)";
    list($num_rows, $result) = opendb("", "CALL update_resetPw('" . $str . "','" . $ID . "')");
    if ($num_rows == 0 or !$result) {
        return '{"status": "InsertError"}';
    }

    send_epost($email, "Återställning av lösenord", "<h1>Hej!</h1><br /> <p>På din begäran har vi återställt ditt lösenord. Vänligen följ 
        länken nedan för att ange ett nytt lösenord. <br /><br /> <a href='nozia.se/resetpw/?str=" . $str . "'>Återställ ditt lösenord här.</a></p><br /><p><b>Mvh,<br />Team Nozia.</b></p>");
    return '{"status": "Sent"}';
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str.= $keyspace[random_int(0, $max) ];
    }

    return $str;
}
