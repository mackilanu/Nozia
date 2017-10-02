<?php
function uploadfile($target){
        if(isset($_FILES['IconFile'])){
            
            //All info som behövs om filen
            $File = $_FILES['IconFile'];

            $File_name = $File['name'];
            $File_tmp  = $File['tmp_name'];
            $File_size = $File['size'];
            $File_error = $File['error'];

            $File_ext = explode('.', $File_name);
            $File_ext = strtolower(end($File_ext));
            print_r($file_ext);

            $allowed = array('jpg','jpeg', 'png');

            if(in_array($File_ext, $allowed)){
                if($File_error === 0){

                    if($File_size <= 5242880){

                    //Krypterar filnamnet
                     $File_name_new    = uniqid('', true) . '.' . $File_ext;
                     //Filens destination, $target = parametern i funktionen.
                     $File_destination = $target . $File_name_new;

                     if(move_uploaded_file($File_tmp, $File_destination)){
                        echo "Erbjudandet är nu tillagt.";

                        return $File_destination;
                     }else{
                        echo "It was an error when uploading the file, please try again.";
                     }
                     
                    }else{
                        echo "The file is too big!";
                    }
                }else{
                    echo "There was an error when uploding the file. Error code:" . $File_error;
                }
            }else{
                  
            }


        }else{
            echo "It didn't work";
        }
}

