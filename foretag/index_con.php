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
					<p class="center">Genom att registrea dig, så godkänner du våra <a href="../anvandarvillkor">användarvillkor</a><br>och användandet av cookies</p>
				</div>
<div class="col-md-2"></div>
				<div class="col-md-4">

				<h2>Våra Framsteg Är Vår Framtid</h2>

				<ul>
					<li>Mindre Pappersreklam</li>
					<li>Renare Miljö</li>
					<li>Reklam När, Var Och Hur <b><u>Du</u></b> Vill</li>
				</ul>
                    <img src="../img/greenlogo.png" width="200" style="margin-left: 50px;" height="200">
				</div>

				</div>

					