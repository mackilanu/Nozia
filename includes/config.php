<?php

//Database configuration
 @session_start();


 define("DB_HOST", "");
 define("DB_USER", "marcus");
 define("DB_PW", "Silop1337");
 define("DB_NAME", "nozia");

define("FILETARGET", "/var/www/html/images/");

//SMTP configuration
 define("SMTP_MAIL", "mackilanu@gmail.com");
 define("SMTP_HOST", "smtp.gmail.com");
 define("SMTP_PORT", "587");
 define("SMTP_PW",   "Silop1337");



//Page structure

define("HEAD", '
   <!DOCTYPE html>
   <html lang="sv">
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<meta charset="utf-8">
	');

define("CLOSE_HEAD", "</head><body>");


define("BODY", '
               <div class="container">
	           <div class="row">		
               <div id="container">
    ');

define("END", '

		<p style="text-align: center;">Copyright &copy; Nozia Group 2017</p>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	    </body>
		
</html>
	');


define("NAV",'

    <nav role="navigation" class="navbar navbar-default bar" id="usernav">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">

        <ul class="nav navbar-nav" id="userNavCon">
           
         <li class="nav-item">
          <div class="dropdown" style="top: 10px;">
           		<a class="dropdown-toggle" data-toggle="dropdown" style="color: #FFF; font-size: 11pt; cursor: pointer;">'. $_SESSION['firstname'] .'
  				<span class="caret"></span></a>
  				<ul class="dropdown-menu">
    				<li><a href="../mittkonto">Min profil</a></li>
    				<li><a href="../includes/logout.php">Logga ut</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal" onclick="read_favourites()"> Favoritföretag</a></li>
  				</ul>
			</div>
      </li>
        </ul>
	</div>
  </div>
</nav>');

define("COMPANYNAV",'

    <nav role="navigation" class="navbar navbar-default bar" style="background-color: red;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">        
            <li class="dropdown">
              
            </li>
        </ul>
        <form role="search" class="navbar-form navbar-left" >

            <div class="form-group">
    
              <h1>NOZIA</h1>

              <a href="../includes/logout.php" style="color: #FFF;">Logga ut</a>
              <a href="../controlpanel" style="color: #FFF;">Kontrollpanel</a>

            </div>
        </form>


        <ul class="nav navbar-nav navbar-right">
     
          <p style="font-size: 16pt; color: #FFF;">NOZIA <img src="../img/whiteLogo.png" width="64" height="64" align="rigth"></p>
           
        </ul>
    </div>
</nav>');

//Exeptions index pages

define("CLOSEBODY", "</div></div></div></div>");

define("STARTNAV", '
      

		<nav role="navigation" class="navbar navbar-default bar">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>       
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">          
            <li class="dropdown">
              
            </li>
        </ul>
        <form role="search" class="navbar-form navbar-left" >

            <div class="form-group">
	
                <input type="text"  placeholder="Användarnamn" class="form-control login" id="username" style="width: 200px; margin-top: 10px;"  onkeypress="return runScript(event)">
                <input type="password" name="password" id="password" placeholder="Lösenord" class="form-control login" style="width: 200px; margin-top: 10px;"  onkeypress="return runScript(event)">
                <button  type="button" class="btn btn-info" style="margin-top: 10px;" onclick="login()">Logga in</button>
                <p>Har du glömt ditt lösenord? <a data-toggle="modal" href="#myModal" data-target="#myModal">klicka här.</a></p>
            </div>
        </form>
        <ul class="nav navbar-nav navbar-right" style="text-align:center; display: inline;">
     
          <img src="../img/whiteLogo.png" width="100" height="100">
           
        </ul>
    </div>
</nav>');
