
<?php
require_once("../MySQL/DBconnect.php");

list($num_rows, $res) = opendb("","CALL read_categories()");


$CS = $_GET['CS'];

if($CS == ""){
  $CS = $_SESSION['citystate'];
}

//Ifall det inte går att ansluta
if(!$res){
    echo "Ett allvarligt fel har inträffat med Databasen. Kontakta Webmaster.";
}
   if($num_rows != 0)
   {
   echo "Totalt ". $num_rows. " kategorier.";
     //För varje rad i tabellen skrivs den ut på sidan
     while($rows = $res->fetch_assoc()){
        

         echo <<<CATEGORY

          <div class="col-lg-4 col-sm-4 col-xs-4 text-center">
                <div class="square circle-format">
                <a href="../companies?category=$rows[Caption]&id=$rows[CatgoryID]&CS=$CS">
                <input type="hidden" id="company" value="$rows[Caption]" >
                   <img src="images/$rows[URL]" class="img-responsive circle-format" style="margin-bottom: 5px;" alt="Company Profile Picture"></a>
                    
                </div>

               <a class="company-name "href="../companies?category=$rows[Caption]&id=$rows[CatgoryID]&CS=$CS"> $rows[Caption]</a>
              <br>
              
                
            </div>



CATEGORY;

     }
    
     
    }

