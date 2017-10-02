<?php
@session_start();
header('Content-Type: application/json');
date_default_timezone_set("Europe/Stockholm");
require_once ("../../includes/config.php");

require_once ("../../MySQL/DBconnect.php");

$username = $_GET['username'];
$password = $_GET['password'];
echo login($username, $password);

// This function checks if the input details is correct

function login($username, $password)
{
  $passwordhashed = hash('sha256', $password); //Hashed the password with sha256

  // Connects to the database

  list($num_rows, $result) = opendb("SQL-ERROR at register/ajax/login.php function login($username, $password)", "CALL read_login('$username', '$passwordhashed')");

  // If affected rows = 0 the login was not succesful

  if ($num_rows == 0 or !$result) {
    return '{"status": "Error" }';

    // Otherwise, it's succesful

  }
  else {
    while ($session = $result->fetch_assoc()) {
      $username = $session['Username'];
      $password = $session['Password'];
      $CS = $session['CS'];
      $firstname = $session['Fname'];
      $email = $session['Email'];
      $birthday = $session['BirthDay'];
      $ID = $session['ID'];
      $verified = $session['verify'];
      $gender = $session['Gender'];
    }

    // if ($verified == 0) {
    //   return '{"status": "NotVerified" }';
    // }

    $message_dataTraffic = "SQL-ERROR AT register/ajax/login.php function login($ID)";
    $SQLTraffic = "CALL insert_Traffic('" . $ID . "')";
    list($num_rowsTraffic, $resultTraffic) = opendb($message_dataTraffic, $SQLTraffic);
    if ($num_rowsTraffic == 0 or !$resultTraffic) {
      return '{"status": "Error" }';
    }

    // Declares the session variables

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['citystate'] = $CS;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['email'] = $email;
    $_SESSION['birthday'] = $birthday;
    $_SESSION['id'] = $ID;
    $_SESSION['verified'] = $verified;
    $_SESSION['type'] = 0;
    $_SESSION['Gender'] = $gender;

    //  setcookie("username", $username, 2147483647);
    //  setcookie("password", $password, 2147483647);
    //  setcookie("citystate", $CS, 2147483647);
    //  setcookie("Fname", $firstname, 2147483647);
    //  setcookie("email", $email, 2147483647);
    //  setcookie("birthday", $birthday, 2147483647);
    // setcookie('ID', $ID, time()+3600, '/', '.nozia.');
    //  setcookie("verified", $verified, 2147483647);
    //  setcookie("gender", $gender, 2147483647);
    //    if(UserTraffic() == "Error") return '{"status": "Error"}';

    return '{"status": "OK"}';
  }
}

function UserTraffic()
{
  $SQL = "CALL insert_Traffic('" . $_SESSION['id'] . "')";
  $message_data = "SQL-ERROR at register/ajax/login.php function UserTraffic($_SESSION[id])";
  list($num_rows, $result) = opendb($message_data, $SQL);
  if ($num_rows == 0 or !$result) return 'Error';
  return 'OK';

}