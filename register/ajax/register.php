<?php
header("Content-type: text/html; charset=utf-8");
@session_start();
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

require_once ("../../MySQL/DBconnect.php");

require_once ("../../includes/error_log.php");

require_once ("../../MySQL/epostsender.php");

$Uname = $_GET['username'];
$Name = $_GET['Fname'];
$Email = $_GET['Email'];
$Bday = $_GET['Bday'];
$Gender = $_GET['Gender'];
$Country = $_GET['Country'];
$CS = $_GET['CS'];
$Pword = hash('sha256', $_GET['Password']);
$verify = random_str(128);
echo insertUser($Uname, $Name, $Email, $Bday, $Gender, $Country, $CS, $Pword, $verify);

function insertUser($Uname, $Name, $Email, $Bday, $Gender, $Country, $CS, $Pword, $verify)
{
  $SQL = "CALL insert_Users('$CS', '$Name', '$Gender', '$Uname', '$Pword', '$Email', '$Bday', '$verify')";
  list($affected_rows, $result) = opendb("SQL-ERROR AT register/ajax/register.php function insert_Users('$CS', '$Name', '$Gender', '$Uname', '$Pword', '$Email', '$Bday', '$verify')  ", $SQL);
  if (!$result) return '{"status": "Error"}';
  $MyOffers = InsertExistingOffers($Email);
  if ($MyOffers == "Error") {
    return '{"status": "NoOffers"}';
  }

  // $MailStatus = sendemail($Email, $Uname, $verify);
  // write_error($MailStatus);

  return '{"status": "OK", "Email": "' . $Email . '", "MailStatus": "' . $MailStatus . '"}';
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
  $str = '';
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
    $str.= $keyspace[random_int(0, $max) ];
  }

  return $str;
}

function InsertExistingOffers($email)
{
  $SQL = "CALL read_all_offers()";
  $message_data = "SQL-ERROR AT register/ajax/register.php function InsertExistingOffers()";
  list($num_rows, $result) = opendb($message_data, $SQL);
  if (!$result) {
    return "Error";
  }

  $SQLUser = "CALL read_UserWithEmail('" . $email . "')";
  list($num_rowsUser, $resultUser) = opendb($message_data, $SQLUser);
  if (!$resultUser) {
    return "Error";
  }

  $UserID = $resultUser->fetch_assoc();
  while ($rows = $result->fetch_assoc()) {
    $SQL = "CALL insert_MyOffer('" . $UserID['ID'] . "', '" . $rows['ID'] . "')";
    list($num_rows, $resultMyOffer) = opendb($message_data, $SQL);
    if (!$resultMyOffer) {
      return "Error";
    }
  }

  return "OK";
}

function sendemail($email, $username, $mailstring)
{
  $mail = send_epost($email, "Verifiera ditt konto hos Nozia", "
                   <img src='http://nozia.se/images/greenlogo.png' height='300' width='300'>
                   <h2>Välkommen till NOZIA</h2>

<p>Du har precis genomfört en lyckad registrering hos NOZIA.</p><br />
 
<p>Användarnamn: $username</p> 
<br />

<p>Lösenord: Det du angav när du registrerade dig</p>
<br /><br />
<p>Verifiera ditt konto:</p> http://nozia.se/confirmedmail/?Vid=$mailstring
<br /><br />
<p>NOZIA kommer ge dig större frihet över din reklam och du kan enkelt ta med och visa upp dina erbjudanden i de aktuella butikerna.</p>
<br />
<p>Om vi kan ge företagen ett snabbare, enklare och mer miljövänligt sätt att marknadsföra sig så tar vi ett stort steg in i framtiden.</p>
<br />
<p>Om vi alla hjälps åt att sprida NOZIA till så många som möjligt så ligger vi bra till för att påverka mängden pappersreklam vi får till våra hem.</p>
<br /><br />

<p>NOZIA Ett Steg Mot Smartare Marknadsföring Och En Renare Miljö</p>

<p>Våra Framsteg Är Vår Framtid</p>
<br /><br />

<p>För frågor eller feedback:</p>
<br />
<p>Info@noziaadvertising.com</p>

<br /><br />
<p>Mvh</p>
<br />
<p><b>Team Nozia</b></p>
                ");
}

?>
