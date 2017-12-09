<?php

//Establishes a connection to the database
function opendb($message_data, $SQL){

    $mysqli       = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);

    //Open database
    if (mysqli_connect_errno()){
        $message_data .= mysqli_connect_error();
       // send_epost(FROM, TO, "ERROR vid opendb.php function opendb", $message_data);
       echo $message_data;
        return false;
        }

    //Chance character set to utf8
    if (!$mysqli->set_charset("utf8")){ // Chance character set to utf8
        $message_data .= $mysqli->error;
    }

    //Execute database-query
    $affected_rows = 0;

    if ($result = $mysqli->query($SQL)){
        $affected_rows = $mysqli->affected_rows;
      
 
        $mysqli->close();

        //Returerar antalet påverkade rader i tabellen och resultatet på parametern $SQL
        return array($affected_rows,$result);
    }
    //ERROR on query
    $message_data .= "\n".$SQL."\n".$mysqli->error;

   write_error($message_data);


    $mysqli->close();

    return FALSE;
}

function clearStoredResults($mysqli_link){
    while($mysqli_link->next_result()){
        if($l_result = $mysqli_link->store_result()){
            $l_result->free();
        }
    }
}

?>