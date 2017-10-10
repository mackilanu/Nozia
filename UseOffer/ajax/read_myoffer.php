
<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

require_once ("../../MySQL/DBconnect.php");

$Offer = $_GET['Offer'];
$User  = $_SESSION['id'];
echo MyOffer($User, $Offer);

function MyOffer($User, $Offer)
{
    $SQL = "CALL read_MyOffer('" . $User . "', '" . $Offer . "')";

    // $SQL = "CALL read_Companies()";

    $message = "SQL ERROR AT Company/index.php FUNCTION Offer('" . $_SESSION['id'] . "','" . $_GET['Offer'] . "')";
    list($affected_rows, $result) = opendb($message, $SQL);
    if ($affected_rows == 0) {
        return '{"status": "NoOffers"}';
    }

    if (!$result) {
        return '{"status": "Error"}';
    }

    $Company = '{"status": "OK", "offer": [';
    for ($i = 0; $i < $affected_rows; ++$i) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($i > 0) {
            $Company.= ',';
        }

        $Company.= json_encode($row);
    }

    $Company.= ']}';
    return $Company;
}

?>