<?php
require_once("fotnot.php");
require_once("bootstrap.php");



echo <<<FOOTER

<footer class="navbar navbar-default foooter">

 <div class="col-md-4 col-lg-4 col-xs-12 ">
 	   <h4 class='center-text'>SHL</h4>
 	   <p  class='center-text'>$namnSHL</p>
 	   <p  class='center-text'>$telefonSHL</p>
 	   <p  class='center-text'>$orgNrSHL</p>
 	   <p  class='center-text'>$adressSHL $postNrSHL</p>   
 
</div>


 <div class="col-md-4 col-lg-4 col-xs-12">
 	   <h4 class='center-text'>Domarchef</h4>
 	   <p class='center-text'>Peter Andersson</p>
 	   <p class='center-text'>$MobilCHEF</p>
 	   <p class='center-text'>$epostCHEF</p>

 	
 </div>

 <div class="col-md-4 col-lg-4 col-xs-12 ">
 	   <h4 class='center-text'>Webmaster</h4>
 	   <p class='center-text'>$webmaster</p>
 	   <p class='center-text'>$epostWEBMASTER</p>
 </div>
 </footer>



FOOTER;
?>





