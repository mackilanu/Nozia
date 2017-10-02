<?php
function write_error($data){

    $now = new DateTime("now",new DateTimeZone('Europe/Stockholm'));
    $now = $now->format("Y-m-d H:i:s");

    $filedata=$now."\n".$data."\n\n";

    $ourFileHandle = fopen("/var/log/nozia.log",'at');
    if ($ourFileHandle){
        fwrite($ourFileHandle,$filedata);
        fclose($ourFileHandle);
    }
}





?>