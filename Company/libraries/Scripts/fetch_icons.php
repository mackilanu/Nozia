 <?php
session_start();
 $res = opendb("","CALL read_Foretagssida('$_SESSION[id]')");

 if($res != 0)
   {
     //För varje rad i tabellen skrivs den ut på sidan
     while($rows = $res[1]->fetch_assoc()){
        

         echo <<<CATEGORY

          <div class="col-lg-4 col-sm-4 col-xs-4 text-center">
                <div class="square circle-format">
                <a href="../companies?category=$rows[Caption]&id=$rows[CatgoryID]">
                <input type="hidden" id="company" value="$rows[Caption]" >
                   <img src="images/$rows[Icon]" class="img-responsive circle-format" style="margin-bottom: 5px;" alt="Company Profile Picture"></a>
                    
                </div>
              <br>
              
                
            </div>



CATEGORY;

     }
    
    ?>