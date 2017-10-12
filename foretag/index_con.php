<div class="col-md-6 col-xs-12">
					<div class="formBackground" >
							
								<div class="row content-row" id="username-row">
									<input type="text" maxlength="64" id="Name" class="col-sm-12 col-xs-12 inputField leftElement" placeholder="Företagsnamn" onchange="checkCompanyName(this.value)" >
								</div>
                                
								<div class="row content-row">
									<input type="text" id="orgnr" class="col-sm-12 col-xs-12 inputField leftElement" placeholder="Org-nummer" onchange="check_orgnr(this.value)" onkeypress="return isNumberKey(this,event)" maxlength="10">
								</div>
								
								<div class="row content-row">
									<input type="text" id="Username" class="col-sm-12 col-xs-12 inputField" placeholder="Användarnamn" onchange="checkCompanyUsername(this.value)" maxlength="64">
									
								</div>

								<div class="row content-row">
									<input type="email" id="Email" class="col-sm-12 col-xs-12 inputField" placeholder="E-mail" onchange="checkCompanyEmail(this.value)" maxlength="128">
								
								</div>

			                    <div class="row content-row">
									<input type="text" id="phonenr" class="col-sm-12 col-xs-12 inputField" placeholder="Telefonnummer" onchange="checkPhonenr(this.value)" onkeypress="return isNumberKey(this,event)" maxlength="10">
									
								</div>


			                    <div class="row content-row">
									<input type="text" id="adress" class="col-sm-12 col-xs-12 inputField" placeholder="Adress" onchange="checkCompanyAdress(this.value)" maxlength="32">	
								</div>
								
								<div class="row content-row">
					
									<select  id="Country" class="col-sm-6 col-xs-6 inputField leftElement" onchange="checkCompanyCountry(this.value)">
									 <option value="0" selected>Välj land</option>	
									</select>

								
									
									<select class="col-sm-6 col-xs-6 inputField leftElement" id="CS" style="padding-bottom: 17px;" onchange="checkCompanyCS(this.value)">
									  <option value="0" selected>Välj kommun</option>


									  </select>
								</div>
								
							

								<div class="row content-row" id="date-row">
									<select id="kategori" class="col-sm-12 col-xs-12 inputField" onchange="checkCompanyCategory(this.value)">
										<option class="optionPlaceholder" disabled selected value="0">Välj kategori</option>
									</select>
						
								
						</div>

						    <div class="row content-row">

								<input type="password" id="passwordd" onchange="checkCompanyPassword(this.value)" maxlength="32" class="col-sm-12 col-xs-12 inputField" placeholder="Lösenord">
							
							</div>

							 <div class="row content-row">

								<input type="password" id="repassword" onchange="checkCompanyRePassword(this.value)" maxlength="32" class="col-sm-12 col-xs-12 inputField" placeholder="Bekräfta Lösenord">
							</div>
							
					
						
					</div>
                   <button type="button" id="register" class="btn btn-lg" onclick="register()">Registrera ditt företag</button>
		    <input type="checkbox" style="form-control" id="check" onclick="checkchecked()"> <p style="font-size: 12pt; color: black; display: inline;">Godkänn <a data-toggle="modal" data-target="#terms" style="cursor: pointer;">användarvillkoren</a></p>
				</div>
<div class="col-md-2"></div>
				<div class="col-md-4">
				    <img src="../img/redlogo.png" width="200" style="margin-left: 50px;" height="200">

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

				<h2 style="color: black; ">Våra Framsteg Är Vår Framtid</h2>


				<ul style="color: black; list-style-type: circle; ">
					<li>Mindre Pappersreklam</li>
					<li>Renare Miljö</li>
					<li>Reklam När, Var Och Hur <b><u>Du</u></b> Vill</li>
				</ul>
                
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
       
<p> När du registrerar dig hos Nozia Företag så godkänner du att vi ANVÄNDER din logga i marknadsföringssyfte, det betyder att vi har rätten att sätta din logga på material för att visa att du är en del av Nozia.</p>


<p>Nozia får INTE under några omständigheter använda sig av ditt företags material i något annat syfte, så som kommersiellt, politiskt eller kränkande sammanhang.</p>
     
<p>De första 6 månaderna är gratis, därefter kostar det 10.000 SEK/år + moms om du väljer att fortsätta vara en del av Nozia.</p>

<p>Betalningen ska vara oss tillhanda senast 7 dagar efter dina 6 månader är slut.</p>

<p>Om du väljer att inte fortsätta så finns din sida kvar hos oss men avaktiveras och syns därefter inte i Nozia nyhetsflöde. </p>

<p>För att aktivera sidan igen, betalar du in årsavgiften.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>