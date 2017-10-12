<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$Caption = $_GET['Caption'];
$Text    = $_GET['Text'];

echo update_Post($Caption, $Text);
//This function updates the company's miniblog
function update_Post($Caption, $Text)
{  
    $SQL          = "CALL update_company_post('" . $Caption . "', '" . $Text . "','" . $_SESSION['id'] . "')";
    $message_data = "SQL-ERROR AT controlpanel/ajax/update_Post.php FUNCTION update_Post($Caption, $Text)";
    
    list($num_rows, $result) = opendb($message_data, $SQL);
    
    if (!$result or $num_rows == 0) {
        
        return '{"status": "Error"}';
    }
    
    return '{"status": "OK"}';
    
}