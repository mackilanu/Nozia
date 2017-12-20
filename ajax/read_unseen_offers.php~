<?php
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once("../includes/config.php");
require_once("../MySQL/DBconnect.php");
$user_id = $_SESSION['id'];

echo read_unseen_offers($user_id);
function read_unseen_offers($user_id)
{
    

    $favs = get_favs($user_id);


    $offers = get_offers();

    $fav_offers = array();

    for($i = 0; $i < count($offers); $i++){
        for($y = 0; $y < count($favs); $y++){

            if($offers[$i]['CompanyID'] == $favs[$y][2]){
                $fav_offers[] = $offers[$i];
            }
        }
    }


    $myoffers = read_MyOffers($user_id);
    $unseen = array();
    for($i = 0; $i < count($fav_offers); $i++){
        for($y = 0; $y < count($myoffers); $y++){

            if($myoffers[$y]['Seen'] == 0 and $myoffers[$y]['Offer'] == $fav_offers[$i]['ID']){
                $unseen[] = $fav_offers[$i];
            }
        }
    }

    return json_encode($unseen);
}

function get_favs($User)
{
    $SQL     = "CALL read_favs('". $User ."')";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if($num_rows == 0)
        return '{"status": "NoSubs"}';
    if(!$result)
        return '{"status": "Error"}';

    $arr = array();
    while($row = $result->fetch_row()){

        $arr[] = $row;
    }

    return $arr;
   
}

function read_MyOffers($id){

    $SQL = "CALL read_MyOffer_user('". $id ."')";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";
    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result or $num_rows == 0)
        return '{"status": "Error"}';

    $arr = array();

    while($row = $result->fetch_assoc()){
        $arr[] = $row;

    }

    return $arr;

}

function get_offers()
{
    $SQL     = "CALL read_AllOffers()";
    $message = "SQL ERROR AT /kategorier/ajax/favourite.php";

    list($num_rows, $result) = opendb($message, $SQL);

    if(!$result or $num_rows == 0)
        return '{"status": "Error"}';

    $arr = array();

    while($row = $result->fetch_assoc()){

        $arr[] = $row;
    }

    return $arr;


}

