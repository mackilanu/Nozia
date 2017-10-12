<?php	
    
    function msg($message, $type){

    if($type == "danger"){
     echo "<div  class='alert alert-danger ' style='text-align: left' id='success_alert'>$message</div>";
    }

    if($type == "success"){
    	echo "<div  class='alert alert-success' style='text-align: left' id='success_alert'>$message</div>";
    }
}
