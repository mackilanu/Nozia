<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once("../../includes/config.php");
require_once("../../MySQL/DBconnect.php");
require_once("../../MySQL/epostsender.php");

$email = $_GET['Email'];

echo SendCompanyMail($email);
//This function checks if the input email is already in use
function SendCompanyMail($email){

 $send = send_epost("$email", "Välkommen till NOZIA", "

    <h2>Välkommen till NOZIA</h2>
<br>
<p>Du har precis registrerat ditt företag hos NOZIA.</p>
<br>
<p>Användarnamn:  $username</p>

<p>Lösenord: Det du angav när du registrerade ditt konto</p>
<br>
<p>Veriferia ditt företagskonto: http://nozia.se/confirmedmail/company.php?Vid=$mailstring </p>
<br>
<p>Med NOZIA kommer du på enkelt och direkt sätt att marknadsföra sig till dina närkunder.</p>

<p>Våra användare kommer registrera sig med namn, ålder, kön och ort så att du på ett effektivt sätt kan nå ut till de kunder som är aktuella för dig samt en unik möjlighet att skicka rätt erbjudande basserat på ålder och kön.</p>

<p>För att fixa iordning din sida behöver du lägga upp bilder och erbjudanden samt skriva information om öppetider eller annat som du finner relevant.</p>

<p>Strlk Företagsbild:</p>

1140 X 200 pixlar

<p>Strlk Företagslogga:</p>

<p>Strlk Erbjudandebild:</p>
500X 500 pixlar
<br>

<b>Var vänlig använd de förhållna storlekarna för bästa resultat.</b>

<br>
<p>NOZIA Ett Steg Mot Smartare Marknadsföring Och En Renare Miljö</p>

<p>Våra Framsteg Är Vår Framtid</p>
<br>

<p>För frågor eller feedback:</p>

<p>info@noziaadvertising.com</p>

<br>
<p>Mvh</p>
<br>
<b>Team NOZIA</b>

         
       <h1 style='text-align:center;'>Tack för att du har registrerat ditt företag dig hos nozia!</h1>
                 <p style='color:red; text-align:center;'><a href=''>Klicka här för att verifera ditt konto</a></p>

		");
 

    return '{"status": "OK"}';

}