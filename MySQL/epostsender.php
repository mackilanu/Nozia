<?php

require_once "/usr/share/php/Mail.php";

function send_epost($mottagare,$subject,$body){

$message_data = "ERROR vid My/epostsender.php function send_epost($mottagare,$subject,$body)";


$username =  SMTP_MAIL;
$password =  SMTP_PW;
$host     =  SMTP_HOST;
$port     =  SMTP_PORT;
$auth     =  1;

if ($auth == 1){
$auth = TRUE;
} else {
$auth = FALSE;
}

$avsandare    = $username;


$headers = array ('From' => $avsandare,
                      'To' => $mottagare,
                      'Subject' => $subject,
                      'MIME-Version' => '1.0',
                      'Content-Type' => 'text/html; charset=UTF-8');
$smtp    = Mail::factory('smtp',
                             array ('host' => $host,
                             'port' => $port,
                             'auth' => $auth,
                             'username' => $avsandare,
                             'password' => $password));

//$time_start = microtime(true);
$mail       = $smtp->send($mottagare, $headers, $body);
//$time_end   = microtime(true);
//$time       = $time_end - $time_start;

if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} 


return TRUE;
}

?>