<?php
//Hämtar kommunerna.
session_start();
require_once("../MySQL/DBconnect.php");

 $result = opendb("", "CALL read_CS()");
 $CS = $_SESSION['citystate'];               


                 
     //Fetchar raderna i CS
 echo "<option class='optionPlaceholder' style='color: red;' disabled selected>Kommun</option>";
    while($rows = $result[1]->fetch_assoc()){

    	if($rows['ID'] == $CS && $_GET['CS'] == $CS){
    		echo "<option value='$rows[ID]' selected>$rows[CityState]</option>";
    	}
    	if($rows['ID'] == $_GET['CS']){
            echo "<option value='$rows[ID]' selected>$rows[CityState]</option>";

    	}
    	else{
 
    	echo "<option value='$rows[ID]'>$rows[CityState]</option>";
}
    }