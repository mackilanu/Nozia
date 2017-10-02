
var checkEmail    = false, 
    checkUsername = false,
    checkName     = false,
    checkOrgnr    = false,
    checkPhone    = false,
    checkAdress   = false,
    checkCountry  = false,
    checkCS       = false,
    checkCategory = false,
    checkPw       = false;
    checkRePw     = false;


$( document ).ready(function() {
    document.getElementById("register").disabled = true;
  //Puts all avaliable countries in the select country element.
 var x = document.getElementById("Country");


 for (var i = 0; i <= kommun.CS.length; i++) {
 var option = document.createElement("option");
 option.text = Countries.Country[i].Country;
 option.value = Countries.Country[i].id;
 x.add(option);
 }
});



$(window).on('load', function() { 

   //Puts all avaliable categories in the select country element.
  var y = document.getElementById("kategori");

  for (var i = 0; i <= Categories.Category.length; i++) {
 var optionn = document.createElement("option");
 optionn.text = Categories.Category[i].Caption;
 optionn.value = Categories.Category[i].CatgoryID;
 y.add(optionn);
 }


});


function checkCompanyCountry(value){

  if(value == "0"){
    alert("Vänligen ange ett land.");
    checkCountry = false;
    checkForm();
    return;
  }

  checkCountry = true;
  checkForm();

 var x = document.getElementById("CS");
 for(var i = 0; i <= kommun.CS.length; i++){

  if(kommun.CS[i].Country == value ){
    var option = document.createElement("option");
 option.text = kommun.CS[i].CityState;
 option.value = kommun.CS[i].ID;
 x.add(option);

  }

}
}

 function checkCompanyCS(value){
   if(value == "0"){
    alert("Vänligen ange en kommun");
    checkCS = false;
    checkForm();
    return;
  }

  checkCS = true;
  checkForm();

 }

 function checkCompanyCategory(value){
   if(value == "0"){
    alert("Vänligen ange en kategori som passar till ditt företag.");
    checkCategory = false;
    checkForm();
    return;
  }

  checkCategory = true;
  checkForm();
}

function checkCompanyEmail(value){
  
       if(value == ""){
       	  alert("Vänligen fyll i en email-adress");
       	  document.getElementById("Email").focus();
       	  checkEmail= false;	
       	  checkForm();
       }else{

       	var instring  = '{"CompanyEmail": "' + value +'"}';

       	var objekt = JSON.parse(instring);

	   $.getJSON("ajax/checkCompanyEmail.php", objekt)
        .done(function(data) {
       checkCompanyEmail_success(data);
	})
        .fail(function() {
        checkCompanyEmail_error();
	})
        .always(function() {

	});
    }
}

function checkCompanyEmail_success(response){
   
   if(response.status == "Exists"){
   	alert("Email-adressen är redan registrerat");
   	document.getElementById("Email").focus();
   	checkEmail = false;
   	checkForm();
   }

   if(response.status == "OK"){
   	checkEmail = true;
   	checkForm();
   }
   
   if(response.status == "Error"){
   	alert("Ett fel har uppstått. Om problemet kvartstår vänligen kontakta en administratör.");
   checkEmail = false;
   	checkForm();
   }
}

function checkCompanyName(value){
  if(value == ""){
    alert("Vänligen fyll i ett företagsnamn.");
    document.getElementById("Name").focus();
    checkName = false;
    checkForm();
  }else{
    checkName = true;
    checkForm();
  }
}

function check_orgnr(value){

  if(value == ""){
    alert("Vänligen fyll i ett organisationsnummer.");
    document.getElementById("orgnr").focus();
    checkOrgnr = false;
    checkForm();
    return;
  }

  if(value.length != 10){
    alert("organisationsnumret ska innehålla exakt 10 siffror.");
    document.getElementById("orgnr").focus();
    checkOrgnr = false;
    checkForm();
    return;
  }

  checkOrgnr = true;
  checkForm();
}


function checkPhonenr(value){

  if(value == ""){
    alert("Vänligen fyll i ett telefonnummer");
    document.getElementById("phonenr").focus();
    checkPhone = false;
    checkForm();
    return;
}

if(value.length != 10){
  alert("Telefonnumret måste innehålla exakt 10 siffor.");
  document.getElementById("phonenr").focus();
  checkPhone = false;
  return;
}

checkPhone = true;
checkForm();
}

function checkCompanyAdress(value){

  if(value == ""){
    alert("Vänligen fyll i en adress");
    document.getElementById("adress").focus();
    checkAdress = false;
    checkForm();
    return;
  }

  if(value.length > 32){
    alert("Adressen får inte innhålla fler än 32 tecken.");
    document.getElementById("adress").focus;
    checkAdress = false;
    checkForm();
    return;
  }

  checkAdress = true;
  checkForm();
}


function checkCompanyEmail_error(){

	alert("Ett allvarligt fel har uppstått. Om problemet kvartstår vänligen kontakta en administratör.");
}

function checkCompanyPassword(value){

  if(value == ""){
    alert("Vänligen ange ett lösenord.");
    document.getElementById("passwordd").focus();
    checkPw = false;
    checkForm();
    return;
  }
  if(value.length < 8){
    alert("Lösenordet måste innehålla minst 8 tecken.");
    document.getElementById("passwordd").focus();
    checkPw = false,
    checkForm();
    return;
  }

  checkPw = true;
  checkForm();
}

function checkCompanyRePassword(value){

 var pw =  document.getElementById("passwordd").value;

 if(value == ""){
  alert("Vänligen skriv lösenordet igen.");
  document.getElementById("repassword").focus();
  checkRePw = false;
  checkForm();
  return;

 }

 if(value != pw){
  alert("Lösenorden stämmer inte överrens med varandra. Försök igen.");
  document.getElementById("repassword").focus();
  checkRePw = false;
  checkForm();
  return;
 }

 checkRePw = true;
 checkForm();
}

function isNumberKey(txt, evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
            return true;
        } else {
            return false;
        }
    } else {
        if (charCode > 31
             && (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
}


function checkCompanyUsername(value){
      if(value == ""){
          alert("Vänligen fyll i ett användarnamn");
          document.getElementById("Username").focus();
          checkUsername = false;  
          checkForm();
       }else{

        var instring  = '{"Username": "' + value +'"}';

        var objekt = JSON.parse(instring);

     $.getJSON("ajax/checkUsername.php", objekt)
        .done(function(data) {
       checkCompanyUsername_success(data);
  })
        .fail(function() {
        checkCompanyUsername_error();
  })
        .always(function() {

  });
    }

}

function checkCompanyUsername_success(response){

if(response.status == "Exists"){
    alert("Användarnamnet finns redan");
    document.getElementById("Username").focus();
    checkUsername = false;
    checkForm();
   }

   if(response.status == "OK"){
    checkUsername = true;
    checkForm();
   }
   
   if(response.status == "Error"){
    alert("Ett fel har uppstått. Om problemet kvartstår vänligen kontakta en administratör.");
   checkUsername = false;
    checkForm();
   }


}

function checkCompanyUsername_error(){
  alert("Ett allvarligt fel har uppstått. Om problemet kvarstår vänligen kontakta en administratör.");
}


function checkForm(){

	var check = true;

	if(!checkEmail)
		check = false;

  if(!checkUsername)
    check = false;

  if(!checkName)
    check = false;

  if(!checkOrgnr)
    check = false;

  if(!checkPhone)
    check = false;

  if(!checkAdress)
    check = false;

  if(!checkCountry)
    check = false;

  if(!checkCS)
    check = false;

  if(!checkCategory)
    check = false;
   
   if(!checkPw)
    check = false;

  if(!checkRePw)
    check = false;

	if(check == true)
		document.getElementById("register").disabled = false;

  else
    document.getElementById("register").disabled = true;

}

function register(){
  var Name       = document.getElementById("Name").value;
  var Orgnr      = document.getElementById("orgnr").value;
  var Username   = document.getElementById("Username").value;
  var Email      = document.getElementById("Email").value;
  var Country    = document.getElementById("Country").value;
  var CS         = document.getElementById("CS").value;
  var Category   = document.getElementById("kategori").value;
  var Password   = document.getElementById("passwordd").value;
  var Phone      = document.getElementById("phonenr").value;
  var Adress     = document.getElementById("adress").value;

   var instring  = '{"Name": "'    + Name
                +'", "Orgnr": "'   + Orgnr
                +'", "Username": "'+ Username
                +'", "Email": "'   + Email 
                +'", "CS": "'      + CS 
                +'", "Category": "'+ Category 
                +'", "Password": "'+ Password
                +'", "Adress": "'+ Adress 
                +'", "Phone": "'+ Phone +'"}';

        var objekt = JSON.parse(instring);
        console.log(objekt);

     $.getJSON("ajax/register.php", objekt)
        .done(function(data) {
       register_success(data);
  })
        .fail(function() {
        register_error();
  })
        .always(function() {

  });


}

function register_success(response){

    var Email  = document.getElementById("Email").value;

  if(response.status == "Error"){
     alert("Det gick inte att registrera kontot av okänd anledning. Om problemet kvarstår vänligen kontakta support.");
  }


if(response.status == "OK"){
  //=========================
  //SKA ÄNDRAS
  //=========================
 SendMail(Email);
}

if(response.status == "Partly"){
  alert("Kontot är registrerat med det gick inte att lägga till företagssidan. Vänligen kontakta support för manuell betjäning")
}
}


function register_error(){
  alert("Av en okänd anledning så gick det inte att registrera kontot. Vid upprepade fel vänligen kontakta support.");
}

function SendMail(email){

     var instring  = '{"Email": "' + email +'"}';

        var objekt = JSON.parse(instring);

     $.getJSON("ajax/SendMail.php", objekt)
        .done(function(data) {
       SendMail_success(data);
  })
        .fail(function() {
        SendMail_error();
  })
        .always(function() {

  });

}

function SendMail_success(response){
   var name = document.getElementById("Name").value;

  if(response.status == "OK"){
  
    window.location.href = "http://nozia.se/confirmedmail/?Name="+name+"&ch_mail=true";
  }
  if(response.status == "Error"){
     window.location.href = "http://nozia.se/confirmedmail/?Name="+name+"&ch_mail=false";
  }
}

function SendMail_error(){
   var name = document.getElementById("Name").value;
     window.location.href = "http://nozia.se/confirmedmail/?Name="+name+"&mail=false";
}


//=================
//Login script
//=================

function login(){

  var Username = document.getElementById("username").value;
  var Password = document.getElementById("password").value;

  if(Username == ""){
    alert("Vänligen fyll i ett användarnamn.");
    document.getElementById("username").focus();
    return;
  }
  if(Password == ""){
    alert("Vänligen fyll i ett lösenordet.");
    document.getElementById("password").focus();
    return;
  }

  var instring  = '{"Username": "' + Username +'", "Password": "'+ Password +'"}';
  var objekt = JSON.parse(instring);

     $.getJSON("ajax/login.php", objekt)
        .done(function(data) {
       login_success(data);
  })
        .fail(function() {
        Login_error();
  })
        .always(function() {

  });

}

function login_success(response){

  if(response.status == "NoAuth"){
    alert("Fel användarnamn eller lösenord. Försök igen.");
    document.getElementById("password").value = "";
    document.getElementById("password").focus();
  }

    if(response.status == "NotVerified"){

	alert("Kontot är inte verifierat. Vänligen titta i din mail och följ intruktionerna.");
    }

  if(response.status == "Auth"){
    window.location.href = "../Company/index.php?id=" + response.ID;
  }

}
