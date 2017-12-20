<?php
session_start();
if($_SESSION['id'] == ""){
  header("Location: ../login");
  $_POST['message'] = "DU måste vara inloggad för att se denna sida.";

}


if($_SESSION['username'] != ""){
?>

<div class="navbar navbar-default navbar-fixed-top" role="navigation" >

    <div class="container"> 

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a target="_blank" href="#" class="navbar-brand">Välkommen till NOZIA, <?php echo $_SESSION['firstname']; ?>.</a>

        </div>

   
            <ul class="nav navbar-nav navbar-right" class="dropdown-toggle" data-toggle="dropdown">

                       
                        <strong><?php echo $_SESSION['username'];  ?></strong>
                     
                   

                          
                   

                    </a>


                      <a href="#">Ändra uppgifer</a>
                      <a  href="../includes/logout.php"   style="float: right;">Logga ut</a> 

                    
                   <!--  <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $_SESSION['firstname']  ;?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION['email']  ?></p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Redigera uppgifter</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                        <form action="../Scripts/logout.php" method="POST">
                                            <input value="Logga ut" type="submit" class="btn btn-danger btn-block">
                                        </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul> -->
        </div>
    </div>
</div>

<?php
}

?>

<?php
if($_SESSION['name'] != ""){
?>


<div class="navbar navbar-default navbar-fixed-top" role="navigation" >

    <div class="container"> 

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a target="_blank" href="#" class="navbar-brand">Välkommen till NOZIA, <?php echo $_SESSION['name']; ?>.</a>

        </div>
   
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo $_SESSION['name'];  ?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $_SESSION['name']  ;?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION['email']  ?></p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Redigera uppgifter</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                        <form action="../Scripts/logout.php" method="POST">
                                            <input value="Logga ut" type="submit" class="btn btn-danger btn-block">
                                        </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
}

?>