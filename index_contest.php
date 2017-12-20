<div class="row">

     <div class="col-md-6">

     	<div class="formBackground">
    
		<div class="row content-row" id="username-row">
			<input type="text" name="Username" id="Username" class="col-sm-12 col-xs-12 inputField leftElement" placeholder="Användarnamn" onchange="checkUsername(this.value)" >
		</div>
		<div class="row content-row">
			<input type="text" name="firstname" id="firstname" class="col-sm-12 col-xs-12 inputField leftElement" placeholder="Förnamn" onchange="check_FirstName(this.value)" >
		</div>
		<div class="row content-row">
			<input type="email" name="email" id="email" class="col-sm-12 col-xs-12 inputField" placeholder="E-mail" onchange="checkEmail(this.value)">
			<p id="email-alert" style="color: red;" hidden>Email-adressen är upptaget</p>
		</div>
		<div class="row content-row">
			<select name="day" id="day" class="col-sm-4 col-xs-4 inputField leftElement" onchange="checkDay(this.value)">
				<option value="0" selected>Dag</option>
				<?php
					for($i = 1; $i <= 31; ++$i ){
					   echo '<option value="'. $i . '">'. $i .'</option>';
					}
					 
					?>
			</select>
			<select class="col-sm-4 col-xs-4 inputField leftElement" name="month" id="month" style="padding-bottom: 17px;" onchange="checkMonth(this.value)">
				<option value="0" selected>Månad</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Mars</option>
				<option value="04">April</option>
				<option value="05">Maj</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Augusti</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<select name="year" id="year" class="col-sm-4 col-xs-4 inputField leftElement" onchange="checkYear(this.value)">
				<option value="0" selected>År</option>
				<?php
					$y = date("Y");
					$firtY = $y - 120;
					
					echo '<option value="'.$y .'">'.$y.'</option>';
					
					for($i = $y - 1;  $i > $y - 120; --$i){
					
					 echo '<option value="'. $i .'" >'.$i.'</option>';
					}
					
					
					?>
			</select>
		</div>
		<div class="row content-row" id="date-row">
			<select id="gender" name="gender" class="col-sm-4 col-xs-4 inputField" onchange="checkGender(this.value)">
				<option class="optionPlaceholder" disabled selected value="0">Kön</option>
				<option value="1">Man</option>
				<option value="2">Kvinna</option>
				<option value="3">Övrigt</option>
			</select>
			<select onchange="fetchCS()" id="country" class="col-sm-4 col-xs-4 inputField">
				<option selected value="0">Välj land</option>
			</select>
			<select id="citystate" name="citystate" class="col-sm-4 col-xs-4 inputField" onchange="checkCS(this.value)">
				<option value="0" selected>Välj kommun</option>
			</select>
		</div>
		<div class="row content-row">
			<input type="password" name="password" id="pword" class="col-sm-12 col-xs-12 inputField" onchange="checkPass(this.value)" placeholder="Lösenord">
		</div>
                       
		<div class="row form-group has-error">
			<input type="password" name="re-password" id="re-password" onchange="checkRePass(this.value)" class="col-sm-12 col-xs-12 inputField" placeholder="Upprepa Lösenord">
		</div>
	</div>
                   
    
	<button type="button" id="register" class="btn btn-lg" onclick="register()">Registrera</button>
	                    <input type="checkbox" style="form-control" id="check" onclick="checkchecked()"> <p style="font-size: 12pt; color: black; display: inline;">Godkänn <a data-toggle="modal" data-target="#terms" style="cursor: pointer;">användarvillkoren</a></p>

</div>
    <div class="col-md-2"></div>

     <div class="col-md-4">

                        	<img src="../img/newlogo.png" width="200" style="margin-left: 50px;" height="200">
	<p style="font-size: 14pt;">
		Framtiden är här, där du om du drar ditt strå till stacken, kan bidra och hjälpa till med att få bort pappersreklamen, inte bara i Sverige utan i Norden, Europa och Världen.
		<br>
		<br>
		Vi har skapat ett vapen mot miljöförstöring genom att helt enkelt göra pappersreklamen helt digital.
		<br>
		<br>
		Vi klarar det inte utan dig och de företag som finns runt om oss.
		<br>
		<br>
		Vi måste göra det vi kan när vi kan det, för imorgon kan det vara försent.
		<br>
		<br>
		Registrera dig redan NU!
		<!---Kolla in vår video! -->
	</p>
	<h2>Våra framsteg är vår framtid</h2>
	<ul style="color: black; list-style-type: circle; ">
		<li>Mindre Pappersreklam</li>
		<li>Renare Miljö</li>
		<li>Reklam när, var och hur <b><u>DU</u></b> vill</li>
	</ul>
</div>
                        </div>

      </div>
</div>

                        
<div id="terms" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Användarvillkor</h4>
      </div>
      <div class="modal-body">
        <p>När DU registrerar dig på Nozia så är all personlig information skyddat av dataskyddslagen.
  <a href="http://www.regeringen.se/49a184/contentassets/e98119b4c08d4d60a0a2d0878990d5ec/ny-dataskyddslag-sou-201739" target="_blank"> SOU 2017:39 pdf.</a><br><br>
Nozia får inte under några omständigheter annat än om lagen kräver det lämna ut några uppgifter som DU lämnar till Nozia.
Företag får inte kontakt DIG annat än genom Nozia om inget annat av DIG anges.</p>

<p>Emailen som DU anger vid registrering får inte användas i kommersiellt syfte av Nozia eller något annat företag utan ditt godkännande.</p>

<p>Om DU lämnar uppgifter som telefonummer och adress så faller det under personligt ansvar.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>