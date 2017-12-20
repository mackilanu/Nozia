<?php
function uploadfile($target, $file){
        if(isset($_FILES[$file])){
            
            //All info som behövs om filen
        	$File = $_FILES[$file];

        	$File_name = $File['name'];
        	$File_tmp  = $File['tmp_name'];
        	$File_size = $File['size'];
        	$File_error = $File['error'];

        	$File_ext = explode('.', $File_name);
        	$File_ext = strtolower(end($File_ext));
        	print_r($file_ext);

        	$allowed = array('jpg','jpeg', 'png', 'pdf');

        	if(in_array($File_ext, $allowed)){
        		if($File_error === 0){

        			if($File_size <= 5242880){

        			//Krypterar filnamnet
        			 $File_name_new    = uniqid('', true) . '.' . $File_ext;
        			 //Filens destination, $target = parametern i funktionen.
        			 $File_destination = $target . $File_name_new;

        		     if(move_uploaded_file($File_tmp, $File_destination)){

        			 	return $File_name_new;
        			 }else{
        			  return "Error";
        			 }
        			 
        			}else{
        				return "ToBig";
        			}
        		}else{
        			return "Error";
        		}
        	}else{
        		  
        	}


        }else{
           return "NoExists";
        }
}

