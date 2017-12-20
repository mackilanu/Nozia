<?php
@session_start();

date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");

$ID = $_GET['ID'];

echo fetch_sponsors($ID);

function fetch_sponsors($ID)
{
    $SQL     = "CALL read_sponsors('". $ID ."')";
    $message = "SQL-ERROR AT controlpanel/ajax/get_files.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result)
        return '{"status": "Error"}';

    if($num_rows == 0)
        return '{"status": "NoSponsors"}';

    $Files = '{"status": "OK", "sponsors": [';
    for ($i = 0; $i < $num_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Files .= ',';
        }
        $Files .= json_encode($row);
    }
    $Files .= ']}';
    
    return $Files;   


}
?>
