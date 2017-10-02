<?php
    require_once("../MySQL/DBconnect.php");
    require_once("../MySQL/epostsender.php");
  
    // Returns if the username is already in use or not
    function checkUser($username){
      $usernameAvailable;
      $checkUsername = opendb("", "CALL read_usernames('$username')");

      if($checkUsername[0] == 1 ){
          $usernameAvailable = True;
      }else{
          $usernameAvailable = False;
      }

      return $usernameAvailable;
    }

   function msg($message, $type){

    if($type == "danger"){
     echo "<div  class='alert alert-danger ' style='text-align: left' id='success_alert'>$message</div>";
    }

    if($type == "success"){
       echo "<div  class='alert alert-success' style='text-align: left' id='success_alert'>$message</div>";
    }
   }

   function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
   {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
   }

if ($_SERVER["REQUEST_METHOD"] == "POST"){

 
require_once("../includes/error_log.php");
       $username      = $_POST['username'];
       $firstname     = $_POST['firstname'];
       $gender        = $_POST['gender'];
       $email         = $_POST['email'];
       $day           = $_POST['day'];
       $month         = $_POST['month'];
       $year          = $_POST['year'];
       $citystate     = $_POST['citystate'];
       $password      =  hash('sha256', $_POST['password']);	
       $mailstring    = random_str(32); 
       $checkUsername = opendb("", "CALL read_usernames('$username')");
       $checkEmail    = opendb("", "CALL read_email('$email')");

       //Kollar ifall användarnamnet eller emailadressen redan finns i databasen.
       if($checkUsername[0] == 1){
       	
            msg("*Ditt användarnamn finns redan. Vänligen ange en annan." , "danger");
       }if($checkEmail[0] == 1){
       msg("*Din mail finns redan. Vänligen ange en annan." , "danger");
       
       }
       else{
  		   $result = opendb("", "CALL insert_Users('$citystate', '$firstname', '$gender','$username' , '$password', '$email', '$year$month$day', '$mailstring')");
           
           if($result[0] == 1){
                 $mail = send_epost($email, "Verifiera ditt konto hos Nozia", "
                   <img src='http://www.nozia.se/img/bluelogo.png' height='300' width='300'>
                   <h2>Välkommen till NOZIA</h2>

<p>Du har precis genomfört en lyckad registrering hos NOZIA.</p><br>

<p>Användarnamn: $username</p> 
<br>

<p>Lösenord: Det du angav när du registrerade dig</p>
<br><br>
<p>Verifiera ditt konto:</p> http://nozia.se/confirmedmail/?Vid=$mailstring
<br><br>
<p>NOZIA kommer ge dig större frihet över din reklam och du kan enkelt ta med och visa upp dina erbjudanden i de aktuella butikerna.</p>
<br>
<p>Om vi kan ge företagen ett snabbare, enklare och mer miljövänligt sätt att marknadsföra sig så tar vi ett stort steg in i framtiden.</p>
<br>
<p>Om vi alla hjälps åt att sprida NOZIA till så många som möjligt så ligger vi bra till för att påverka mängden pappersreklam vi får till våra hem.</p>
<br><br>

<p>NOZIA Ett Steg Mot Smartare Marknadsföring Och En Renare Miljö</p>

<p>Våra Framsteg Är Vår Framtid</p>
<br><br>

<p>För frågor eller feedback:</p>
<br>
<p>Info@noziaadvertising.com</p>

<br><br>
<p>Mvh</p>
<br>
<p><b>Team Nozia</b></p>
                ");

           	  msg("Du är nu registrerad! Ett bekräftelsemail har skickats till $email" , "success");

              write_error("Lyckad Användarregistrering genomförd med användarnamnet " . $username . " och namnet ". $firstname);
              list($num_rowsMyOffer, $resultMyOffer) = opendb("", "CALL read_AllOffers()");
              list($num_rowsUser, $resultUser) = opendb("", "CALL read_UserWithEmail('$email')");

              $rowUser = $resultUser->fetch_assoc();

              if($num_rowsMyOffer != 0){

              while($rowsMyOffer = $resultMyOffer->fetch_assoc()){

                list($num_rowsInsertMyOffer, $resultInsertMyOffer) = opendb("", "CALL insert_MyOffer('$rowUser[ID]', '$rowsMyOffer[ID]')");
                     
              }
            }
           }else{
           	msg("Det gick inte att registrera kontot. Vänligen kontakta administratör." , "danger");

            write_error("Misslyckad registrering vid registerUser.php med användarnamnet " . $username . " och namnet ". $firstname);
           }
        }

 }


  	
   
       




  
 
