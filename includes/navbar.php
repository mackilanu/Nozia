
<?php
session_start();
if($_SESSION['id'] == ""){
  header("Location: ../login");
  $_POST['message'] = "DU måste vara inloggad för att se denna sida.";

}

if($_SESSION['username'] != ""){
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Välkommen till NOZIA, <?php echo $_SESSION['firstname']; ?>.</a>
    </div>
    <ul class="nav navbar-nav">
     
      <li><a href="../settings">Dina uppgifter</a></li>
      <li><a href="../includes/logout.php">Logga ut</a></li>
    </ul>
  </div>
</nav>


<?php
}
if($_SESSION['name'] != ""){

?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Välkommen till NOZIA, <?php echo $_SESSION['name']; ?>.</a>
    </div>
    <ul class="nav navbar-nav">
       <li><a href="#">Företagets uppgifter</a></li>
      <li><a href="../includes/logout.php">Logga ut</a></li>
    </ul>
  </div>
</nav>

<?php
}
?>